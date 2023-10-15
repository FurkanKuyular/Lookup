<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function store(AddressCreateRequest $request): JsonResponse
    {
        Address::query()->create($request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function index(): AnonymousResourceCollection
    {
        return AddressResource::collection(Address::all());
    }

    public function update(Address $address, AddressUpdateRequest $request): JsonResponse
    {
        $address->update($request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
