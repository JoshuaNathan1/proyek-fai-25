<?php

    namespace App\Http\Controllers;

    use App\Models\Product;
    use App\Models\ProductSupplier;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

    class SupplierProductController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $title = "Supplier's Home";
            // Ambil semua produk milik supplier yang sedang login
            $products = ProductSupplier::where('id_supplier', auth()->id())->get();
            // dd($products);

            // Kirim data produk ke view
            return view('partials.home.home_suppliers', compact('products', 'title'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $title = "Add Product";
            return view('partials.suppliers.add-items', compact("title"));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            // Validasi data
            $request->validate([
                'product_name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:1',
                'discount' => 'nullable|integer|min:0|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Simpan gambar produk
            $imagePath = $request->file('image')->store('product', 'public');

            // Simpan data ke database
            ProductSupplier::create([
                'id_supplier' => auth()->id(), // ID supplier dari user yang login
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'discount' => $request->discount,
                'image' => $imagePath,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('supplier.createProduct')->with('success', 'Produk berhasil ditambahkan!');
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            // Pastikan hanya supplier yang memiliki produk tersebut dapat mengedit
            $product = ProductSupplier::where('id', $id)->where('id_supplier', auth()->id())->firstOrFail();

            // Kirim data produk ke view
            return view('partials.suppliers.edit-items', compact('product'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            // Validasi data
            $request->validate([
                'product_name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Ambil produk yang akan diupdate
            $product = ProductSupplier::where('id', $id)->where('id_supplier', auth()->id())->firstOrFail();

            // Update gambar jika diunggah
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::delete('public/' . $product->image);
                }
                $imagePath = $request->file('image')->store('product', 'public');
                $product->image = $imagePath;
            }

            // Update data produk
            $product->update($request->except(['image']));

            // Redirect dengan pesan sukses
            return redirect()->route('supplier.dashboard')->with('success', 'Produk berhasil diperbarui!');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            // Pastikan produk milik supplier yang sedang login
            $product = ProductSupplier::where('id', $id)->where('id_supplier', auth()->id())->firstOrFail();

            // Hapus gambar dari storage
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Hapus produk dari database
            $product->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('supplier.dashboard')->with('success', 'Produk berhasil dihapus!');
        }
        
        public function history()
        {
            // Ambil transaksi milik supplier yang sedang login
            $transactions = DB::table('htrans_supplier')
                ->join('dtrans_supplier', 'htrans_supplier.id', '=', 'dtrans_supplier.htrans_supplier_id')
                ->join('products_suppliers', 'dtrans_supplier.product_id', '=', 'products_suppliers.id')
                ->join('users as admins', 'htrans_supplier.admin_id', '=', 'admins.id')
                ->select(
                    'htrans_supplier.id as htrans_id',
                    'admins.fullname as admin_name',
                    'products_suppliers.product_name',
                    'dtrans_supplier.quantity',
                    'dtrans_supplier.price',
                    DB::raw('dtrans_supplier.quantity * dtrans_supplier.price as subtotal'),
                    'htrans_supplier.created_at'
                )
                ->where('products_suppliers.id_supplier', auth()->id())
                ->orderBy('htrans_supplier.created_at', 'desc')
                ->paginate(10);
            return view('partials.suppliers.history-supplier', compact('transactions'));
        }
    }
