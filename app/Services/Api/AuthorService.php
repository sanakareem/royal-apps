<?php

namespace App\Services\Api;

class AuthorService
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getAllAuthors()
    {
        return $this->apiClient->get('/authors')->json();
    }

    public function getAuthor($id)
    {
        return $this->apiClient->get("/authors/{$id}")->json();
    }

    public function deleteAuthor($id)
    {
        return $this->apiClient->delete("/authors/{$id}");
    }

    public function createAuthor($data)
    {
        return $this->apiClient->post('/authors', $data);
    }
}