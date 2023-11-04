<?php

namespace App\Models;

use App\trait\toArrayCamelCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory, toArrayCamelCase;
}

