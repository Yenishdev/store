<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            'Monitors',
            'Keyboards',
            'Mobiles',
            'Mouses',
            'Printers',
            'Scaners',
            'Gaming Laptop',
            'Notebook',
            'PC',
        ];
        foreach ($objs as $obj) {
            Category::create([
                'name' => $obj,
                'slug' => str($obj)->slug(),
            ]);
        }
    }
}
