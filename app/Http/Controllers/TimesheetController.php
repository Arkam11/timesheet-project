<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    // List all timesheets
    public function index()
    {
        $timesheets = Timesheet::all();
        return response()->json($timesheets);
    }

    // Get a specific timesheet
    public function show($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        return response()->json($timesheet);
    }

    // Create a new timesheet
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hours' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        $timesheet = Timesheet::create($request->only(['task_name', 'date', 'hours', 'user_id', 'project_id']));
        return response()->json($timesheet, 201);
    }

    // Update a timesheet
    public function update(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'hours' => 'sometimes|integer|min:1',
            'user_id' => 'sometimes|exists:users,id',
            'project_id' => 'sometimes|exists:projects,id',
        ]);

        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update($request->only(['task_name', 'date', 'hours', 'user_id', 'project_id']));
        return response()->json($timesheet);
    }

    // Delete a timesheet
    public function destroy($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->delete();
        return response()->json(null, 204);
    }
}