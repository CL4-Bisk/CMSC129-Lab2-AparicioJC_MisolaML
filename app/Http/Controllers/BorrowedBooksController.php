<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBooks;
use Illuminate\Http\Request;

class BorrowedBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BorrowedBooks::query();

        //Search by borrower name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'ILIKE', "%{$search}%")
                ->orWhere('description', 'ILIKE', "%{$search}%");
            });
        }

        //Filter by genre
        if ($request->has('genre') && $request->genre != '') {
            $query->where('genre', $request->genre);
        }

        $books = $query->latest()->paginate(10)->withQueryString();
        return view('borrowed-books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('borrowed-books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'borrower_name' => 'required|string|max:255',
            'genre'         => 'nullable|string',
            'due_at'        => 'nullable|date|after:today',
        ]);

        BorrowedBooks::create($validated);
        return redirect()->route('borrowed-books.index')
                         ->with('success', 'Book Borrowed! You actually tracked it!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowedBooks $borrowedBooks)
    {
        return view('borrowed-books.show', compact('borrowedBooks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowedBooks $borrowedBooks)
    {
        return view('borrowed-books.edit', compact('borrowedBooks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BorrowedBooks $borrowedBooks)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'borrower_name' => 'required|string|max:255',
            'genre'         => 'nullable|string',
            'due_at'        => 'nullable|date|after:today',
        ]);

        $borrowedBooks->update($validated);

        return redirect()->route('borrowed-books.index')
                     ->with('success', 'Successfylly Updated!');
    }

    /**
     * Soft delete the specified menu item.
     */
    public function destroy(BorrowedBooks $borrowedBooks)
    {
        $borrowedBooks->delete(); // Soft delete

        return redirect()->route('borrowed-books.index')
                        ->with('success', 'Book moved to trash!');
    }

    /**
     * Display trashed menu items.
     */
    public function trashed()
    {
        $books = BorrowedBooks::onlyTrashed()->latest()->paginate(10);
        return view('borrowed-books.trashed', compact('books'));
    }

    /**
     * Restore a soft-deleted menu item.
     */
    public function restore($id)
    {
        $borrowedBooks = BorrowedBooks::onlyTrashed()->findOrFail($id);
        $borrowedBooks->restore();

        return redirect()->route('borrowed-books.trashed')
                        ->with('success', 'Book restored successfully!');
    }

    /**
     * Permanently delete a menu item.
     */
    public function forceDelete($id)
    {
        $borrowedBooks = BorrowedBooks::onlyTrashed()->findOrFail($id);
        $borrowedBooks->forceDelete(); // Permanent delete

        return redirect()->route('borrowed-books.trashed')
                        ->with('success', 'The book is untracked, gin balik na!');
    }
}
