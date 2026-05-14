@props(['type' => 'info', 'title' => null, 'message' => null])

@php
    $colors = [
        'success' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-200',
            'text' => 'text-green-900',
            'icon' => 'text-green-600',
            'button' => 'bg-green-600 hover:bg-green-700'
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-200',
            'text' => 'text-red-900',
            'icon' => 'text-red-600',
            'button' => 'bg-red-600 hover:bg-red-700'
        ],
        'warning' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-200',
            'text' => 'text-yellow-900',
            'icon' => 'text-yellow-600',
            'button' => 'bg-yellow-600 hover:bg-yellow-700'
        ],
        'info' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-200',
            'text' => 'text-blue-900',
            'icon' => 'text-blue-600',
            'button' => 'bg-blue-600 hover:bg-blue-700'
        ]
    ];

    $colorScheme = $colors[$type] ?? $colors['info'];
    $defaultTitles = [
        'success' => 'Success!',
        'error' => 'Error!',
        'warning' => 'Warning!',
        'info' => 'Information'
    ];
    $modalTitle = $title ?: ($defaultTitles[$type] ?? 'Message');
@endphp

<!-- Modal Container -->
<div id="messageModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex min-h-screen items-center justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id="modalBackdrop"></div>

        <!-- Modal panel -->
        <div class="inline-block transform overflow-hidden rounded-lg {{ $colorScheme['bg'] }} {{ $colorScheme['border'] }} border px-4 pt-5 pb-4 text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6 sm:align-middle">
            <div class="sm:flex sm:items-start">
                <!-- Icon -->
                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full {{ $colorScheme['bg'] }} sm:mx-0 sm:h-10 sm:w-10">
                    @if($type === 'success')
                        <svg class="h-6 w-6 {{ $colorScheme['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    @elseif($type === 'error')
                        <svg class="h-6 w-6 {{ $colorScheme['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    @elseif($type === 'warning')
                        <svg class="h-6 w-6 {{ $colorScheme['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    @else
                        <svg class="h-6 w-6 {{ $colorScheme['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                </div>

                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 {{ $colorScheme['text'] }}" id="modal-title">
                        {{ $modalTitle }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm {{ $colorScheme['text'] }}" id="modalMessage">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button"
                        class="inline-flex w-full justify-center rounded-md border border-transparent px-4 py-2 text-base font-medium text-white shadow-sm {{ $colorScheme['button'] }} focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                        id="modalCloseBtn">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>