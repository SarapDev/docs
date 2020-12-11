<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    public $timestamps = false;

    protected $fillable = [
      'document_type_id', 'is_active', 'title', 'description', 'is_signed'
    ];

    /**
     * @param array $request
     */
    public function store(array $request)
    {
        $this->document_type_id = $request['document_type_id'];
        $this->is_active = $request['is_active'];
        $this->title = $request['title'];
        $this->is_signed = 0;
        $this->description = isset($request['description']) ? $request['description'] : '';

        $this->save();
    }

    public function signedDocument()
    {
        //
    }


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validationData(array  $request)
    {
        return Validator::make($request, [
            'document_type_id'  => 'required',
            'is_active' => 'required|integer',
            'title' => 'required|string',
        ]);
    }

    // Relationship

    public function documenttype()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function documentrequest()
    {
        return $this->hasMany(DocumentRequest::class, 'document_id');
    }
}
