<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold fs-1 text-xl text-gray-800 leading-tight flex justify-between">
                    {{ __('Funções') }} #{{$roles->count()}}
                    <div class="mr-2">
                        <x-button wire:click="confirmRoleAdd" style="background: blue">
                            Nova Função
                        </x-button>
                    </div>
                </h2>
                <div class="col-15">
                    @if(session('error') || session('success'))
                        <div class="alert {{ session('error') ? 'alert-warning' : 'alert-danger' }}">
                            {{ session('error') ?? session('success') }}
                        </div>
                    @endif
                </div>
                    <div style="table-layout:auto; width:333%; margin-bottom:0px;">
                        <table style="margin-bottom:0px; width:7%;" class="table">
                            <thead> 
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>    
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>            
                                            <a wire:click="confirmRoleEdit( {{$role->id}})" wire:loading.attr="disabled" title="Editar">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                                </svg>
                                            </a>                                          
                                        </td>
                                        <td>
                                            <button wire:click="confirmRoleDeletion( {{ $role->id}})" wire:loading.attr="disabled" title="Deletar">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                                </svg> 
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($role->permissions)
                        @foreach ($role->permissions as $role_permisison)
                            <span>{{ $role_permission->name }}</span>
                        @endforeach
                    @endif
                    
            </div>
        </div>

        <x-dialog-modal wire:model="confirmingRoleAdd">

            <x-slot name="title">
                {{__('Criar nova Função')}}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{__('Função')}}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    <x-input-error for="name" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingRoleAdd',false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button wire:click="submit()" wire:loading.attr="disabled">
                    {{ __('Salvar') }}
                </x-danger-button>
            </x-slot>

        </x-dialog-modal>

        <x-dialog-modal wire:model="confirmingRoleEdit">

            <x-slot name="title">
                {{__('Editar Função')}}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{__('Função')}}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    <x-input-error for="name" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingRoleEdit',false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button wire:click="roleEdit()" wire:loading.attr="disabled">
                    {{ __('Salvar') }}
                </x-danger-button>
            </x-slot>

        </x-dialog-modal>

    </div>
</div>
