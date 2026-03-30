<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowedBooks extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'genre',
        'description',
        'borrower_name',
        'borrowed_at',
        'due_at',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_at' => 'datetime',
    ];
}
