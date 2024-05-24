<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function index(Request $request)
    {
        $response = $this->apiClient->get('/api/v2/authors', [
            'query' => [
                'page' => $request->input('page', 1),
                'limit' => 12,
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        $authors = $data['items'];
        $pagination = [
            'total_results' => $data['total_results'],
            'total_pages' => $data['total_pages'],
            'current_page' => $data['current_page'],
            'limit' => $data['limit'],
        ];

        return view('authors.index', compact('authors', 'pagination'));
    }

    // public function show($id)
    // {
    //     $response = $this->apiClient->get("/authors/{$id}");
    //     $author = json_decode($response->getBody(), true);

    //     return view('authors.show', compact('author'));
    // }

    public function show($id)
    {
        $response = $this->apiClient->getAuthor($id);
        $author = json_decode($response->getBody(), true);
        return view('authors.show', compact('author'));
    }

    public function destroy($id)
    {
        $response = $this->apiClient->getAuthor($id);
        $author = json_decode($response->getBody(), true);

        if (count($author['books']) > 0 ) {
            return redirect()->route('authors.index')->withErrors(['message' => 'Cannot delete author with related books.']);
        }
        $this->apiClient->delete("/api/v2/authors/{$id}");

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }


    public function destroyBook($id)
    {
        $this->apiClient->deleteBook($id);
        return redirect()->back()->with('success', 'Book deleted successfully.');
    }

    public function storeBook(Request $request)
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
