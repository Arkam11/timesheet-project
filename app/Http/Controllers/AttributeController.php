<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    // List all attributes
    public function index()
    {
        $attributes = Attribute::all();
        return response()->json($attributes);
    }

    // Create a new attribute
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:text,date,number,select',
        ]);

        $attribute = Attribute::create($request->only(['name', 'type']));
        return response()->json($attribute, 201);
    }

    // Get a specific attribute
    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        return response()->json($attribute);
    }

    // Update an attribute
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|in:text,date,number,select',
        ]);

        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->only(['name', 'type']));
        return response()->json($attribute);
    }

    // Delete an attribute
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
        return response()->json(null, 204);
    }
}