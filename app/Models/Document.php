<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function documenttype()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }
}
