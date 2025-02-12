<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class ProjectAttributeController extends Controller
{
    // Set attribute values for a project
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'attributes' => 'required|array',
            'attributes.*.attribute_id' => 'required|exists:attributes,id',
            'attributes.*.value' => 'required|string',
        ]);

        foreach ($request->attributes as $attr) {
            AttributeValue::updateOrCreate(
                [
                    'attribute_id' => $attr['attribute_id'],
                    'entity_id' => $project->id,
                ],
                [
                    'value' => $attr['value'],
                ]
            );
        }

        return response()->json($project->attributeValues, 201);
    }

    // Fetch attribute values for a project
    public function index(Project $project)
    {
        $attributes = $project->attributeValues()->with('attribute')->get();
        return response()->json($attributes);
    }
}
