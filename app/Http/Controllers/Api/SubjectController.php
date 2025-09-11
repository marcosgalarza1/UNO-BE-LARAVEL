<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subjects = Subject::paginate();

        return SubjectResource::collection($subjects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request): JsonResponse
    {
        $subject = Subject::create($request->validated());

        return response()->json(new SubjectResource($subject));
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject): JsonResponse
    {
        return response()->json(new SubjectResource($subject));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject): JsonResponse
    {
        $subject->update($request->validated());

        return response()->json(new SubjectResource($subject));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Subject $subject): Response
    {
        $subject->delete();

        return response()->noContent();
    }
}
