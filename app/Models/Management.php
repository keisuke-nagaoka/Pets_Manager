<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'record',
        'register',
        'content',
        'weight',
        'image',
    ];
    
    protected $table = 'managements';
    
    public function pets()
    {
        return $this->belongsTo(Pet::class);
    }
}
