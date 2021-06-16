<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/16/21, 7:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\BarcodeService;
use Illuminate\Http\Request;

class Barcode extends Controller
{
    private $barcodeService;

    public function __construct
    (
        BarcodeService $barcodeService
    )
    {
        $this->barcodeService = $barcodeService;
    }
    public function index(Request $request)
    {
        try {
            $user = $this->barcodeService->all($request);
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
            $user = $this->barcodeService->get($request);
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
            $user = $this->barcodeService->store($request);
            if ($user == false) {
                return response()->json(['status' => 400, 'message' => 'not found']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user,
                    'message' => 'Succes Generate Code'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = $this->userService->update($request);
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
            $user = $this->userService->delete($request);
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
