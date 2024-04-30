<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use DateTime;

class ProductVariantController extends Controller
{
    public function list(Request $request)
    {
        $products = ProductVariant::with(['product'])->get();

        return response()->json([
            'data' => $products,
        ], 200);
    }

    public function save(Request $request)
    {
        $requestUser = $request->user();
        $newProduct = ProductVariant::create([
            'code' => $request->code,
            'barrcode' => $request->barrcode,
            'active' => $request->active,
            'product_id' => $request->product_id,
            'color' => $request->color,
            'size' => $request->size,
            'brand' => $request->brand,
            'created_by' => $requestUser->id,
            'updated_by' => $requestUser->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto creado correctamente',
            'data' => $newProduct,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $requestUser = $request->user();
        $updatedProduct = ProductVariant::where('id', $id)
            ->update([
                'code' => $request->code,
                'barrcode' => $request->barrcode,
                'active' => $request->active,
                'product_id' => $request->product_id,
                'color' => $request->color,
                'size' => $request->size,
                'brand' => $request->brand,
                'updated_by' => $requestUser->id,
                'updated_at' => new DateTime(),
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado correctamente',
            'data' => $updatedProduct,
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $deletedProduct = ProductVariant::where('id', $id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado correctamente',
            'data' => $deletedProduct,
        ], 200);
    }
}
