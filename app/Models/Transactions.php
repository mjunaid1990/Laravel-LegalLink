<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'added_from',
        'tnx_id',
        'amount',
        'currency',
        'status'
    ];
    
    public function customer() {
        return $this->hasOne(User::class, 'id', 'added_from');
    }
    
}
