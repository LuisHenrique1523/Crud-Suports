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
                        <div class="alert alert-danger">
                            {{ ('Não é possível deletar uma categoria em uso!' )}}
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success">
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
                            <button wire:click="confirmCategoryEdit( {{ $category->id}})" wire:loading.attr="disabled" style="background: orangered" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Editar
                            </button>
                        </td>
                        <td style="background: {{$category->color}}; border: none;">
                            <button wire:click="confirmCategoryDeletion( {{ $category->id}})" wire:loading.attr="disabled" style="background: red" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ __('Deletar') }}
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
                        {{ isset( $this->category->id) ? 'Editar Categoria' : 'Criar Categoria'}}
                    </x-slot>

                    <x-slot name="content">
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="{{__('Categoria')}}" />
                                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                                <x-input-error for="name" class="mt-2"/>
                            </div>
                        
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="Color" value="{{__("Cor")}}" onchange="changeColor()">
                                <x-select id="color" type="select" class="mt-1 block w-full" wire:model.defer="color"/>
                                <x-input-error for="color" class="mt-2"/>
                                    
                        
                                <div id="preview"></div>
                        
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
            </div>
        </div>
    </div>
</div>