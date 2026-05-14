<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">
    <div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18]">
        <header class="border-b border-gray-200 bg-white shadow-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div>
                    <a href="{{ route('borrowed-books.index') }}" class="text-lg font-semibold tracking-tight">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="flex items-center gap-3 text-sm">
                    <a href="{{ route('borrowed-books.index') }}"
                        class="rounded-md px-3 py-2 hover:bg-gray-100">Books</a>
                    <a href="{{ route('borrowed-books.create') }}" class="rounded-md px-3 py-2 hover:bg-gray-100">Add
                        Book</a>
                    <a href="{{ route('borrowed-books.trashed') }}"
                        class="rounded-md px-3 py-2 hover:bg-gray-100">Trash</a>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-900">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-900">
                    <p class="font-semibold">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>

</html>
