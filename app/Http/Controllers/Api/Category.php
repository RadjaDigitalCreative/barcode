<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class Category extends Controller
{
    private $categoryService;

    public function __construct
    (
        CategoryService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        try {
            $user = $this->categoryService->all($request);
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
            $user = $this->categoryService->get($request);
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
            $user = $this->categoryService->store($request);
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
            $user = $this->categoryService->update($request);
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
            $user = $this->categoryService->delete($request);
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
