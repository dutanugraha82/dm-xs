<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptoms extends Model
{
    use HasFactory;
    protected $table = 'symptoms';
    protected $fillable = [
        'name',
        'code',
        'min',
        'max',
    ];
}
