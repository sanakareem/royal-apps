<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL', 'https://candidate-testing.api.royal-apps.io/api');
        $this->token = session('api_token');
    }

    public function login($email, $password)
    {
        try {
            $response = Http::post($this->baseUrl . '/v1/token', [
                'email' => $email,
                'password' => $password,
            ]);

            \Log::info('Login response:', ['response' => $response->json()]);

            if ($response->successful()) {
                $data = $response->json();
                session(['api_token' => $data['token_key']]);
                return $data;
            }

            return false;
        } catch (\Exception $e) {
            \Log::error('Login error:', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public function get($endpoint)
    {
        try {
            $response = Http::withToken($this->token)
                           ->get($this->baseUrl . '/v1' . $endpoint);
            
            \Log::info("API GET Response for $endpoint:", ['response' => $response->json()]);
            return $response;
        } catch (\Exception $e) {
            \Log::error("API GET Error for $endpoint:", ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function post($endpoint, $data)
    {
        try {
            $response = Http::withToken($this->token)
                           ->post($this->baseUrl . '/v1' . $endpoint, $data);
            
            \Log::info("API POST Response for $endpoint:", [
                'data' => $data,
                'response' => $response->json()
            ]);
            return $response;
        } catch (\Exception $e) {
            \Log::error("API POST Error for $endpoint:", [
                'data' => $data,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function delete($endpoint)
    {
        try {
            $response = Http::withToken($this->token)
                           ->delete($this->baseUrl . '/v1' . $endpoint);
            
            \Log::info("API DELETE Response for $endpoint:", ['response' => $response->json()]);
            return $response;
        } catch (\Exception $e) {
            \Log::error("API DELETE Error for $endpoint:", ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}