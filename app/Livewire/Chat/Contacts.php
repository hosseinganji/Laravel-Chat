<?php

namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;

class Contacts extends Component
{

    public function selectUser(User $userId){
        
        dd($userId);
    }

    public function render()
    {
        return view('livewire.chat.contacts', [
            "users" => User::all()
        ]);
    }
}
