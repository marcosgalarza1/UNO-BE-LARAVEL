<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if (auth()->attempt($credentials)) {
        $user = auth()->user();
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
    return response()->json(['error' => 'Unauthorized'], 401);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $all = $request->boolean('all', false);
    if ($all) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'All tokens revoked successfully'], 200);
    }
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully'], 200);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'restrict:administrador'])->group(function () {
    Route::apiResources([
        'roles' => App\Http\Controllers\Api\RoleController::class,
        'users' => App\Http\Controllers\Api\UserController::class,
        'faculties' => App\Http\Controllers\Api\FacultyController::class,
        'degree-programs' => App\Http\Controllers\Api\DegreeProgramController::class,
        'subjects' => App\Http\Controllers\Api\SubjectController::class,
        'students' => App\Http\Controllers\Api\StudentController::class,
        'enrollments' => App\Http\Controllers\Api\EnrollmentController::class,
    ]);
});
