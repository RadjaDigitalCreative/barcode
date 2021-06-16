<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/16/21, 7:31 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Http\Request;

class User extends Controller
{
    private $userService;

    public function __construct
    (
        UserService $userService
    )
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        try {
            $user = $this->userService->all($request);
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
            $user = $this->userService->get($request);
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
            $user = $this->userService->store($request);
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
