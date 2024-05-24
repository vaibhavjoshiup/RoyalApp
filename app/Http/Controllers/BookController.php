<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function create()
    {
        $response = $this->apiClient->getAllAuthors();
        $authors = json_decode($response->getBody(), true)['items'];
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'nullable|string',
            'isbn' => 'required|string|max:255',
            'format' => 'required|string|max:255',
            'number_of_pages' => 'required|integer',
            'author_id' => 'required|integer',
        ]);
        $jsonData = [
            'author' => [
                'id' => $data['author_id'],
            ],
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'description' => $data['description'],
            'isbn' => $data['isbn'],
            'format' => $data['format'],
            'number_of_pages' => (int) $data['number_of_pages'],
        ];
    
        $this->apiClient->post('/api/v2/books', $jsonData);
        return redirect()->route('authors.show', $data['author_id'])->with('success', 'Book added successfully.');
    }
}
