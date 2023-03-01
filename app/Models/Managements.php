<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managements extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'record',
        'register',
        'content',
        'weight',
        'image',
    ];
    
    public function pets()
    {
        return $this->belongTo(Pets::class);
    }
}
