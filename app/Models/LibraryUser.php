<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryUser extends Model
{
  
    use HasFactory;
    protected $table="library_user";
    protected $primaryKey="library_user_id";
}
