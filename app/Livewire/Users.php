<?php

namespace App\Livewire;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public $confirmingUserAdd = false;
    public $confirmingUserEdit = false;
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ];
    public function mount()
    {
    }
    public function confirmUserAdd()
    {
        $this->reset(['name','email','password','password_confirmation']);
        $this->confirmingUserAdd = true;
    }
    public function submit()
    {
        $this->validate();
            $user = new User;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
        
            $user->save();

        return redirect()->route('users');
    }
    public function confirmUserEdit(User $user)
    {
        try {
            $userInUse = \DB::table('tickets')
                ->where('user_id', $user->id)
                ->exists();

            if ($userInUse) {
                session()->flash('error', 'Não é possível editar um usuário em uso!');
            } else {
                    $this->id = $user->id;
                    $this->name = $user->name;
                    $this->email = $user->email;

                    $this->confirmingUserEdit = true;
                }
        }catch (\Exception $e) {
            session()->flash('error', 'Erro!');
        }
    }
    public function UserEdit()
    {
        $user = User::find($this->id);
        if (!$user) {
            session()->flash('error', 'Usuário não encontrado.');
            return redirect()->route('users');
        }
        $user->name = $this->name;
        $user->email = $this->email;

        $user->save();
        session()->flash('success', 'Usuário atualizado com sucesso!');
        return redirect()->route('users');
    }
    public function confirmUserDeletion(User $users)
    {
        try {
            $userInUse = \DB::table('tickets')
                ->where('user_id', $users->id)
                ->exists();

            if ($userInUse) {
                session()->flash('error', 'Não é possível deletar um usuário que possui tickets!');
            } else {
                $users->delete();
                session()->flash('deleted', 'Usuário deletado com sucesso!');
            }
        }catch (\Exception $e) {
            session()->flash('error', 'Erro ao deletar o usuário!');
        }

            $this->dispatch('refresh');
            return redirect()->route('users');
    }
    public function render(User $user)
    {
        $users = $user->paginate(10);
        return view('livewire.users',[
            'users' => $users,
        ]);
    }
}
