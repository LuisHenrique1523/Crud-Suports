<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class DeleteUser extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::find($id);
    }

    public function DeleteUser()
    {
        try{
            if(!$this->user->delete()){
                throw new \Exception('Não é possivel deletar um ticket em uso',1);
            }
        }catch(\Exception $e){
            session()->flash('error','Não é possível deletar um Usuário em uso');
            return redirect('/user/profile');
        }

        $this->dispatch('UserDeleted');
        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.delete-user');
    }
}
