<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Produk::leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'produk.*',
                'rating_produk.rating',
            )
            ->get();

        return response()->json([
            'products' => $products,
            'message' => 'Success'
        ], 200);
    }


    public function getAllProductsByUserId($userId)
    {
        $products = DB::table('produk')
            ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'produk.*',
                'rating_produk.rating'
            )
            ->where('produk.id_user', $userId)
            ->get();

        return response()->json([
            'products' => $products,
            'message' => 'Success'
        ], 200);
    }

    public function getProductById($productId)
    {
        $product = DB::table('produk')
            ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'produk.*',
                'rating_produk.*'
            )
            ->where('produk.id', $productId)->orWhere('produk.nama', $productId)
            ->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
            'product' => $product,
            'message' => 'Success'
        ], 200);
    }


    public function getProductByCategory($category)
    {
        $products = DB::table('produk')
            ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'produk.*',
                'rating_produk.rating'
            )
            ->where('kategori', 'like', '%' . $category . '%')
            ->get();

        return response()->json([
            'products' => $products,
            'message' => 'Success'
        ], 200);
    }

    public function getProductByRatingLimitTwo()
    {
        $produk = DB::table('produk')
            ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'produk.*',
                DB::raw('AVG(rating_produk.rating) as rating_rata_rata')
            )
            ->groupBy('produk.id')
            ->orderBy('rating_rata_rata', 'desc')
            ->limit(2)
            ->get();

        return response()->json($produk);
    }
}
