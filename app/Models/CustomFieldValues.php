<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldValues extends Model
{
    use HasFactory;
    
    public $timestamps = false;


    protected $fillable = [
        'transaction_id',
        'agreement_id',
        'custom_field_id',
        'field_value'
    ];
    
}
