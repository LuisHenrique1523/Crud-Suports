<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Illuminate\Mail\Message;
use Livewire\Component;
use Laravel\Jetstream\Contracts\DeletesUsers;
use View;

class DeleteUser implements DeletesUsers
{
    public $user;
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        
        try{
            if(!auth()->user()->delete()){
                throw new \Exception('Não é possivel deletar uma usuário em uso',1);
            }
        }catch(\Exception $e){
            session()->flash('error','Não é possível deletar uma usuário em uso');
            // ->redirect(view('livewire.home-page'));

            // $this->dispatch('UserDeleted');
            // $this ->dispatch('refresh');
        }
    }
}
