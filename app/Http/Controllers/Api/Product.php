<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/15/21, 12:52 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\ProductService;
use Illuminate\Http\Request;

class Product extends Controller
{
    private $productService;

    public function __construct
    (
        ProductService $productService
    )
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        try {
            $user = $this->productService->all($request);
            if ($user === null) {
                return response()->json(['status' => 400, 'message' => 'not found']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }
    public function get(Request $request)
    {
        try {
            $user = $this->productService->get($request);
            if ($user === null) {
                return response()->json(['status' => 400, 'message' => 'not found']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = $this->productService->store($request);
            if ($user === null) {
                return response()->json(['status' => 400, 'message' => 'not found']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = $this->productService->update($request);
            if ($user === null) {
                return response()->json(['status' => 400, 'message' => 'not found']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = $this->productService->delete($request);
            if ($user === null) {
                return response()->json(['status' => 400, 'message' => 'not found']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }
}
