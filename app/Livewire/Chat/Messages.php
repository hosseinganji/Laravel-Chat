<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Messages extends Component
{
    public $text = "";
    public function sendMessage(){
        dump($this->text);
        // dump("flkjasl;lfjaslddjf");
    }

    public function render()
    {
        // dd("sdf");
        return view('livewire.chat.messages');
    }
}
