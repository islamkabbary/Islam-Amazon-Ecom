<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    /**
     * Display a chating of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chats(ChatRequest $request)
    {
        try {
             $chats = Auth::guard('store')->user()->recivers->groupBy('sender_id');
             return view('chat', compact('chats'));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
    
    /**
     * Send message
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMessages(ChatRequest $request)
    {
        try {
            Chat::create($request->only(['reciver_id','message']));
            if($request->has('file')){
                $file = $request->file;
                $path = 'uplode_file';
                $file_name = $file->getOriginName().now()->format('Y-m-dH:i:s');
                 $file->move($path,$file_name);
            }
            return back();
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function getUserChat($id)
    {
        try {
            $chats = Chat::where('sender_id', $id)->orWhere('reciver_id', $id)->where(function ($query){
                $query->where('reciver_id', auth('store')->user()->id)->orWhere('sender_id', auth('store')->user()->id);
            })->get();
            return response()->json($chats, 200);
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}
