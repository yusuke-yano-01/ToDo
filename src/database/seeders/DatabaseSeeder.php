<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Categoryを先に作成（数を減らす）
        Category::factory(5)->create();
        
        // Todoでは既存のCategoryを使用
        Todo::factory(10)->create();
    }
}
