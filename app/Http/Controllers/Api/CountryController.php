<?php


namespace App\Http\Controllers\Api;
use App\Http\Requests\CountryRequest;
use App\Http\Controllers\Controller;
use App\Models\Country;
use OpenApi\Annotations as OA;

class CountryController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/countries",
 *     tags={"Countries"},
 *     summary="List all countries",
 *     @OA\Response(response=200, description="Successful operation")
 * )
 */
    public function index()
    {
        return Country::all();
    }
/**
 * @OA\Post(
 *     path="/api/countries",
 *     tags={"Countries"},
 *     summary="Create a new country",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","code"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="code", type="string", example="US")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Country created")
 * )
 */
    public function store(CountryRequest $request)
    {
        return Country::create($request->validated());
    }

    public function show(Country $country)
    {
        return $country;
    }
/**
 * @OA\Put(
 *     path="/api/countries/{id}",
 *     tags={"Countries"},
 *     summary="Update a country",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="code", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Country updated")
 * )
 */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        return $country;
    }
/**
 * @OA\Delete(
 *     path="/api/countries/{id}",
 *     tags={"Countries"},
 *     summary="Delete a country",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=204, description="Country deleted")
 * )
 */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->noContent();
    }
}
