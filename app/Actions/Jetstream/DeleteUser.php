<?php

namespace App\Actions\Jetstream;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Mail\Message;
use Livewire\Component;
use Laravel\Jetstream\Contracts\DeletesUsers;
use View;

class DeleteUser implements DeletesUsers
{
    public $user;
    public Ticket $ticket;
    /**
     * Delete the given user.
     */
    public function delete(User $user)
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        
        try {
            $user = auth()->user();
        
            if ($user->tickets()->exists()) {
                throw new \Exception('Não é possível deletar um usuário que possui tickets', 1);
            }
        
            if (!$user->delete()) {
                throw new \Exception('Não foi possível deletar o usuário', 1);
            }
        
            return redirect()->route('home')->with('success', 'Usuário deletado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}
