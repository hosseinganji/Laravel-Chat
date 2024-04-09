<?php

namespace App\Livewire\Chat;

use App\Events\AddMessage;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Messages extends Component
{
    public $text = "";
    public $user;
    public $message;

    public $rules = [
        "text" => "required"
    ];

    public function __construct(){
        // $this->user = $this->user ?? User::all()->except(auth()->user()->id)->first()->id;
    }



    public function getListeners(){
        if($this->user){
            return [
                "selectedUser" => 'getUser',
                "echo-private:sendMessage.user.".$this->user["id"].",AddMessage" => "sendMessageFromWebsocket"
            ];
        }else{
            return [
                "selectedUser" => 'getUser',
            ];
        }
    }

    public function getUser($user){
        $this->user = $user;

    }

    public function sendMessage(){
        $this->validate();

        $message = Message::create([
            "user_id_from" => auth()->user()->id,
            "user_id_to" => $this->user["id"],
            "text" => $this->text
        ]);

        broadcast(new AddMessage($this->user["id"], $message))->toOthers();

        $this->message = $message;
        $this->text = "";
    }

    public function sendMessageFromWebsocket(Message $message){
        if($this->user == $message->user_id_from){
            $this->message->prepend($message);
        }
    }
    public function render()
    {
        if($this->user){
            $message = Message::where(function($query){
                $query->where("user_id_from", auth()->user()->id)->where("user_id_to", $this->user["id"]);
            })->orWhere(function($query){
                $query->where("user_id_from", $this->user["id"])->where("user_id_to", auth()->user()->id);
            })->orderBy("created_at")
            ->get();
        }else{
            $message = "";
        }

        return view('livewire.chat.messages', [
            "messages" => $message,
            "user" => $this->user
        ]);
    }
}
