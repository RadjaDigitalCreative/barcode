<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/16/21, 8:12 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\LoginService;
use Illuminate\Http\Request;

class Login extends Controller
{
    private $loginService;

    public function __construct
    (
        LoginService $loginService
    )
    {
        $this->loginService = $loginService;
    }
    public function login(Request $request)
    {
        try {
            $user = $this->loginService->login($request);
            if ($user == FALSE) {
                return response()->json(['status' => 400, 'message' => 'credentials unathorized']);
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
    public function register (Request $request)
    {
        try {
            $user = $this->loginService->register($request);
            if ($user == FALSE) {
                return response()->json(['status' => 400, 'message' => 'Email has used']);
            } else {
                return response()->json([
                    'status' => 200,
                    'data' => $user,
                    'message' => 'Email created'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 405, 'message' => 'error', 'error_code' => $e->getMessage()]);
        }
    }
}
