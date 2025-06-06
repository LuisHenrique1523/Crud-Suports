<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Component;

class Roles extends Component
{
    public $roles;
    public $id;
    public $name;
    public $guard_name;
    public $confirmingRoleAdd = false;
    public $confirmingRoleEdit = false;
    protected $rules = [
        'name' => 'required|string|max:255',
    ];
    public function mount()
    {
        $this->roles = Role::all();
    }
    public function confirmRoleAdd()
    {
        $this->reset(['name']);
        $this->confirmingRoleAdd = true;
    }
    public function submit()
    {
        $this->validate();
            $role = new Role;
            $role->name = $this->name;
            $role->guard_name = 'web';
        
            $role->save();

        return redirect()->route('roles');
    }
    public function confirmRoleEdit(Role $role)
    {
        $this->id = $role->id;
        $this->name = $role->name;

        $this->confirmingRoleEdit = true;
    }
    public function roleEdit(Role $role)
    {
        $this->validate();

        $role = Role::find($this->id);
        if (!$role) {
            session()->flash('error', 'Função não encontrada.');
            return redirect()->route('roles');
        }

        $role->id = $this->id;
        $role->name = $this->name;
        $role->save();

        return redirect()->route('roles');
    }
    public function confirmRoleDeletion(Role $role)
    {
        try {
            $roleInUse = \DB::table('model_has_roles')
                ->where('role_id', $role->id)
                ->exists();

            if ($roleInUse) {
                session()->flash('error', 'Não é possível deletar uma função que está em uso por um ou mais usuários!');
            } else {
                $role->delete();
                session()->flash('success', 'Função deletada com sucesso!');
            }
        }catch (\Exception $e) {
            session()->flash('error', 'Erro ao deletar a função!');
        }

            $this->dispatch('refresh');
            return redirect()->route('roles');
    }
    public function render()
    {
        return view('livewire.roles');
    }
}
