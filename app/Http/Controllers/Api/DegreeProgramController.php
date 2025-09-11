<?php

namespace App\Http\Controllers\Api;

use App\Models\DegreeProgram;
use Illuminate\Http\Request;
use App\Http\Requests\DegreeProgramRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DegreeProgramResource;

class DegreeProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $degreePrograms = DegreeProgram::paginate();

        return DegreeProgramResource::collection($degreePrograms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DegreeProgramRequest $request): JsonResponse
    {
        $degreeProgram = DegreeProgram::create($request->validated());

        return response()->json(new DegreeProgramResource($degreeProgram));
    }

    /**
     * Display the specified resource.
     */
    public function show(DegreeProgram $degreeProgram): JsonResponse
    {
        return response()->json(new DegreeProgramResource($degreeProgram));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DegreeProgramRequest $request, DegreeProgram $degreeProgram): JsonResponse
    {
        $degreeProgram->update($request->validated());

        return response()->json(new DegreeProgramResource($degreeProgram));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(DegreeProgram $degreeProgram): Response
    {
        $degreeProgram->delete();

        return response()->noContent();
    }
}
