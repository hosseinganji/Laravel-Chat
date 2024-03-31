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

    
    public function sendMessage(){
        $this->validate();

        Message::create([
            "user_id_from" => auth()->user()->id,
            "user_id_to" => 5,
            "text" => $this->text
        ]);

        $this->text = "";
    }

    public function render()
    {
        return view('livewire.chat.messages', [
            "messages" => Message::orderBy("created_at")->get(),
            "user" => $this->user
        ]);
    }
}
