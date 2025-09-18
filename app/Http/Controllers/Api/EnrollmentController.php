<?php

namespace App\Http\Controllers\Api;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Requests\EnrollmentRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollmentResource;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $enrollments = Enrollment::paginate();

        return EnrollmentResource::collection($enrollments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnrollmentRequest $request): JsonResponse
    {
        $enrollment = Enrollment::create($request->validated());

        return response()->json(new EnrollmentResource($enrollment));
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment): JsonResponse
    {
        return response()->json(new EnrollmentResource($enrollment));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnrollmentRequest $request, Enrollment $enrollment): JsonResponse
    {
        $enrollment->update($request->validated());

        return response()->json(new EnrollmentResource($enrollment));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Enrollment $enrollment): Response
    {
        $enrollment->delete();

        return response()->noContent();
    }
}
