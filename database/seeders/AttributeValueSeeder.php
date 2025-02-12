<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttributeValue;


class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeValue::create([
            'attribute_id' => 1, // department
            'entity_id' => 1,    // Project A
            'value' => 'IT',
        ]);

        AttributeValue::create([
            'attribute_id' => 2, // start_date
            'entity_id' => 1,    // Project A
            'value' => '2024-01-01',
        ]);

        AttributeValue::create([
            'attribute_id' => 1, // department
            'entity_id' => 2,    // Project B
            'value' => 'HR',
        ]);

        AttributeValue::create([
            'attribute_id' => 2, // start_date
            'entity_id' => 2,    // Project B
            'value' => '2024-06-01',
        ]);
    }
}
