<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold fs-1 text-xl text-gray-800 leading-tight flex justify-between">
                    {{ __('Suportes') }}
                    <div class="mr-2">
                        <x-button wire:click="confirmTicketAdd" style="background: blue">
                            Novo Ticket
                        </x-button>
                    </div>
                </h2>
                <div class="col-15">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ ("Ticket deletado com sucesso!" )}}
                        </div>
                    @endif
                </div>
                <div style="text-align:center; table-layout:auto; width:300%; margin-bottom:0px;">
                <table style="margin-bottom:0px; width:30%;" class="table">
                    <thead> 
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Email</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Assunto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Prioridade</th>
                        <th scope="col">Status</th>
                        <th colspan="3">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (Auth()->user()->isAdmin==1)
                            @if ($tick->count() > 0)
                                @foreach ($tick as $ti)
                                    <tr>
                                        <td>{{$ti->id}}</td>
                                        <td>{{$ti->user->name}}</td>
                                        <td>{{$ti->user->email}}</td>
                                        <td>{{$ti->category->name}}</td>
                                        <td>{{$ti->subject}}</td>
                                        <td>{{$ti->description}}</td>
                                        <td>
                                            <span class="bg-{{$ti->priority->color()}}-400 px-2 rounded">
                                                {{$ti->priority->change()}}
                                            </span>
                                        </td>
                                        <td style="color: {{ $ti->status ?  'green' : 'red'}}">
                                            {{$ti->status ? 'Aberto' : 'Finalizado' }}
                                        </td>
                                        <td>
                                            <a wire:click="confirmTicketShow( {{$ti->id}})" wire:loading.attr="disabled" >
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('ticket_status',['ticket'=>$ti->id]) }}">
                                                <button wire:click.prevent="update({{$ti->id}})" type="button" class="btn btn-sm btn-success">Finalizar</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M3.559 4.544c.355-.35.834-.544 1.33-.544H19.11c.496 0 .975.194 1.33.544.356.35.559.829.559 1.331v9.25c0 .502-.203.981-.559 1.331-.355.35-.834.544-1.33.544H15.5l-2.7 3.6a1 1 0 0 1-1.6 0L8.5 17H4.889c-.496 0-.975-.194-1.33-.544A1.868 1.868 0 0 1 3 15.125v-9.25c0-.502.203-.981.559-1.331ZM7.556 7.5a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2h-8Zm0 3.5a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2H7.556Z" clip-rule="evenodd"/>
                                                  </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Nenhum Ticket Registrado</td>
                                </tr>
                            @endif
                        @else
                            @if ($supports->count() > 0)
                                @foreach ($supports as $support)
                                    <tr>
                                        <td>{{$support->id}}</td>
                                        <td>{{$support->user->name }}</td>
                                        <td>{{$support->user->email}}</td>
                                        <td>{{$support->category->name}}</td>
                                        <td>{{$support->subject}}</td>
                                        <td>{{$support->description}}</td>
                                        <td>
                                            <span class="bg-{{$support->priority->color()}}-400 px-2 rounded">
                                                {{$support->priority->change()}}
                                            </span>
                                        </td>
                                        <td style="color: {{ $support->status ?  'green' : 'red'}}">
                                            {{($support->status ? 'Aberto' : 'Finalizado') }}
                                        </td>
                                        <td>
                                            <a wire:click="confirmTicketShow( {{$support->id}})" wire:loading.attr="disabled" >
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Nenhum Ticket Registrado</td>
                                </tr>
                            @endif
                        @endif
                    </tbody>         
                </table>
            </div>
            @if (Auth()->user()->isAdmin==1)
                {{ $tick->links() }}
            @endif
            </div>
        </div>
        <x-dialog-modal wire:model="confirmingTicketAdd">

            <x-slot name="title">
                {{__('Criar novo Ticket')}}
            </x-slot>

            <x-slot name="content">
                <form class="max-w-md mx-auto" wire:submit.prevent="submit">
                    <div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Assunto</label>
                        <input type="text" wire:model="subject" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descrição</label>
                        <input type="text" wire:model="description" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Categoria</label>
                        <select id="category" wire:model="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Selecione uma categoria</option>    
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="text-lg">
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Prioridade</label>
                        <input type="radio" wire:model="priority" id="small-input" name="High" value="0"> Alta <br>
                        <input type="radio" wire:model="priority" id="small-input" name="Medium" value="1"> Média <br>
                        <input type="radio" wire:model="priority" id="small-input" name="Low" value="2"> Baixa <br>
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingTicketAdd',false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button wire:click="submit()" wire:loading.attr="disabled">
                    {{ __('Salvar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>

        @if (Auth()->user()->isAdmin==1)
        <x-dialog-modal wire:model="confirmingTicketShow">
            <x-slot name="title">
                {{__('Ticket')}}
            </x-slot>

            <x-slot name="content">
                <div class="card-body">
                    <h5 class="card title">ID : {{ $ti->id }}</h5>
                    <h5 class="card title">Nome : {{ $ti->user->name }}</h5>
                    <h5 class="card title">Email : {{ $ti->user->email }}</h5>
                    <h5 class="card title">Categoria : {{ $ti->category->name }}</h5>
                    <h5 class="card title">Assunto : {{ $ti->subject }}</h5>
                    <h5 class="card title">Descrição : {{ $ti->description }}</h5>
                    <h5 class="card title">Prioridade : {{ $ti->priority->change() }}</h5>
                    <h5 class="card title">Status : {{ ($ti->status ? 'Aberto' : 'Finalizado') }}</h5>
                    @if ($ti->status == 0)
                        <h5 class="card title">Data de Finalização :{{$ti->updated_at}}</h5>
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingTicketShow',false)" wire:loading.attr="disabled">
                    {{ __('Fechar') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>

        {{-- @else
        
        <x-dialog-modal wire:model="confirmingTicketShow">
            <x-slot name="title">
                {{__('Ticket')}}
            </x-slot>

            <x-slot name="content">
                <div class="card-body">
                    <h5 class="card title">ID : {{ $support->id }}</h5>
                    <h5 class="card title">Nome : {{ $support->user->name }}</h5>
                    <h5 class="card title">Email : {{ $support->user->email }}</h5>
                    <h5 class="card title">Categoria : {{ $support->category->name }}</h5>
                    <h5 class="card title">Assunto : {{ $support->subject }}</h5>
                    <h5 class="card title">Descrição : {{ $support->description }}</h5>
                    <h5 class="card title">Prioridade : {{ $support->priority->change() }}</h5>
                    <h5 class="card title">Status : {{ ($support->status ? 'Aberto' : 'Finalizado') }}</h5>
                    @if ($support->status == 0)
                        <h5 class="card title">Data de Finalização :{{$support->updated_at}}</h5>
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingTicketShow',false)" wire:loading.attr="disabled">
                    {{ __('Fechar') }}
                </x-secondary-button>

                @if ($ti->status == 0)
                    <x-danger-button wire:click="confirmTicketDeletion( {{ $support->id}})" wire:loading.attr="disabled">
                        {{ __('Deletar') }}
                    </x-danger-button>
                @endif
            </x-slot>
        </x-dialog-modal> --}}
        @endif
    </div>
</div>
