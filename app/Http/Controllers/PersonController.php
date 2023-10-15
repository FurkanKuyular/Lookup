<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use http\Exception\RuntimeException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    public function store(PersonCreateRequest $request): JsonResponse
    {
        $person = Person::query()->create($request->validated());

        if (!$person instanceof Person) {
            throw new RuntimeException();
        }

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function index(): AnonymousResourceCollection
    {
        return PersonResource::collection(Person::all());
    }

    public function update(Person $person, PersonUpdateRequest $request): JsonResponse
    {
        $person->update($request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function destroy(Person $person): JsonResponse
    {
        $person->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
