<?php

namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;

class Contacts extends Component
{
    public $user;

    public function selectUser(User $user){
        $this->user = $user;
        $this->dispatch("selectedUser", user: $user);
    }

    public function render()
    {
        return view('livewire.chat.contacts', [
            "users" => User::all()->except(auth()->user()->id),
            "selected_user" => $this->user
        ]);
    }
}
