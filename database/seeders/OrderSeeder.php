<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::factory(100)->create();
        $orders->each(function($order) {
            OrderProduct::factory(rand(1, 5))->create([
                'order_id' => $order->id
            ]);
        });
    }
}
