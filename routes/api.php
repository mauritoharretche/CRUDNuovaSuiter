<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommerceController;


Route::post('/auth/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $user = auth()->user();
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json(['token' => $token], 200);
    } else {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
});

Route::post('/auth/register', function (Request $request) {
    // Validar y crear el nuevo usuario
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    $token = $user->createToken('token-name')->plainTextToken;
    return response()->json(['token' => $token], 201);
}); //->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('commerces', [CommerceController::class, 'index']);
Route::get('commerces/{slug}', [CommerceController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('commerces', [CommerceController::class, 'store']);
    Route::put('commerces/{id}', [CommerceController::class, 'update']);
    Route::delete('commerces/{id}', [CommerceController::class, 'destroy']);
});

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{slug}', [CategoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
});