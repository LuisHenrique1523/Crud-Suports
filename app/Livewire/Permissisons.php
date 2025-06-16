<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissisons extends Component
{
    public $permissions;
    public $id;
    public $name;
    public $guard_name;
    public $confirmingPermissionAdd = false;
    public $confirmingPermissionEdit = false;
    protected $rules = [
        'name' => 'required|string|max:255',
    ];
    public function mount()
    {
        $this->permissions = Permission::all();
    }
    public function confirmPermissionAdd()
    {
        $this->reset(['name']);
        $this->confirmingPermissionAdd = true;
    }
    public function submit()
    {
        $this->validate();
            $role = new Permission;
            $role->name = $this->name;
            $role->guard_name = 'web';
        
            $role->save();

        return redirect()->route('permissions');
    }
    public function confirmPermissionEdit(Permission $permission)
    {
        try {
            $permissionInUse = \DB::table('role_has_permissions')
                ->where('permission_id', $permission->id)
                ->exists();

            if ($permissionInUse) {
                session()->flash('error', 'Não é possível editar uma permissão em uso!');
            } else {
                    $this->id = $permission->id;
                    $this->name = $permission->name;

                    $this->confirmingPermissionEdit = true;
            }
        }catch (\Exception $e) {
            session()->flash('error', 'Erro!');
        }
    }
    public function permissionEdit(Permission $permission)
    {
        $this->validate();

        $permission = Permission::find($this->id);
        if (!$permission) {
            session()->flash('error', 'Função não encontrada.');
            return redirect()->route('permissions');
        }

        $permission->name = $this->name;
        $permission->save();

        return redirect()->route('permissions');
    }
    public function confirmPermissionDeletion(Permission $permission)
    {
        try {
            $permissionInUse = \DB::table('role_has_permissions')
                ->where('permission_id', $permission->id)
                ->exists();

            if ($permissionInUse) {
                session()->flash('error', 'Não é possível deletar uma permissão que está em uso por um ou mais usuários!');
            } else {
                $permission->delete();
                session()->flash('success', 'Permissão deletada com sucesso!');
            }
        }catch (\Exception $e) {
            session()->flash('error', 'Erro ao deletar a permissão!');
        }

            $this->dispatch('refresh');
            return redirect()->route('permissions');
    }
    public function render()
    {
        return view('livewire.permisisons');
    }
}
