# Global Message Modal System

This Laravel application now includes a global modal system for displaying messages to users. The modal replaces the traditional inline flash message displays with a more modern, accessible modal interface.

## Features

- **4 Message Types**: Success, Error, Warning, and Info
- **Auto-Display**: Automatically shows when flash messages are set
- **Keyboard Support**: Press Escape to close the modal
- **Click Outside**: Click the backdrop to close
- **Responsive Design**: Works on all screen sizes
- **Tailwind CSS**: Styled with Tailwind CSS classes
- **Accessibility**: Proper ARIA attributes and focus management

## Usage

### Setting Flash Messages in Controllers

Use Laravel's session flash messages with specific keys:

```php
// Success message
return redirect()->back()->with('success', 'Operation completed successfully!');

// Error message
return redirect()->back()->with('error', 'Something went wrong!');

// Warning message
return redirect()->back()->with('warning', 'Please be careful with this action!');

// Info message
return redirect()->back()->with('info', 'Here is some useful information.');
```

### Programmatic Usage

You can also show messages programmatically using JavaScript:

```javascript
// Show a success message
window.showMessage('success', 'Success!', 'Your changes have been saved.');

// Show an error message
window.showMessage('error', 'Error!', 'Failed to save changes.');

// Show a warning
window.showMessage('warning', 'Warning!', 'This action cannot be undone.');

// Show info
window.showMessage('info', 'Information', 'Please review the documentation.');
```

## Message Types

| Type | Color Scheme | Use Case |
|------|-------------|----------|
| `success` | Green | Successful operations, confirmations |
| `error` | Red | Errors, validation failures, failures |
| `warning` | Yellow | Warnings, destructive actions, cautions |
| `info` | Blue | Information, tips, general messages |

## Technical Implementation

### Components

- **Modal Component**: `resources/views/components/message-modal.blade.php`
- **Layout Integration**: Updated `resources/views/layouts/app.blade.php`

### JavaScript Features

- Modal initialization on DOM load
- Automatic flash message detection
- Dynamic color scheme updates
- Keyboard and mouse event handling
- Body scroll prevention when modal is open

### CSS Classes

The modal uses dynamic Tailwind CSS classes that change based on message type:

- Success: `bg-green-50`, `border-green-200`, `text-green-900`
- Error: `bg-red-50`, `border-red-200`, `text-red-900`
- Warning: `bg-yellow-50`, `border-yellow-200`, `text-yellow-900`
- Info: `bg-blue-50`, `border-blue-200`, `text-blue-900`

## Examples in Current Codebase

The BorrowedBooksController has been updated to use different message types:

```php
// Success for creation
->with('success', 'Book Borrowed! You actually tracked it!');

// Success for updates
->with('success', 'Successfully Updated!');

// Warning for soft deletes
->with('warning', 'Book moved to trash!');

// Info for permanent deletes
->with('info', 'The book is untracked, gin balik na!');
```

## Testing

A test route has been added for demonstration:
- Visit: `http://127.0.0.1:8000/test-modal`
- This will redirect to the books index with a warning message

## Future Enhancements

- Add auto-dismiss functionality with timers
- Support for multiple queued messages
- Custom icons for different message types
- Sound notifications (optional)
- Toast-style notifications as alternative