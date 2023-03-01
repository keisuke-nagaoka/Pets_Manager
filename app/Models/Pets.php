<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
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
        return $this->belongTo(User::class);
    }
    
    public function managements()
    {
        return $this->hasmany(Managements::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('managements');
    }
}
