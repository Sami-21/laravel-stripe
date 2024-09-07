<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Services\StripeService;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public StripeService $stripeService;
    public function __construct(StripeService $stripeService)
    {
        $this->stripeService  = $stripeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = $this->stripeService->getProducts(3);
        return response()->json(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $stripeProduct = $this->stripeService->storeProduct($request->validated());
            Product::create($request->validated());
            return response()->json(['message' => 'Product created with success', 'product' => $stripeProduct], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Product creation failed', 'error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): void
    {
        //
    }
}
