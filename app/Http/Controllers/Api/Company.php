<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/15/21, 1:42 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CompanyService;
use Illuminate\Http\Request;

class Company extends Controller
{
    private $companyService;

    public function __construct
    (
        CompanyService $companyService
    )
    {
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        try {
            $user = $this->companyService->all($request);
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
            $user = $this->companyService->get($request);
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
            $user = $this->companyService->store($request);
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
            $user = $this->companyService->update($request);
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
            $user = $this->companyService->delete($request);
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
