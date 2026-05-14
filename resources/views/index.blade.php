@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4">
        <div
            class="flex flex-col gap-3 rounded-lg border border-gray-200 bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Borrowed Books</h1>
                <p class="text-sm text-gray-500">Track currently borrowed books, search, and filter by genre.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('borrowed-books.create') }}"
                    class="rounded-md bg-[#1b1b18] px-4 py-2 text-sm font-medium text-white hover:bg-black">Add New Book</a>
                <a href="{{ route('borrowed-books.trashed') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">View Trash</a>
            </div>
        </div>

        <form method="GET" action="{{ route('borrowed-books.index') }}"
            class="grid gap-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm md:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700" for="search">Search</label>
                <input id="search" name="search" value="{{ request('search') }}"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" placeholder="Title or description" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700" for="genre">Genre</label>
                <input id="genre" name="genre" value="{{ request('genre') }}"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" placeholder="e.g. Fiction" />
            </div>
            <div class="flex items-end gap-2">
                <button type="submit"
                    class="w-full rounded-md bg-[#1b1b18] px-4 py-2 text-sm font-medium text-white hover:bg-black">Filter</button>
                <a href="{{ route('borrowed-books.index') }}"
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm hover:bg-gray-50">Reset</a>
            </div>
        </form>

        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Borrower</th>
                        <th class="px-4 py-3 font-medium">Genre</th>
                        <th class="px-4 py-3 font-medium">Due Date</th>
                        <th class="px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $book->title }}</td>
                            <td class="px-4 py-3">{{ $book->borrower_name }}</td>
                            <td class="px-4 py-3">{{ $book->genre ?? '—' }}</td>
                            <td class="px-4 py-3">{{ optional($book->due_at)->format('M d, Y') ?? 'No due date' }}</td>
                            <td class="px-4 py-3 space-x-1">
                                <a href="{{ route('borrowed-books.show', $book) }}"
                                    class="rounded-md bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-200">View</a>
                                <a href="{{ route('borrowed-books.edit', $book) }}"
                                    class="rounded-md bg-blue-600 px-3 py-1 text-xs font-medium text-white hover:bg-blue-700">Edit</a>
                                <form action="{{ route('borrowed-books.destroy', $book) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-md bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-700"
                                        onclick="return confirm('Move this book to trash?')">Trash</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-sm text-gray-500">No borrowed books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $books->withQueryString()->links() }}
        </div>
    </div>
@endsection
