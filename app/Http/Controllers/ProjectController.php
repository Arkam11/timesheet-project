<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // List all projects with filtering
    public function index(Request $request)
    {
        $query = Project::with('attributeValues.attribute'); // Eager load attributeValues and their related attribute
    
        // Filter by regular attributes
        if ($request->has('filters')) {
            foreach ($request->filters as $key => $value) {
                // Handle operators (e.g., filters[name>]=value)
                if (str_contains($key, '>')) {
                    $column = str_replace('>', '', $key);
                    $query->where($column, '>', $value);
                } elseif (str_contains($key, '<')) {
                    $column = str_replace('<', '', $key);
                    $query->where($column, '<', $value);
                } elseif (str_contains($key, '~')) {
                    $column = str_replace('~', '', $key);
                    $query->where($column, 'LIKE', "%$value%");
                } else {
                    $query->where($key, $value);
                }
            }
        }
    
        // Filter by dynamic attributes
        if ($request->has('attribute_filters')) {
            foreach ($request->attribute_filters as $attributeName => $value) {
                // Handle operators for dynamic attributes (e.g., attribute_filters[start_date>]=2024-01-01)
                if (str_contains($attributeName, '>')) {
                    $attributeName = str_replace('>', '', $attributeName);
                    $operator = '>';
                } elseif (str_contains($attributeName, '<')) {
                    $attributeName = str_replace('<', '', $attributeName);
                    $operator = '<';
                } elseif (str_contains($attributeName, '~')) {
                    $attributeName = str_replace('~', '', $attributeName);
                    $operator = 'LIKE';
                    $value = "%$value%";
                } else {
                    $operator = '=';
                }
    
                $query->whereHas('attributeValues', function ($q) use ($attributeName, $operator, $value) {
                    $q->whereHas('attribute', function ($q) use ($attributeName) {
                        $q->where('name', $attributeName);
                    })->where('value', $operator, $value);
                });
            }
        }
    
        $projects = $query->get();
        return response()->json($projects);
    }

    // Get a specific project
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    // Create a new project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        $project = Project::create($request->only(['name', 'status']));
        return response()->json($project, 201);
    }

    // Update a project
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|in:active,inactive',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->only(['name', 'status']));
        return response()->json($project);
    }

    // Delete a project
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
