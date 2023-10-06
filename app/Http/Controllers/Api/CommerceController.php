<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Commerce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommerceController extends Controller
{
    public function index(Request $request)
    {
        // el enunciado dice 'traer todos los datos' hay que traer comercios y categorias?
        $commerces = Commerce::query();

        if ($request->has('nombre')) {
            $commerces = $commerces->where('nombre', 'like', '%' . $request->nombre . '%');
        }
        // validar que started_at y ended_at tengan fechas validas
        if ($request->has('started_at') && $request->has('ended_at')) {
            $commerces = $commerces->whereBetween('created_at', [$request->started_at, $request->ended_at]);
        }
        if ($request->has('categoria')) {
            $category = Category::where('slug', $request->categoria)->first();
            $commerces = $commerces->where('categoria', $category->id);
        }

        return response()->json([
            'status' => 200,
            'commerces' => $commerces->get()
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3',
            'slug' => 'required|string|unique:commerces',
            // validar que no tenga espacios?
            'descripcion' => 'string|max:190',
            // 'imagen' => 'required',
            'categoria' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        } else {
            $commerce = Commerce::create([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                // 'imagen' => $request->imagen,
                'categoria' => $request->categoria
            ]);

            if ($commerce) {

                return response()->json([
                    'status' => 200,
                    'message' => 'Comercio creado'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Error al crear comercio'
                ], 500);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $slug)
    {
        $commerce = Commerce::where('slug', $slug)->first();
        if (Auth::check()) {
            // está logueado
            return response()->json("Usuario logueado!!!!!!!!");
        }
        if ($commerce) {
            return response()->json([
                'status' => 200,
                'commerce' => $commerce
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Comercio no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $commerce = Commerce::find($id);
        if (!$commerce) {
            return response()->json([
                'status' => 404,
                'message' => 'Comercio no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3',
            'slug' => 'required|string|unique:commerces',
            'descripcion' => 'string|max:190',
            // 'imagen' => 'required',
            // 'categoria_asociada' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $commerce->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Comercio actualizado'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $commerce = Commerce::find($id);
        if (!$commerce) {
            return response()->json([
                'status' => 404,
                'message' => 'Comercio no encontrado'
            ], 404);
        }

        $force_delete = $request->has('force_delete');
        if ($force_delete) {
            $commerce->forceDelete();
        } else {
            $commerce->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Comercio eliminado'
        ], 200);
    }
}