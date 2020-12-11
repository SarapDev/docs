<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function documentRequest(Request $request)
    {
        $department = Department::find($request->id);
        if($department) {
            $response = [];
            $documentRequest = $department->documentrequest;
            foreach ($documentRequest as $item) {
                $response['name'] = $item->name;
                $response['document_id'] = $item->document_id;
                $response['user_id'] = $item->user_id;
            }

            return json_encode([
               'success' => true,
               'message' => [
                   'department_id' => $department->id,
                   'department_request' => $response,
               ],
               'error' => [],
            ]);
        }

        return json_encode([
           'success' => false,
           'error' => [
               'Department not found'
           ]
        ]);
    }
}
