@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">Trashed Books</h1>
                    <p class="text-sm text-gray-500">Restore or permanently delete soft-deleted entries.</p>
                </div>
                <a href="{{ route('borrowed-books.index') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Back to Books</a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Borrower</th>
                        <th class="px-4 py-3 font-medium">Deleted At</th>
                        <th class="px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $book->title }}</td>
                            <td class="px-4 py-3">{{ $book->borrower_name }}</td>
                            <td class="px-4 py-3">{{ optional($book->deleted_at)->format('M d, Y h:i A') }}</td>
                            <td class="px-4 py-3 space-x-1">
                                <form action="{{ route('borrowed-books.restore', $book->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded-md bg-green-600 px-3 py-1 text-xs font-medium text-white hover:bg-green-700">Restore</button>
                                </form>
                                <form action="{{ route('borrowed-books.forceDelete', $book->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-md bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-700"
                                        onclick="return confirm('Permanently delete this record?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-sm text-gray-500">No trashed books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
@endsection
