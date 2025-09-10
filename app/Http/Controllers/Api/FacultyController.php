<?php

namespace App\Http\Controllers\Api;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Requests\FacultyRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\FacultyResource;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $faculties = Faculty::paginate();

        return FacultyResource::collection($faculties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultyRequest $request): JsonResponse
    {
        $faculty = Faculty::create($request->validated());

        return response()->json(new FacultyResource($faculty));
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty): JsonResponse
    {
        return response()->json(new FacultyResource($faculty));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyRequest $request, Faculty $faculty): JsonResponse
    {
        $faculty->update($request->validated());

        return response()->json(new FacultyResource($faculty));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Faculty $faculty): Response
    {
        $faculty->delete();

        return response()->noContent();
    }
}
