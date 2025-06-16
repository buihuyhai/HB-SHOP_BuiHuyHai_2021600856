<?php

namespace Modules\Product\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Modules\Product\Models\Category;

// class ProductTableSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $categories = Category::all();
//         for ($i = 0; $i < 200; $i++) {
//             $category = $categories->random();
//             $name = $category->name . ' ' . random_int(100000, 900000);
//             $importPrice = fake()->numberBetween(500, 90000);
//             $price = fake()->numberBetween($importPrice + 1000, 100000);
//             $salePrice = fake()->numberBetween(1000, $price - 500);
//             $productId = DB::table('products')->insertGetId([
//                 'name' => $name,
//                 'price' => $price,
//                 'sale_price' => $salePrice,
//                 'short_desc' => 'Một sản phẩm của Hai_l3ui. Chất lượng sản phẩm hàng đầu.',
//                 'description' => '<div class="Gf4Ro0"><div class="e8lZp3"><p class="QN2lPu">Chào mừng bạn đến với HB-SHOP!!!!! Tất cả sản phẩm HB-SHOP đều được lựa chọn kỹ lưỡng, được bán với giá thành tốt nhất và chất lượng được đảm bảo nhất!

// CHÚC BẠN LUÔN HẠNH PHÚC VÀ CÓ NHỮNG TRẢI NGHIỆM MUA HÀNG TỐT KHI ĐẾN VỚI HB-SHOP!
// <br>
// 📌 Quý khách lưu ý: Do màn hình và điều kiện ánh sáng khác nhau, màu sắc thực tế của sản phẩm có thể chênh lệch khoảng 3-5%.

// #but #bi #butbi #cute #butcute #butbicute #nuoc #muc #butnuoc #butmuc #butmucgel #butbinuoc # butmucden #butdethuong #de #thuong #dethuong #meki #mekistore #vanphongpham #happi #HB-SHOP #deco #lamdep #khuyentai #hoatai #khuyen #linghouse #phukien #thoitrang #bac #vay #trangsuc</p></div></div>',
//                 'sold' => fake()->numberBetween(0, 1000),
//                 'slug' => Str::slug($name) . '-' . md5(Carbon::now()),
//                 'thumbnail' => $category->thumbnail,
//                 'category_id' => $category->id,
//                 'shop_id' => fake()->numberBetween(1, 2),
//                 'user_created' => fake()->numberBetween(1, 10),
//                 'user_updated' => fake()->numberBetween(1, 10),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);

//             $type = ['Loại thường', 'Loại xịn'];

//             foreach (range(1, 2) as $index) {
//                 $variantImportPrice = fake()->numberBetween(500, 90000);
//                 $variantPrice = fake()->numberBetween($variantImportPrice + 1000, 100000);
//                 $variantSalePrice = fake()->numberBetween(1000, $variantPrice - 500);
//                 DB::table('product_variants')->insert([
//                     'product_id' => $productId,
//                     'name' => $type[$index - 1],
//                     'import_price' => $variantImportPrice,
//                     'price' => $variantPrice,
//                     'sale_price' => $variantSalePrice,
//                     'stock' => fake()->numberBetween(500, 1000),
//                     'media_id' => 1,
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ]);
//             }
//         }
//     }
// }
class ProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        for ($i = 0; $i < 200; $i++) {
            $category = $categories->random();
            $name = $category->name . ' ' . random_int(100000, 900000);

            // Logic giá sản phẩm chính
            $importPrice = fake()->numberBetween(500, 50000);
            $price = $importPrice + fake()->numberBetween(1000, 30000);
            $salePrice = fake()->numberBetween($importPrice, $price);

            $productId = DB::table('products')->insertGetId([
                'name' => $name,
                'price' => $price,
                'sale_price' => $salePrice,
                'short_desc' => 'Một sản phẩm của Hai_l3ui. Chất lượng sản phẩm hàng đầu.',
                'description' => '<div class="Gf4Ro0"><div class="e8lZp3"><p class="QN2lPu">Chào mừng bạn đến với HB-SHOP!!!!! Tất cả sản phẩm HB-SHOP đều được lựa chọn kỹ lưỡng, được bán với giá thành tốt nhất và chất lượng được đảm bảo nhất!

CHÚC BẠN LUÔN HẠNH PHÚC VÀ CÓ NHỮNG TRẢI NGHIỆM MUA HÀNG TỐT KHI ĐẾN VỚI HB-SHOP!
<br>
📌 Quý khách lưu ý: Do màn hình và điều kiện ánh sáng khác nhau, màu sắc thực tế của sản phẩm có thể chênh lệch khoảng 3-5%.

#but #bi #butbi #cute #butcute #butbicute #nuoc #muc #butnuoc #butmuc #butmucgel #butbinuoc #butmucden #butdethuong #de #thuong #dethuong #meki #mekistore #vanphongpham #happi #HB-SHOP #deco #lamdep #khuyentai #hoatai #khuyen #linghouse #phukien #thoitrang #bac #vay #trangsuc</p></div></div>',
                'sold' => fake()->numberBetween(0, 1000),
                'slug' => Str::slug($name) . '-' . md5(Carbon::now()->toDateTimeString() . $i),
                'thumbnail' => $category->thumbnail,
                'category_id' => $category->id,
                'shop_id' => fake()->numberBetween(1, 2),
                'user_created' => fake()->numberBetween(1, 10),
                'user_updated' => fake()->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $types = ['Loại thường', 'Loại xịn'];

            foreach ($types as $type) {
                $variantImportPrice = fake()->numberBetween(500, 50000);
                $variantPrice = $variantImportPrice + fake()->numberBetween(1000, 30000);
                $variantSalePrice = fake()->numberBetween($variantImportPrice, $variantPrice);

                DB::table('product_variants')->insert([
                    'product_id' => $productId,
                    'name' => $type,
                    'import_price' => $variantImportPrice,
                    'price' => $variantPrice,
                    'sale_price' => $variantSalePrice,
                    'stock' => fake()->numberBetween(100, 1000),
                    'media_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
