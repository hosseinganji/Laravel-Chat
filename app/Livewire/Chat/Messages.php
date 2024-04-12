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
    public $reminder = [];

    public $rules = [
        "text" => "required"
    ];

    public function getUser($user){
        $this->user = $user;
    }

    public function getListeners(){
        return [
            "selectedUser" => 'getUser',
            "echo-private:sendMessage.user.".auth()->user()->id.",AddMessage" => "sendMessageFromWebsocket"
        ];
    }



    public function sendMessage(){
        $this->validate();

        $message = Message::create([
            "user_id_from" => auth()->user()->id,
            "user_id_to" => $this->user["id"],
            "text" => $this->text,
            "is_read" => false
        ]);

        broadcast(new AddMessage($this->user["id"], $message))->toOthers();

        $this->text = "";
    }

    public function sendMessageFromWebsocket(Message $message){
        // dump($message);
        $this->dispatch("reminder");
        if($this->user["id"] == $message->user_id_from){
            $message->update([
                "is_read" => true
            ]);
            Message::all()->prepend($message);
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
