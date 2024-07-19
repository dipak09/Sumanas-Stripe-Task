<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Dell XPS 13', 'price' => 999.00, 'description' => ' Ultra-thin and lightweight laptop with a stunning 13.4-inch InfinityEdge display, powered by Intel\'s latest processors. Ideal for professionals and students.'],
            ['name' => 'Dell Inspiron 15 3000', 'price' => 429.10, 'description' => 'Affordable and reliable 15.6-inch laptop, featuring Intel or AMD processors, ample storage, and a variety of configuration options. Suitable for everyday tasks.'],
            ['name' => 'Dell G5 15 Gaming Laptop', 'price' => 799.50, 'description' => 'Powerful 15.6-inch gaming laptop with high-performance NVIDIA GeForce GTX graphics, fast processors, and advanced cooling technology. Perfect for gamers.'],
            ['name' => 'HP Spectre x360', 'price' => 1199.00, 'description' => 'Premium 2-in-1 convertible laptop with a 13.3-inch or 15.6-inch 4K UHD display, Intel Core processors, and a sleek, lightweight design. Great for creative professionals.'],
            ['name' => 'HP Pavilion 14', 'price' => 599.00, 'description' => 'Versatile 14-inch laptop with a balance of performance and portability, featuring Intel or AMD processors and a full HD display. Ideal for work and entertainment.'],
            ['name' => 'HP Omen 15', 'price' => 1199.00, 'description' => 'High-performance gaming laptop with a 15.6-inch display, powerful NVIDIA GeForce RTX graphics, and advanced cooling solutions. Designed for serious gamers.'],
            ['name' => 'Lenovo ThinkPad X1 Carbon', 'price' => 1299.00, 'description' => 'Business-class 14-inch ultrabook with a durable, lightweight design, powerful Intel Core processors, and extensive security features. Perfect for professionals on the go.'],
            ['name' => 'Lenovo IdeaPad 3', 'price' => 399.20, 'description' => 'Budget-friendly 15.6-inch laptop offering decent performance with Intel or AMD processors, a full HD display, and ample storage options. Suitable for everyday use.'],
            ['name' => 'Lenovo Legion 5', 'price' => 999.00, 'description' => 'Gaming laptop with a 15.6-inch display, NVIDIA GeForce GTX or RTX graphics, and high-performance AMD Ryzen or Intel Core processors. Ideal for gaming enthusiasts.'],
        ]);
    }
}
