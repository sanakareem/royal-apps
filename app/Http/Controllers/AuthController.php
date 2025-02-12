<?php

namespace App\Http\Controllers;

use App\Services\Api\ApiClient;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $data = $this->apiClient->login(
                $request->input('email'),
                $request->input('password')
            );
            
            session(['user_data' => $data['user']]);
            return redirect()->route('authors.index');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        session()->forget(['api_token', 'user_data']);
        return redirect()->route('login');
    }
}