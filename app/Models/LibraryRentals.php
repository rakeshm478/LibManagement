<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryRentals extends Model
{
    use HasFactory;
    protected $table="library_rentals";
    protected $primaryKey="rental_id";
}
