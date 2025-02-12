<?php

namespace App\Http\Controllers;

use App\Services\Api\BookService;
use App\Services\Api\AuthorService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;
    protected $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    public function create(Request $request)
    {
        $authors = $this->authorService->getAllAuthors();
        $selected_author_id = $request->query('author_id');
        return view('books.create', compact('authors', 'selected_author_id'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'release_date' => 'required|date',
        'description' => 'required',
        'isbn' => 'required',
        'format' => 'required|in:hardcover,paperback',
        'author_id' => 'required',
        'number_of_pages' => 'required|numeric' 
    ]);

    try {
        $bookData = [
            'author' => [
                'id' => $request->author_id
            ],
            'title' => $request->title,
            'release_date' => $request->release_date,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'format' => $request->format,
            'number_of_pages' => (int)$request->number_of_pages 
        ];

        $this->bookService->createBook($bookData);
        return redirect()->route('authors.show', $request->author_id)
                        ->with('success', 'Book created successfully');
    } catch (\Exception $e) {
        \Log::error('Book creation error:', ['error' => $e->getMessage()]);
        return back()->withErrors(['error' => 'Failed to create book']);
    }
}

    public function destroy($id)
    {
        try {
            $this->bookService->deleteBook($id);
            return back()->with('success', 'Book deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete book']);
        }
    }
}