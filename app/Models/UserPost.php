<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    /** @use HasFactory<\Database\Factories\UserPostFactory> */
    use HasFactory;
    use HasUlids;

}
