@extends('layouts.app')

@section('content')
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Edit Borrowed Book</h1>
                <p class="text-sm text-gray-500">Update the information and save changes.</p>
            </div>
            <a href="{{ route('borrowed-books.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Back</a>
        </div>

        <form action="{{ route('borrowed-books.update', $borrowedBooks) }}" method="POST" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700" for="title">Title</label>
                <input id="title" name="title" value="{{ old('title', $borrowedBooks->title) }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" required />
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700" for="borrower_name">Borrower Name</label>
                <input id="borrower_name" name="borrower_name" value="{{ old('borrower_name', $borrowedBooks->borrower_name) }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" required />
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700" for="genre">Genre</label>
                <input id="genre" name="genre" value="{{ old('genre', $borrowedBooks->genre) }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" placeholder="e.g. Fiction" />
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700" for="description">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ old('description', $borrowedBooks->description) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700" for="due_at">Due Date</label>
                <input id="due_at" name="due_at" type="date" value="{{ old('due_at', optional($borrowedBooks->due_at)->format('Y-m-d')) }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" />
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="rounded-md bg-[#1b1b18] px-4 py-2 text-sm font-medium text-white hover:bg-black">Update</button>
                <a href="{{ route('borrowed-books.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
