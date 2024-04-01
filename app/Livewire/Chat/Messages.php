<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class Messages extends Component
{
    public $text = "";
    public $user;

    public $rules = [
        "text" => "required"
    ];

    public function getListeners(){
        return ["selectedUser" => 'getUser'];
    }

    public function getUser($user){
        $this->user = $user;
    }

    public function sendMessage(){
        $this->validate();

        Message::create([
            "user_id_from" => auth()->user()->id,
            "user_id_to" => $this->user["id"],
            "text" => $this->text
        ]);

        $this->text = "";
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
