<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Timesheet;


class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timesheet::create([
            'task_name' => 'Task 1',
            'date' => now(),
            'hours' => 5,
            'user_id' => 1,
            'project_id' => 1,
        ]);

        Timesheet::create([
            'task_name' => 'Task 2',
            'date' => now(),
            'hours' => 3,
            'user_id' => 2,
            'project_id' => 2,
        ]);
    }
}
