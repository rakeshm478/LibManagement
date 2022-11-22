<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBooks extends Model
{
    use HasFactory;
    protected $table="library_books";
    protected $primaryKey="book_id";
}
