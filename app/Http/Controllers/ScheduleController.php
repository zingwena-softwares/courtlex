<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientCase;
use App\Models\Schedule;

class ScheduleController extends Controller
{
      // get all cases
      public function schedules(){
        return response([

            'schedules' => Schedule::orderBy('created_at', 'desc')->where('user_id', auth()->user()->id)->get()
        ], 200);
    }

    public function store(Request $request){

        //validate fields
        $attrs = $request->validate([
                  'type' => 'string',
                  'type_subject' => 'required|string',
                  'title' => 'required|string',
                  'date'=>'required|string',
                  'detail' => 'required|string',


        ]);
      
        $schedule = Schedule::create([
            'user_id' => auth()->user()->id,
            'type' => $attrs['type'],
            'type_subject' => $attrs['type_subject'],
            'title' => $attrs['title'],
            'date' => $attrs['date'],
            'detail' => $attrs['detail'],

            
        ]);

        return response([
            'message' => 'Schedule Created.',
            'Schedule' => $schedule,
        ], 200);
    }

    public function update(Request $request, $id){
        $schedule = Schedule::find($id);

        if(!$schedule)
        {
            return response([
                'message' => 'Schedule not found.'
            ], 403);
        }

        if($schedule->user_id != auth()->user()->id)
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
        $schedule->update([
            'user_id' => auth()->user()->id,
            'type' => $attrs['type'],
            'type_subject' => $attrs['type_subject'],
            'title' => $attrs['title'],
            'date' => $attrs['date'],
            'detail' => $attrs['detail'],
          
        ]);

        return response([
            'message' => 'Schedule updated.',
            'Schedule' => $schedule,

        ], 200);
    }

    public function destroy($id) {
        $schedule = Schedule::find($id);

        if(!$schedule)
        {
            return response([
                'message' => 'Schedule not found.'
            ], 403);
        }

        if($schedule->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $schedule->delete();

        return response([
            'message' => 'Schedule deleted.'
        ], 200);
    }

}
