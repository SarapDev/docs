<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $table = 'department';

    public $timestamps = false;

    // Relation

    public function documentrequest()
    {
        return $this->hasMany(DocumentRequest::class, 'department_id');
    }

}
