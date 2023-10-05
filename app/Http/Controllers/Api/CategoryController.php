<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3',
            'slug' => 'required|string|unique:categories',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        } else {

            $category = Category::create([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
            ]);

            if ($category) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Categoria creada'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Error al crear categoría'
                ], 500);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Categoría no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3',
            'slug' => 'required|string|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $category->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Categoría actualizada'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        $force_delete = $request->has('force_delete');
        if ($force_delete) {
            $category->forceDelete();
        } else {
            $category->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Categoría eliminada'
        ], 200);
    }
}