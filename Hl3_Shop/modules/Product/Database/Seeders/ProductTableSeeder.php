<?php

namespace Modules\Product\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Modules\Product\Models\Category;


class ProductTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $sampleNames = [
            'Thời trang' => ['Áo sơ mi', 'Áo short', 'Áo ngắn tay', 'Áo thun', 'Áo cổ tròn'],
            'Điện thoại' => ['iPhone 14', 'Samsung Galaxy', 'Oppo Reno', 'Xiaomi Redmi'],
            'Đồ chơi' => ['Lego City', 'Búp bê Barbie', 'Xe điều khiển', 'Ghép hình thông minh'],
            'Đồng hồ' => ['Casio nam', 'G-Shock', 'Apple Watch', 'Đồng hồ dây da'],
            'Gia dụng' => ['Nồi cơm điện', 'Nồi cơm điện sunhouse', 'Nồi cơm điện cao tần'],
            'Giày dép nam' => ['Giày thể thao', 'Giày da', 'Giày sneaker'],
            'Giặt dũ' => ['Nước giặt', 'Bột giặt', 'Nước xả vải'],
            'Làm đẹp' => ['Son dưỡng ẩm', 'Son môi', 'Son lì'],
            'Laptop' => ['Laptop Dell', 'MacBook Pro', 'HP Pavilion'],
            'Máy ảnh' => ['Canon EOS', 'Nikon D3500', 'Fujifilm X-T30'],
            'Mô hình' => ['Mô hình siêu nhân', 'Mô hình Fide', 'Mô hình Dragon Ball'],
            'Nước hoa' => ['Chanel No.5', 'Dior Sauvage', 'Versace Eros'],
            'Phụ kiện' => ['Tai nghe', 'AirPods', 'AirPods pro', 'Tai nghe bluetooth'],
            'Sách' => ['Sách kỹ năng', 'Tiểu thuyết', 'Truyện tranh'],
            'Sức khoẻ' => ['Vitamin C', 'Thuốc giảm đau', 'Thực phẩm chức năng'],
            'Thể thao' => ['Bóng đá', 'Bóng da', 'Bóng đá Adidas'],
            'Trang sức' => ['Dây thắt lưng', 'Dây thắt lưng nam', 'Thắt lưng da'],
            'Ví & Balo' => ['Ví nữ', 'Ví da nam', 'Ví cầm tay'],
            'Xe máy' => ['Xe máy điện', 'Honda SH', 'Yamaha Sirius'],
        ];

        for ($i = 0; $i < 200; $i++) {
            $category = $categories->random();
            $keywords = $sampleNames[$category->name] ?? ['Sản phẩm đặc biệt'];
            $randomName = $keywords[array_rand($keywords)];
            $name = $randomName . ' ' . random_int(1, 1000);

            // Logic giá sản phẩm chính
            $importPrice = fake()->numberBetween(500000, 50000000);
            $price = $importPrice + fake()->numberBetween(100000, 30000000);
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
                $variantImportPrice = fake()->numberBetween(500000, 50000000);
                $variantPrice = (int) ($variantImportPrice * fake()->randomFloat(2, 1.2, 2.0));
                $variantSalePrice = max(
                    $variantImportPrice,
                    (int) ($variantPrice * fake()->randomFloat(2, 0.9, 1.0)) // không thấp hơn import_price
                );

                DB::table('product_variants')->insert([
                    'product_id' => $productId,
                    'name' => $type,
                    'import_price' => $variantImportPrice,
                    'price' => $variantPrice,
                    'sale_price' => $variantSalePrice,
                    'stock' => fake()->numberBetween(10, 10000),
                    'media_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
