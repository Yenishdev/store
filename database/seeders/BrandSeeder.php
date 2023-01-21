<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs =
            [
                'Apple',
                'Xiaomi',
                'Samsung',
                'HP',
                'Asus',
                'Sony',
                'Blu',
                'Acer',
                'HTC',
                'LG',
                'Dell',
                'Beko',
            ];
        foreach ($objs as $obj){
            Brand::create([
                'name' => $obj,
                'slug' => str($obj)->slug(),
            ]);
        }
    }
}
