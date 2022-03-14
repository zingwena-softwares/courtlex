<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller {
           // get all clients
        public function clients(){
            return response([
                'clients' => Client::orderBy('created_at', 'desc')->with('user:id,name,phone,email')->where('user_id', auth()->user()->id)->get()
            ], 200);
        }

        public function clients_names(){
            return response([
                'clients' =>    Client::orderBy('created_at', 'desc')->where('user_id', auth()->user()->id)->get(['id', 'name'])
            ], 200);
        }
        
        
        // get single client
        public function show($id)
        {
            return response([
                'client' => Client::where('id', $id)->get()
            ], 200);
        }
    
        // create a client
        public function store(Request $request)
        {
            //validate fields
            $attrs = $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'phone' => 'required|string',
                'email'=>'required|email|unique:clients,email',

            ]);    
            $client = Client::create([
                'user_id' => auth()->user()->id,
                'name' => $attrs['name'],
                'address' => $attrs['address'],
                'city' => $attrs['city'],
                'phone' => $attrs['phone'],
                'email' => $attrs['email'],
            ]);
            return response([
                'message' => 'Client created.',
                'client' => $client,
            ], 200);
        }
    
        
        // update a client
        public function update(Request $request, $id)
        {
            $client = Client::find($id);
    
            if(!$client)
            {
                return response([
                    'message' => 'Client not found.'
                ], 403);
            }
    
            if($client->user_id != auth()->user()->id)
            {
                return response([
                    'message' => 'Permission denied.'
                ], 403);
            }
    
            //validate fields
            $attrs = $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'phone' => 'required|string',
                'email'=>'required|email|unique:users,email',
            ]);
    
            $client->update([
                'name' => $attrs['name'],
                'address' => $attrs['address'],
                'city' => $attrs['city'],
                'phone' => $attrs['phone'],
                'email' => $attrs['email'],
            ]);
    
            // for now skip for post image
    
            return response([
                'message' => 'Client updated.',
                'client' => $client
            ], 200);
        }
    
        //delete client
        public function destroy($id)
        {
            $client = Client::find($id);
    
            if(!$client)
            {
                return response([
                    'message' => 'Client not found.'
                ], 403);
            }
    
            if($client->user_id != auth()->user()->id)
            {
                return response([
                    'message' => 'Permission denied.'
                ], 403);
            }
    

            $client->delete();
    
            return response([
                'message' => 'Client deleted.'
            ], 200);
        }
}
