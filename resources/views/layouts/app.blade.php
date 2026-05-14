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
            @yield('content')
        </main>

        <!-- Global Message Modal -->
        <x-message-modal />

        <!-- Hidden inputs for flash messages -->
        @if (session('success'))
            <input type="hidden" id="flashSuccess" value="{{ session('success') }}">
        @endif

        @if (session('error'))
            <input type="hidden" id="flashError" value="{{ session('error') }}">
        @endif

        @if (session('warning'))
            <input type="hidden" id="flashWarning" value="{{ session('warning') }}">
        @endif

        @if (session('info'))
            <input type="hidden" id="flashInfo" value="{{ session('info') }}">
        @endif

        @if ($errors->any())
            <input type="hidden" id="flashValidationErrors" value="{{ json_encode($errors->all()) }}">
        @endif
    </div>

    <script>
        // Modal management
        const messageModal = {
            modal: null,
            backdrop: null,
            closeBtn: null,

            init() {
                this.modal = document.getElementById('messageModal');
                this.backdrop = document.getElementById('modalBackdrop');
                this.closeBtn = document.getElementById('modalCloseBtn');

                if (this.closeBtn) {
                    this.closeBtn.addEventListener('click', () => this.hide());
                }

                if (this.backdrop) {
                    this.backdrop.addEventListener('click', () => this.hide());
                }

                // Close modal on Escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !this.modal.classList.contains('hidden')) {
                        this.hide();
                    }
                });
            },

            show(type, title, message) {
                if (!this.modal) return;

                // Update modal content
                const titleEl = document.getElementById('modal-title');
                const messageEl = document.getElementById('modalMessage');

                if (titleEl) titleEl.textContent = title;
                if (messageEl) messageEl.innerHTML = message;

                // Update modal colors based on type
                const modalPanel = this.modal.querySelector('.inline-block');
                if (modalPanel) {
                    // Remove existing color classes
                    modalPanel.className = modalPanel.className.replace(/bg-\w+-\d+/g, '').replace(/border-\w+-\d+/g,
                        '').replace(/text-\w+-\d+/g, '');

                    const colors = {
                        success: {
                            bg: 'bg-green-50',
                            border: 'border-green-200',
                            text: 'text-green-900'
                        },
                        error: {
                            bg: 'bg-red-50',
                            border: 'border-red-200',
                            text: 'text-red-900'
                        },
                        warning: {
                            bg: 'bg-yellow-50',
                            border: 'border-yellow-200',
                            text: 'text-yellow-900'
                        },
                        info: {
                            bg: 'bg-blue-50',
                            border: 'border-blue-200',
                            text: 'text-blue-900'
                        }
                    };

                    const colorScheme = colors[type] || colors.info;
                    modalPanel.classList.add(colorScheme.bg, colorScheme.border, colorScheme.text);
                }

                // Show modal
                this.modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            },

            hide() {
                if (!this.modal) return;

                this.modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        };

        // Initialize modal when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            messageModal.init();

            // Check for flash messages and show modal
            const flashSuccess = document.getElementById('flashSuccess');
            const flashError = document.getElementById('flashError');
            const flashWarning = document.getElementById('flashWarning');
            const flashInfo = document.getElementById('flashInfo');
            const flashValidationErrors = document.getElementById('flashValidationErrors');

            if (flashSuccess) {
                messageModal.show('success', 'Success!', flashSuccess.value);
            } else if (flashError) {
                messageModal.show('error', 'Error!', flashError.value);
            } else if (flashWarning) {
                messageModal.show('warning', 'Warning!', flashWarning.value);
            } else if (flashInfo) {
                messageModal.show('info', 'Information', flashInfo.value);
            } else if (flashValidationErrors) {
                const errors = JSON.parse(flashValidationErrors.value);
                const errorList = errors.map(error => `<li>${error}</li>`).join('');
                messageModal.show('error', 'Validation Errors',
                    `<p class="font-semibold mb-2">Please fix the following errors:</p><ul class="list-disc pl-5 space-y-1">${errorList}</ul>`
                    );
            }
        });

        // Global function to show messages programmatically
        window.showMessage = function(type, title, message) {
            messageModal.show(type, title, message);
        };
    </script>
</body>

</html>
