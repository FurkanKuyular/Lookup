<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use http\Exception\RuntimeException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    public function store(PersonCreateRequest $request): JsonResponse
    {
        $person = Person::query()->create($request->validated());

        if (!$person instanceof Person) {
            throw new RuntimeException();
        }

        Cache::delete('persons');

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function index(): AnonymousResourceCollection
    {
        $persons = Cache::rememberForever('persons', function () {
            return Person::all();
        });

        return PersonResource::collection($persons);
    }

    public function update(Person $person, PersonUpdateRequest $request): JsonResponse
    {
        $person->update($request->validated());

        Cache::delete('persons');

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function destroy(Person $person): JsonResponse
    {
        $person->delete();

        Cache::delete('persons');

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
