<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ApiClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('CANDIDATE_API_URL'),
        ]);
    }

    public function login($email, $password)
    {   
        $response = $this->client->post('/api/v2/token', [
            'json' => [
                'email' => $email,
                'password' => $password
            ],
        ]);
        
        $data = json_decode($response->getBody(), true);

        if (isset($data['token_key'])) {
            Session::put('token_key', $data['token_key']);
            return true;
        }
        return false;
    }

    public function getTokenKey()
    {
        return Session::get('token_key');
    }

    public function get($endpoint, $options = [])
    {
        $token = $this->getTokenKey();
        $options['headers']['Authorization'] = "Bearer $token";
        return $this->client->get($endpoint, $options);
    }

    public function post($endpoint, $data, $options = [])
    {   
        $token = $this->getTokenKey();
        $options['headers']['Authorization'] = "Bearer $token";
        $options['json'] = $data;
        return $this->client->post($endpoint, $options);
    }

    public function delete($endpoint, $options = [])
    {
        $token = $this->getTokenKey();
        $options['headers']['Authorization'] = "Bearer $token";
        return $this->client->delete($endpoint, $options);
    }

    public function getAuthor($id)
    {   
        return $this->get("/api/v2/authors/{$id}");
    }

    public function deleteBook($bookId)
    {
        return $this->delete("/api/v2/books/{$bookId}");
    }

    public function getAllAuthors()
    {
        return $this->get('/api/v2/authors');
    }
}
