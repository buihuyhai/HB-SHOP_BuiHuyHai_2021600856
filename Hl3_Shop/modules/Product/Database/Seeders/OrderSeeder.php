<?php

namespace Modules\Product\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orderIds = [];

        // Lặp 2 đơn hàng
        foreach (range(1, 2) as $index) {
            $orderDetails = [];
            $totalCost = 0;

            // Số lượng sản phẩm trong mỗi đơn
            $numItems = fake()->numberBetween(1, 3);
            for ($i = 0; $i < $numItems; $i++) {
                $variantId = fake()->numberBetween(1, 149);
                $quantity = fake()->numberBetween(1, 10);
                $importPrice = fake()->numberBetween(10000, 5000000);
                $salePrice = (int) ($importPrice * fake()->randomFloat(2, 1.1, 2.0)); // sale > import
                $subtotal = $salePrice * $quantity;

                $orderDetails[] = [
                    'variant_id' => $variantId,
                    'quantity' => $quantity,
                    'import_price' => $importPrice,
                    'sale_price' => $salePrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $totalCost += $subtotal;
            }

            // Chiết khấu không quá 30%
            $maxDiscount = (int) ($totalCost * 0.3);
            $discount = fake()->numberBetween(0, $maxDiscount);
            $finalCost = $totalCost - $discount;

            // Thêm đơn hàng
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => 1,
                'shop_id' => fake()->numberBetween(1, 2),
                'discount' => $discount,
                'final_cost' => $finalCost,
                'order_date' => now(),
                'email' => "fake_email@gmail.com",
                'address' => fake()->address(),
                'phone_number' => fake()->phoneNumber(),
                'description' => fake()->sentence(),
                'status' => fake()->numberBetween(0, 2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Thêm chi tiết đơn hàng
            foreach ($orderDetails as $detail) {
                $detail['order_id'] = $orderId;
                DB::table('order_detail')->insert($detail);
            }
        }
    }
}
