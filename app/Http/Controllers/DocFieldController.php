<?php

namespace App\Http\Controllers;

use App\Models\DocField;
use App\Models\Doc;
use Illuminate\Http\Request;

class DocFieldController extends Controller
{
    // List All Doc Fields
    public function getDocFields()
    {

        $docFields = DocField::get();
        if ($docFields->count() > 0){

            foreach ($docFields as $docField){
                $doc = Doc::find($docField->doc_id);
                // Doc Fields Array
                $docFieldsList[] = ['id'=>$docField->id, 'field_name'=>$docField->field_name, 'field_description'=>$docField->field_description, 'doc_name'=>$doc->name];
            }

            // JSON Response
            return response()->json([
                "message" => "Doc Field(s) found!",
                "message_type" => 1,
                "docFieldsList" => $docFieldsList
            ], 200);
        } else {
            return response()->json([
                "message" => "There is no Doc Field created yet!",
                "message_type" => 2
            ], 200);

        }
    }


    // Create new Doc Field
    public function newDocField(Request $request)
    {

        // Check if all required form fields are not null
        if ($request->doc_id != null && $request->field_name != null && $request->field_description != null){
            // Insert new Doc Field
            $newDocField = new DocField;
            $newDocField->doc_id = $request->doc_id;
            $newDocField->field_name = $request->field_name;
            $newDocField->field_description = $request->field_description;
            $newDocField->save();

            return response()->json([
                "message" => "Doc Field successfully created!",
                "message_type" => 1
            ], 200);
        } else {
            return response()->json([
                "message" => "Some riquired form field is missing. Try again!",
                "message_type" => 2
            ], 400);
        }
        
    }

    // Delete a Doc Field
    public function deleteDocField(Request $request){

        $docField = DocField::find($request->id);
        if($docField->exists()) {
            $docField->delete();

            return response()->json([
              "message" => "Doc Field successfully deleted!",
              "message_type" => 1
            ], 202);
          } else {
            return response()->json([
              "message" => "Doc Field not deleted. Try Again!",
              "message_type" => 2,
            ], 400);
          }
    }
}
