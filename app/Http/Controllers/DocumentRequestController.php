<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;

class DocumentRequestController extends Controller
{
    public function create(Request $request)
    {
        $validData = DocumentRequest::validateData($request->all());

        if($validData->passes()) {
            $docRequest = new DocumentRequest();
            $docRequest->store($request->all());

            return json_encode([
                'success' => true,
                'message' => 'Request created',
                'error'  => $validData->errors(),
            ]);
    }

        return json_encode([
           'success' => false,
           'error'  => $validData->errors(),
        ]);
    }
}
