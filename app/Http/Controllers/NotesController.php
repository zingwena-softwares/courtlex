<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientCase;
use App\Models\Notes;
class NotesController extends Controller
{
       // get all cases
       public function notes(){
        return response([

            'notes' => Notes::orderBy('created_at', 'desc')->where('user_id', auth()->user()->id)->get()
        ], 200);
    }

    public function store(Request $request){

        //validate fields
        $attrs = $request->validate([
                  'type' => 'required|string',
                  'type_subject' => 'required|string',
                  'title' => 'required|string',
                  'date'=>'required|string',
                  'detail' => 'required|string',


        ]);
      
        $notes = Notes::create([
            'user_id' => auth()->user()->id,
            'type' => $attrs['type'],
            'type_subject' => $attrs['type_subject'],
            'title' => $attrs['title'],
            'date' => $attrs['date'],
            'detail' => $attrs['detail'],

            
        ]);

        return response([
            'message' => 'Note Created.',
            'Note' => $notes,
        ], 200);
    }

    public function update(Request $request, $id){
        $notes = Notes::find($id);

        if(!$notes)
        {
            return response([
                'message' => 'Note not found.'
            ], 403);
        }

        if($notes->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
       
              //validate fields
              $attrs = $request->validate([
                'type' => 'string',
                'type_subject' => 'required|string',
                'title' => 'required|string',
                'date'=>'required|string',
                'detail' => 'required|string',


      ]);
        $notes->update([
            'user_id' => auth()->user()->id,
            'type' => $attrs['type'],
            'type_subject' => $attrs['type_subject'],
            'title' => $attrs['title'],
            'date' => $attrs['date'],
            'detail' => $attrs['detail'],
          
        ]);

        return response([
            'message' => 'Notes updated.',
            'Notes' => $notes,

        ], 200);
    }

    public function destroy($id) {
        $notes = Notes::find($id);

        if(!$notes)
        {
            return response([
                'message' => 'Notes not found.'
            ], 403);
        }

        if($notes->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $notes->delete();

        return response([
            'message' => 'Note deleted.'
        ], 200);
    }

}
