<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatFile;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
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
            $chat = Chat::create($request->only(['reciver_id','message']));
            if($request->has('file')){
                $file = $request->file('file');
                $path = 'uplode_file';
                $file_name = $file->getOriginName().now()->format('Y-m-dH:i:s') . '.' . $file->extension();
                $file->move($path,$file_name);
                $full_path = $path . '/' . $file_name;
                ChatFile::create([
                    'chat_id' => $chat->id,
                    'path' => $full_path
                ]);
            }
            return $this->respondWithSuccess(new ChatResource($chat));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Send message
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserChat($id)
    {
        try {
            $chats_message = Chat::where('sender_id',$id)->orWhere('reciver_id',$id)->where(function($q){
                $q->where('sender_id',Auth::guard('store')->user()->id)->orWhere('reciver_id',Auth::guard('store')->user()->id);
            })->get();
            return $this->respondWithSuccess(ChatResource::collection($chats_message));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}
