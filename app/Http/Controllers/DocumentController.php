<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    /**
     * @param Request $request
     * @return false|string
     */
    public function create(Request $request)
    {
        $validData = Document::validationData($request->all());

        if($validData->passes()) {
            $document = new Document();
            $document->store($request->all());

            return json_encode([
                'success' => true,
                'message' => 'Document created',
                'error'  => $validData->errors(),
            ]);
        }

        return json_encode([
            'success' => false,
            'error'  => $validData->errors(),
        ]);
    }

}
