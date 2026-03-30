# CMSC 129 Lab2 MVC with Laravel Framework

> [!NOTE]
> This project is still in development!

## Description
An app that lets the user track lended books. Can be extended to let other people view available books to borrow.

## Features
- Adds books borrowed with fields:
    - Title of the book
    - Tags (for filtering)
    - Description of the book
    - Who borrowed the book
    - When was the book borrowed
    - Due date of the book

- Book archives will store the details of the returned book
- Deleting in archives will delete the book details permanently
- Pages
    - Listed items with filter
    - Expanded view of the items:
        - Has the information inputted in the fields as well as timestamp of when is it created
    - Field input
    - Archives - acts as a soft delete page, list of books with option to delete
