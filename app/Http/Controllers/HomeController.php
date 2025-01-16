<?php

namespace App\Http\Controllers;

use App\Models\{Product, ProductSupplier, Role, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";

        return view("home/index", compact("title"));
        // return view("/home/index", compact("title"));
    }

    public function customers()
    {
        $this->authorize("is_admin");

        $title = "Customers";
        $customers = User::with("role")->get();

        return view("home/customers",  compact("title", "customers"));
    }

    public function suppliers()
    {
        // Ambil semua pengguna dengan role supplier
        $suppliers = User::whereHas('role', function ($query) {
            $query->where('role_name', 'supplier');
        })->get();

        return view('partials.admin.supplier_list', compact('suppliers'));
    }
    
    public function supplierDashboard()
    {
        // dd(auth()->user()->role->name);
        $this->authorize('is_supplier'); 

        $title = "Supplier Dashboard";
        // $data = []; 

        return view("partials.home.home_suppliers", compact("title"));
    }

    public function showSupplierPage()
    {
        $title = "Add Supplier";

        return view("partials.add_suppliers", compact("title"));
    }

    public function supplierProducts($supplierId)
    {
        // Ambil supplier
        $supplier = User::findOrFail($supplierId);
        // Ambil semua produk milik supplier
        $products = ProductSupplier::where('id_supplier', $supplierId)->get();
        return view('partials.admin.supplier_products', compact('supplier', 'products'));
    }

    public function purchaseProduct(Request $request)
    {
        $supplierId = $request->input('supplier_id');
        $quantities = $request->input('quantities');
    
        if (!$quantities || count(array_filter($quantities)) === 0) {
            return back()->with('error', 'Tidak ada produk yang dipilih.');
        }
    
        $total = 0;
    
        // Buat Header Transaksi
        $htransId = DB::table('htrans_supplier')->insertGetId([
            'admin_id' => auth()->id(),
            'supplier_id' => $supplierId,
            'total' => 0, // Placeholder, update setelah perhitungan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        foreach ($quantities as $productId => $quantity) {
            if ($quantity <= 0) continue;
    
            $product = ProductSupplier::findOrFail($productId);
            // dd($product);
    
            if ($quantity > $product->stock) {
                return back()->with('error', "Jumlah pembelian untuk {$product->product_name} melebihi stok.");
            }
    
            $subtotal = $product->price * $quantity;
            $total += $subtotal;
    
            // Insert ke Detail Transaksi
            DB::table('dtrans_supplier')->insert([
                'htrans_supplier_id' => $htransId,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Kurangi stok produk
            $product->decrement('stock', $quantity);
    
            // Tambahkan atau update produk di tabel products
            $existingProduct = Product::where('product_name', $product->product_name)
            ->first();
            // dd($existingProduct);
            if ($existingProduct) {
                // Jika produk sudah ada, tambahkan stok
                $existingProduct->increment('stock', $quantity);
            } else {
                // Jika produk belum ada, tambahkan baris baru
                Product::create([
                    'id_supplier' => $product->id_supplier, 
                    'product_name' => $product->product_name,
                    'orientation' => $product->orientation,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock' => $quantity,
                    'discount' => $product->discount,
                    'image' => $product->image,
                ]);
            }
        }
    
        // Update total di Header Transaksi
        DB::table('htrans_supplier')->where('id', $htransId)->update(['total' => $total]);
    
        return back()->with('success', 'Pembelian berhasil dilakukan.');
    }
}
