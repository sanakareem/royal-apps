<?php

namespace App\Services\Api;

class BookService
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function createBook($data)
{
    try {
        $response = $this->apiClient->post('/books', $data);
        \Log::info('Book creation response:', ['response' => $response->json()]);
        return $response->json();
    } catch (\Exception $e) {
        \Log::error('Book creation error:', ['error' => $e->getMessage()]);
        throw $e;
    }
}

    public function deleteBook($id)
    {
        return $this->apiClient->delete("/books/{$id}");
    }
}