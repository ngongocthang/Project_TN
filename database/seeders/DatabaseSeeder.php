<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\UserMeta;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        Category::factory()->count(10)->create();
        Product::factory()->count(20)->create();
        Order::factory()->count(10)->create();
        OrderItem::factory()->count(10)->create();
        Blog::factory()->count(10)->create();
        UserMeta::factory()->count(10)->create();
    }
}
