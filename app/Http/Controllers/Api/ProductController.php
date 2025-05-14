<?php
/**
 * @OA\Tag(
 *     name="Products",
 *     description="API for managing products"
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use OpenApi\Annotations as OA;
use Illuminate\Support\Facades\Cache;
class ProductController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/products",
 *     tags={"Products"},
 *     summary="List all products",
 *     @OA\Response(response=200, description="Successful operation")
 * )
 */
    public function index()
    {
        return Cache::remember('products_list', 3600, function () {
            return Product::all();
        });
    }
/**
 * @OA\Post(
 *     path="/api/products",
 *     tags={"Products"},
 *     summary="Create a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "sku", "status", "price"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="sku", type="string"),
 *             @OA\Property(property="status", type="string", enum={"active", "inactive"}),
 *             @OA\Property(property="price", type="number", format="float"),
 *             @OA\Property(property="description", type="string", nullable=true)
 *         )
 *     ),
 *     @OA\Response(response=201, description="Product created")
 * )
 */
    public function store(ProductRequest $request)
    {
        Cache::forget('products_list');
        return Product::create($request->validated());

    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, Product $product)
    {
        Cache::forget('products_list');
        $product->update($request->validated());
        return $product;
    }

    public function destroy(Product $product)
    {
        Cache::forget('products_list');
        $product->delete();
        return response()->noContent();
    }
}
