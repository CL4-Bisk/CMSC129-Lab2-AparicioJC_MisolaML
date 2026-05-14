@extends('layouts.app')

@section('content')
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">{{ $borrowedBooks->title }}</h1>
                <p class="text-sm text-gray-500">Borrowed by {{ $borrowedBooks->borrower_name }}.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('borrowed-books.edit', $borrowedBooks) }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Edit</a>
                <a href="{{ route('borrowed-books.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Back</a>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div class="space-y-3 rounded-lg border border-gray-200 bg-gray-50 p-5">
                <div>
                    <h2 class="text-sm font-semibold text-gray-700">Borrower</h2>
                    <p class="text-sm text-gray-900">{{ $borrowedBooks->borrower_name }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-700">Genre</h2>
                    <p class="text-sm text-gray-900">{{ $borrowedBooks->genre ?? '—' }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-700">Borrowed At</h2>
                    <p class="text-sm text-gray-900">{{ optional($borrowedBooks->borrowed_at)->format('F j, Y h:i A') }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-700">Due Date</h2>
                    <p class="text-sm text-gray-900">{{ optional($borrowedBooks->due_at)->format('F j, Y') ?? 'No due date' }}</p>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-5">
                <h2 class="text-sm font-semibold text-gray-700">Description</h2>
                <p class="mt-2 text-sm leading-6 text-gray-900">{{ $borrowedBooks->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>
@endsection
