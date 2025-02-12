<?php

namespace App\Http\Controllers;

use App\Services\Api\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->getAllAuthors();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required|date'
        ]);

        try {
            $this->authorService->createAuthor($request->all());
            return redirect()->route('authors.index')
                           ->with('success', 'Author created successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create author']);
        }
    }

    public function show($id)
{
    try {
        $author = $this->authorService->getAuthor($id);
        \Log::info('Author data:', ['author' => $author]);
        return view('authors.show', compact('author'));
    } catch (\Exception $e) {
        \Log::error('Error fetching author:', ['error' => $e->getMessage()]);
        return back()->withErrors(['error' => 'Failed to load author details']);
    }
}
    public function destroy($id)
    {
        $this->authorService->deleteAuthor($id);
        return redirect()->route('authors.index')
                       ->with('success', 'Author deleted successfully');
    }
}