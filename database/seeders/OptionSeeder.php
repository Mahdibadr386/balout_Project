<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        $category_id = 1;



        $color = Option::create([
            'category_id' => $category_id,
            'type' => 'multiple_option',
            'name' => 'رنگ',
            'effect' => null,
        ]);

        $size = Option::create([
            'category_id' => $category_id,
            'type' => 'multiple_option',
            'name' => 'سایز',
            'effect' => null,
        ]);

        $material = Option::create([
            'category_id' => $category_id,
            'type' => 'multiple_option',
            'name' => 'جنس',
            'effect' => null,
        ]);


        $children = [
            [$color->id, 'قرمز', 0],
            [$color->id, 'آبی', 0],
            [$color->id, 'سبز', 0],

            [$size->id, 'Small', 0],
            [$size->id, 'Medium', 0],
            [$size->id, 'Large', 0],

            [$material->id, 'کتان', 0],
            [$material->id, 'چرم', 0],
            [$material->id, 'پلی‌استر', 0],
        ];

        foreach ($children as [$parentId, $name, $effect]) {
            Option::create([
                'category_id' => $category_id,
                'type' => 'two_option',
                'name' => $name,
                'effect' => $effect,
            ]);
        }
    }
}
