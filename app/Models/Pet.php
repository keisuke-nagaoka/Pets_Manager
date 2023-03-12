<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'kinds',
        'birthday',
        'sex',
        'memos',
        'image',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function managements()
    {
        return $this->hasmany(Management::class);
    }    
}
