<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientCase;
class CaseController extends Controller
{
        // get all cases
        public function cases(){
            return response([

                'cases' => ClientCase::orderBy('created_at', 'desc')->with('user:id,name')->where('user_id', auth()->user()->id)->get()
            ], 200);
        }
        public function updateClose($id){
            $case = ClientCase::find($id);
            $case->update([
                'case_status' => 'CLOSED',
            ]);
            return response([
                'message' => 'case closed.',
            ], 200);
          }
        public function updateOpen($id){
            $case = ClientCase::find($id);
            $case->update([
                'case_status' => 'OPEN',
            ]);
            return response([
                'message' => 'case opened.',
            ], 200);
          }
        
          // create a case
          public function store(Request $request){

              //validate fields
              $attrs = $request->validate([
                  'case_status' => 'required|string',
                  'case_title' => 'required|string',
                  'client_name' => 'required|string',
                  'case_subject'=>'required|string',
                  'case_number' => 'required|string',


                  'resplawyer_name' => 'required|string',
                  'resplawyer_phone' => 'required|string',
                  'resplawyer_email' => 'required|email',
                  'resplawyer_lawfirmname'=>'required|string',
                  'resplawyer_lawfirmcity' => 'required|string',
                  'resplawyer_lawfirmaddress' => 'required|string',

                  'court_name' => 'required|string',
                  'court_city' => 'required|string',
                  'nextcourt_date'=>'required|string',
                  'notes' => 'required|string',
                  'added_by' => 'required|string',

              ]);
            
              $cases = ClientCase::create([
                  'user_id' => auth()->user()->id,
                  'case_status' => $attrs['case_status'],
                  'case_title' => $attrs['case_title'],
                  'client_name' => $attrs['client_name'],
                  'case_subject' => $attrs['case_subject'],
                  'case_number' => $attrs['case_number'],

                  'resplawyer_name' => $attrs['resplawyer_name'],
                  'resplawyer_phone' => $attrs['resplawyer_phone'],
                  'resplawyer_email' => $attrs['resplawyer_email'],
                  'resplawyer_lawfirmname' => $attrs['resplawyer_lawfirmname'],
                  'resplawyer_lawfirmcity' => $attrs['resplawyer_lawfirmcity'],
                  'resplawyer_lawfirmaddress' => $attrs['resplawyer_lawfirmaddress'],

                  'court_name' => $attrs['court_name'],
                  'court_city' => $attrs['court_city'],
                  'nextcourt_date' => $attrs['nextcourt_date'],
                  'notes' => $attrs['notes'],
                  'added_by' => $attrs['added_by'],
                
              ]);
      
              return response([
                  'message' => 'Case Created.',
                  'Case' => $cases,
              ], 200);
          }
     
           // update a case
        public function update(Request $request, $id){
        $case = ClientCase::find($id);

        if(!$case)
        {
            return response([
                'message' => 'Case not found.'
            ], 403);
        }

        if($case->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
       
              //validate fields
              $attrs = $request->validate([
                'case_status' => 'required|string',
                'case_title' => 'required|string',
                'client_name' => 'required|string',
                'case_subject'=>'required|string',
                'case_number' => 'required|string',


                'resplawyer_name' => 'required|string',
                'resplawyer_phone' => 'required|string',
                'resplawyer_email' => 'required|email',
                'resplawyer_lawfirmname'=>'required|string',
                'resplawyer_lawfirmcity' => 'required|string',
                'resplawyer_lawfirmaddress' => 'required|string',

                'court_name' => 'required|string',
                'court_city' => 'required|string',
                'nextcourt_date'=>'required|string',
                'notes' => 'required|string',
                'added_by' => 'required|string',

            ]);
        $case->update([
            'user_id' => auth()->user()->id,
            'case_status' => $attrs['case_status'],
            'case_title' => $attrs['case_title'],
            'client_id' => $id,
            'client_name' => $attrs['client_name'],
            'case_subject' => $attrs['case_subject'],
            'case_number' => $attrs['case_number'],

            'resplawyer_name' => $attrs['resplawyer_name'],
            'resplawyer_phone' => $attrs['resplawyer_phone'],
            'resplawyer_email' => $attrs['resplawyer_email'],
            'resplawyer_lawfirmname' => $attrs['resplawyer_lawfirmname'],
            'resplawyer_lawfirmcity' => $attrs['resplawyer_lawfirmcity'],
            'resplawyer_lawfirmaddress' => $attrs['resplawyer_lawfirmaddress'],

            'court_name' => $attrs['court_name'],
            'court_city' => $attrs['court_city'],
            'nextcourt_date' => $attrs['nextcourt_date'],
            'notes' => $attrs['notes'],
            'added_by' => $attrs['added_by'],
          
        ]);

        return response([
            'message' => 'Case updated.',
            'Case' => $case,

        ], 200);
    }

    // delete a case
    public function destroy($id)
    {
        $case = ClientCase::find($id);

        if(!$case)
        {
            return response([
                'message' => 'Case not found.'
            ], 403);
        }

        if($case->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $case->delete();

        return response([
            'message' => 'Case deleted.'
        ], 200);
    }

}
