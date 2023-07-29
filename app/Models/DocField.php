<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocField extends Model
{
    protected $fillable = [
        'doc_id ',
        'field_name',
        'field_description',
    ];
}
