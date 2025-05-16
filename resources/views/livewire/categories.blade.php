<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold fs-1 text-xl text-gray-800 leading-tight flex justify-between">
                    {{ __('Categorias') }}
                    <div class="mr-2">
                        <x-button wire:click="confirmCategoryAdd" style="background: blue">
                            Nova Categoria
                        </x-button>
                    </div>
                </h2>
                <div class="col-15">
                    @if (session()->has('error'))
                        <div class="alert alert-warning">
                            {{ ('Não é possível deletar uma categoria em uso!' )}}
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-danger">
                            {{ ('Categoria deletada com sucesso!' )}}
                        </div>
                    @endif
                </div>
                <div style="text-align:center; table-layout:auto; width:100%; margin-bottom:0px;" >
                <table style="margin-bottom:0px; width:30%;" class="table">
                <thead>
                    <tr style="text-align: center;" >
                        <th style="none;" scope="col">#</th>
                        <th style="border: none;" scope="col">Categoria</th>
                        <th style="border: none;" colspan="2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                    <tr style="text-align: center;">
                        <td style="background: {{$category->color}}; border: none;">{{$category->id}}</td>
                        <td style="background: {{$category->color}}; border: none;">{{$category->name}}</td>
                        <td style="background: {{$category->color}}; border: none;">
                            <button wire:click="confirmCategoryEdit( {{ $category->id}})" wire:loading.attr="disabled">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                </svg>
                            </button>
                        </td>
                        <td style="background: {{$category->color}}; border: none;">
                            <button wire:click="confirmCategoryDeletion( {{ $category->id}})" wire:loading.attr="disabled">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg> 
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="9">Nenhuma Categoria Registrada</td>
                        </tr>
                    @endif
                </tbody>
                </table>
                </div>

                <x-dialog-modal wire:model="confirmingCategoryAdd">

                    <x-slot name="title">
                        {{__('Criar Categoria')}}
                    </x-slot>

                    <x-slot name="content">

                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="{{__('Categoria')}}" />
                                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                                <x-input-error for="name" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="{{__('Cor')}}" />
                                <x-select id="color" type="select" class="mt-1 block w-full" wire:model.defer="color"/>
                                <x-input-error for="color" class="mt-2"/>
                                    
                                <script>
                                    function changeColor() {
                                        let selectedColor = document.getElementById("colorSelect").value;
                                        document.getElementById("preview").style.backgroundColor = selectedColor;
                                    }
                                </script>
                            </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-secondary-button wire:click="$set('confirmingCategoryAdd',false)" wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-secondary-button>

                        <x-danger-button wire:click="submit()" wire:loading.attr="disabled">
                            {{ __('Salvar') }}
                        </x-danger-button>
                    </x-slot>

                </x-dialog-modal>

                <x-dialog-modal wire:model="confirmingCategoryEdit">

                    <x-slot name="title">
                        {{__('Editar Categoria')}}
                    </x-slot>

                    <x-slot name="content">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{__('Categoria')}}" />
                            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                            <x-input-error for="name" class="mt-2"/>
                        </div>
                        
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{__('Cor')}}" />
                            <x-select id="color" type="select" class="mt-1 block w-full" wire:model.defer="color"/>
                            <x-input-error for="color" class="mt-2"/>
                                
                            <script>
                                function changeColor() {
                                    let selectedColor = document.getElementById("colorSelect").value;
                                    document.getElementById("preview").style.backgroundColor = selectedColor;
                                }
                            </script>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-secondary-button wire:click="$set('confirmingCategoryEdit',false)" wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-secondary-button>

                        <x-danger-button wire:click="categoryEdit()" wire:loading.attr="disabled">
                            {{ __('Salvar') }}
                        </x-danger-button>
                    </x-slot>

                </x-dialog-modal>
            </div>
        </div>
    </div>
</div>