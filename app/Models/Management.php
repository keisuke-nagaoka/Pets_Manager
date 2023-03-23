<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'record',
        'start_date',
        'end_date',
        'content',
        'weight',
        'image',
        'pet_id', // pets_idからpet_idに変更
    ];
    
    protected $table = 'managements';
    
    public function pet() // petsからpetに変更
    {
        return $this->belongsTo(Pet::class);
    }
}
