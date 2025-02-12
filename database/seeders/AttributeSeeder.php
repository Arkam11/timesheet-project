<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;


class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'name' => 'department',
            'type' => 'text',
        ]);

        Attribute::create([
            'name' => 'start_date',
            'type' => 'date',
        ]);

        Attribute::create([
            'name' => 'end_date',
            'type' => 'date',
        ]);
    }
}
