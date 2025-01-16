<?php

namespace Database\Seeders;

// use App\Models\Product;
use App\Models\ProductSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Toraja Coffee",
            "description" => "Toraja Coffee is known for its unique flavor profile and cultural significance. This coffee is grown in the highlands of Sulawesi, Indonesia, offering a bold and earthy taste. Perfect for those who enjoy strong, full-bodied coffee. It is also appreciated for its low acidity and chocolaty finish.",
            "price" => 50000,
            "stock" => 120,
            "image" => "product/gaamRDJEO5xNbQMfgSXx91ZNIVYxid2S110yVkKg.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Arabica Coffee",
            "description" => "Arabica Coffee is celebrated for its smooth and mild flavor. Sourced from the finest plantations, this coffee boasts a hint of sweetness and fruity undertones. Ideal for coffee enthusiasts who prefer a lighter and more aromatic cup. It is a favorite worldwide for its balance of flavor and aroma.",
            "price" => 35000,
            "stock" => 60,
            "image" => "product/r8e0iS6hEBocNNBRkmTy5uL7BUf9IjNSQmZrgKJy.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Robusta Coffee",
            "description" => "Robusta Coffee is prized for its strong and bold taste. This coffee variety contains higher caffeine content, making it perfect for those who need an extra energy boost. With nutty and woody flavors, it offers a rich and robust drinking experience. Enjoy it as an espresso or in blends.",
            "price" => 55000,
            "stock" => 70,
            "image" => "product/Gy6UVqa000obrsMGJaRAzZ4hWEz5WGhu38QawLzC.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Sumatra Coffee",
            "description" => "Sumatra Coffee is well-known for its deep, complex flavor and low acidity. It offers a combination of earthy, spicy, and herbal notes, making it an excellent choice for those who enjoy unique and exotic tastes. This coffee is also loved for its rich, syrupy body and lingering aftertaste.",
            "price" => 48000,
            "stock" => 100,
            "image" => "product/xnWvCE9hdOIJLw0uyKg7aMfBsYtZR3XmOKTpDfAn.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Kintamani Coffee",
            "description" => "Kintamani Coffee comes from the highlands of Bali and is known for its citrusy and bright flavor. This coffee offers a unique blend of fruity and floral notes, creating a refreshing and light taste. Its balanced acidity makes it a perfect choice for a morning brew.",
            "price" => 45000,
            "stock" => 90,
            "image" => "product/BztXG5p7aKvN1fWys6hM2eRtQYXCm8Jh9orVAzEy.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Gayo Coffee",
            "description" => "Gayo Coffee is highly regarded for its smooth and clean taste. Sourced from the Gayo highlands in Sumatra, this coffee features hints of dark chocolate and a subtle sweetness. With a medium body and balanced flavor, it is a delightful option for coffee lovers.",
            "price" => 52000,
            "stock" => 110,
            "image" => "product/QpFrtYE8Ko9Md7vXLzRw1Bn5gJXTIVzAuOKC6WZa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Java Coffee",
            "description" => "Java Coffee is synonymous with rich history and exceptional quality. This coffee delivers a strong and full-bodied taste with hints of spice and a smooth finish. Ideal for those who appreciate traditional coffee with a robust flavor profile. Perfect for any time of the day.",
            "price" => 47000,
            "stock" => 85,
            "image" => "product/NlPtYWzAVMKf8oGmZR1B5rTxQKJ9E7OLCX6JdWa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Flores Coffee",
            "description" => "Flores Coffee offers a rich and unique flavor with notes of chocolate and caramel. Grown in the volcanic soils of Flores, Indonesia, this coffee is known for its smooth body and distinct aroma. Perfect for those who enjoy a balanced and flavorful cup.",
            "price" => 50000,
            "stock" => 95,
            "image" => "product/A1QWRYZ5VpLOKmJ68NrfBzXTE7oG4Cd9t6MPFYJa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Bali Blue Moon Coffee",
            "description" => "Bali Blue Moon Coffee offers an exceptional taste with hints of chocolate, vanilla, and spice. Grown in the volcanic soils of Bali, it is known for its smooth and velvety body. This coffee is perfect for those who enjoy unique and exotic flavors. Ideal for both hot and cold brew preparations.",
            "price" => 49000,
            "stock" => 100,
            "image" => "product/XY7ZrMj6Ko8PlvQNRB5WCE9TxYA1MdLf6OVJKXWa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Aceh Coffee",
            "description" => "Aceh Coffee is a rich and bold coffee grown in the northern region of Sumatra. It features a deep, earthy flavor with hints of dark chocolate and spice. Known for its full body and low acidity, it is an excellent choice for those who prefer a strong cup. Perfect for any time of day.",
            "price" => 53000,
            "stock" => 80,
            "image" => "product/FR8Ko5Mz7YLvNWC1XtE9ABJQ6PRMdYOZXVaLKJWa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Papua Wamena Coffee",
            "description" => "Papua Wamena Coffee is grown in the remote highlands of Papua, Indonesia. It offers a mild and clean flavor with floral and nutty undertones. The coffee's smooth texture and low acidity make it a favorite among coffee aficionados. Perfect for enjoying a relaxing and aromatic cup.",
            "price" => 54000,
            "stock" => 75,
            "image" => "product/R5MJKoWXY7Lv1B9ACE6P8FtNZOaQLKOVJMdYzWa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Manggarai Coffee",
            "description" => "Manggarai Coffee is sourced from the volcanic highlands of Flores, Indonesia. It features a complex flavor profile with notes of spices, chocolate, and a hint of floral aroma. This coffee has a medium body and a pleasant, lingering aftertaste. Ideal for those who appreciate a refined coffee experience.",
            "price" => 51000,
            "stock" => 90,
            "image" => "product/L6KYZ8OWa5MFRXJ7v1AC9PQtNYMEVaJoWLXMdKa.jpg",
        ]);
        
        ProductSupplier::create([
            "id_supplier" => 3,
            "product_name" => "Sulawesi Kalossi Coffee",
            "description" => "Sulawesi Kalossi Coffee is known for its bold and full-bodied flavor. This coffee offers a unique combination of earthy and nutty notes with a hint of spice. Grown in the Toraja region of Sulawesi, it is perfect for those who enjoy a strong and robust cup. A must-try for coffee lovers.",
            "price" => 55000,
            "stock" => 65,
            "image" => "product/KW8L1FZ7XY5R9ACME6VaJoOMJdYNXPWLKoMWaKa.jpg",
        ]);
    }
}
