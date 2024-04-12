<?php

namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;

class Contacts extends Component
{
    public $user;

    public function getListeners(){
        return [
            "reminder" => 'show_reminder',
        ];
    }

    public function show_reminder(){
        // $this->render();
    }

    public function selectUser(User $user){
        $this->user = $user;
        if(count(auth()->user()->recive_messages()->where("is_read", 0)->where("user_id_from", $user->id)->get())){
            auth()->user()->recive_messages()->where("is_read", 0)->where("user_id_from", $user->id)->update([
                "is_read" => true
            ]);
        }
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
