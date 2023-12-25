<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFields extends Model {

    use HasFactory;

    protected $fillable = [
        'added_from',
        'name',
        'document_name',
        'description',
        'field_type',
        'field_options'
    ];

    /**
     * Get the assigned field associated with the custom field.
     */
    public function assign() {
        return $this->hasOne(AssignCustomFields::class, 'custom_field_id', 'id');
    }

}
