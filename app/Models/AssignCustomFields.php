<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCustomFields extends Model
{
    use HasFactory;
    
    public $timestamps = false;


    protected $fillable = [
        'agreement_id',
        'custom_field_id'
    ];
    
    /**
     * Get the assigned field associated with the custom field.
     */
    public function customfield() {
        return $this->hasOne(CustomFields::class, 'id', 'custom_field_id');
    }
    
}
