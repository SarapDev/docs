<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $table = 'document_requests';

    protected $fillable = [
        'name', 'user_id', 'department_id', 'document_id', 'created_at', 'updated_at'
    ];


    /**
     * @param array $data
     * @return string
     */
    public function store(array $data)
    {
        $userIdArray = explode(',',$data['user_id']);
        foreach($userIdArray as $item) {
            $user = User::find($item);
            if($user) {
                $request = new $this;
                $request->name = $data['name'];
                $request->department_id = $user->department_id;
                $request->user_id = $item;
                $request->document_id = $data['document_id'];

                $request->save();
            }
        }
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validateData(array $data)
    {
        return Validator::make($data, [
            'name'  => 'required|string',
            'user_id' => 'required',
            'document_id' => 'required|integer',
        ]);
    }

    // Relation

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
