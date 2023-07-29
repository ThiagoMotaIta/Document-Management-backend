<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\DocField;
use Illuminate\Http\Request;

class DocController extends Controller
{
    
    // List All Docs
    public function getDocs()
    {

        $docs = Doc::get();
        if ($docs->count() > 0){

            foreach ($docs as $doc){
                // Docs Array
                $docsList[] = ['id'=>$doc->id, 'doc_name'=>$doc->name, 'doc_template'=>$doc->template, 'doc_resume'=>$doc->resume];
            }

            // JSON Response
            return response()->json([
                "message" => "Doc(s) found!",
                "message_type" => 1,
                "docsList" => $docsList
            ], 200);
        } else {
            return response()->json([
                "message" => "There is no Doc created yet!",
                "message_type" => 2,
            ], 200);

        }
    }


    // Create new Doc
    public function newDoc(Request $request)
    {

        // Check if all required form fields are not null
        if ($request->name != null && $request->template != null && $request->resume != null){
            // Insert new Doc
            $newDoc = new Doc;
            $newDoc->name = $request->name;
            $newDoc->template = $request->template;
            $newDoc->resume = $request->resume;
            $newDoc->save();

            return response()->json([
                "message" => "Doc successfully created!",
                "message_type" => 1
            ], 200);
        } else {
            return response()->json([
                "message" => "Some riquired form field is missing. Try again!",
                "message_type" => 2
            ], 400);
        }
        
    }

    // Delete a Doc
    public function deleteDoc(Request $request){

        $doc = Doc::find($request->id);
        if($doc->exists()) {
            
            $docFields = DocField::where("doc_id", "=", $doc->id)->get();

            // If Doc has field(s), delete it(them)
            if ($docFields->count() > 0){
                foreach ($docFields as $docField){
                    $docField->delete();
                }
            }

            // Delete doc after checking doc fields
            $doc->delete();

            return response()->json([
              "message" => "Doc successfully deleted!",
              "message_type" => 1
            ], 202);
          } else {
            return response()->json([
              "message" => "Doc not deleted. Try Again!",
              "message_type" => 2
            ], 400);
          }
    }


    // Download a Doc
    public function downLoadDoc(Request $request){

        $doc = Doc::find($request->id);
        $docFields = DocField::where("doc_id", "=", $doc->id)->get();

        if ($docFields->count() > 0){

            foreach ($docFields as $docField){
                // Data Array
                $docFieldsList[] = ['field_name'=>$docField->field_name];
            }

            // JSON Response
            return response()->json([
                "message" => "PDF Document generated and read to download!",
                "message_type" => 1,
                "doc_name" => $doc->name,
                "docFieldsList" => $docFieldsList
            ], 200);
        } else {
            return response()->json([
                "message" => "PDF Document generated, but there is no Field created yet!",
                "message_type" => 2,
                "doc_name" => $doc->name
            ], 200);

        }
    }

}
