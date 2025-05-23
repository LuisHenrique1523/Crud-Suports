<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold fs-1 text-xl text-gray-800 leading-tight flex justify-between">
                    {{ __('Suportes') }}
                    <div class="mr-2">
                        @can('create-ticket')
                            <x-button wire:click="confirmTicketAdd" style="background: blue">
                                Novo Ticket
                            </x-button>
                        @endcan
                    </div>
                </h2>
                <div class="col-15">
                    @if(session('error') || session('success'))
                        <div class="alert {{ session('error') ? 'alert-warning' : 'alert-danger' }}">
                            {{ session('error') ?? session('success') }}
                        </div>
                    @endif
                    @session('status')
                        <div class="alert alert-danger">
                            {{$value}}
                        </div>
                    @endsession
                </div>
                    <div style="text-align:center; table-layout:auto; width:333%; margin-bottom:0px;">
                        <table style="margin-bottom:0px; width:30%;" class="table">
                            <thead> 
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Assunto</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Prioridade</th>
                                    <th scope="col">Status</th>
                                    <th colspan="5">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @role('user')
                                    @if ($supports->count() > 0)
                                        @foreach ($supports as $support)
                                            <tr>
                                                <td>{{$support->id}}</td>
                                                <td>{{$support->user->name }}</td>
                                                <td>{{$support->user->email}}</td>
                                                <td>{{$support->subject}}</td>
                                                <td>{{$support->description}}</td>
                                                <td style="color: {{$support->category->color}}">{{$support->category->name}}</td>
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
                                                @if ($support->status == 1)
                                                    <td>
                                                        <a wire:click="confirmTicketEdit( {{$support->id}})" wire:loading.attr="disabled">
                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                                            </svg>
                                                        </a>                                          
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{route('commentaries',['ticket' => $support->id])}}">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">                                                
                                                            <path fill-rule="evenodd" d="M3.559 4.544c.355-.35.834-.544 1.33-.544H19.11c.496 0 .975.194 1.33.544.356.35.559.829.559 1.331v9.25c0 .502-.203.981-.559 1.331-.355.35-.834.544-1.33.544H15.5l-2.7 3.6a1 1 0 0 1-1.6 0L8.5 17H4.889c-.496 0-.975-.194-1.33-.544A1.868 1.868 0 0 1 3 15.125v-9.25c0-.502.203-.981.559-1.331ZM7.556 7.5a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2h-8Zm0 3.5a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2H7.556Z" clip-rule="evenodd"/>
                                                        </svg>                                                 
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('replies',['ticket' => $support->id])}}">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z"/>
                                                            <path d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z"/>
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
                                    
                                @endrole
                                @can('show-all')
                                    @if ($adm_tickets->count() > 0)
                                        @foreach ($adm_tickets as $ticket)
                                            <tr>
                                                <td>{{$ticket->id}}</td>
                                                <td>{{$ticket->user->name }}</td>
                                                <td>{{$ticket->user->email}}</td>
                                                <td>{{$ticket->subject}}</td>                                  
                                                <td>{{$ticket->description}}</td>
                                                <td style="color: {{$ticket->category->color}}">{{$ticket->category->name}}</td>
                                                <td>
                                                    <span class="bg-{{$ticket->priority->color()}}-400 px-2 rounded">
                                                        {{$ticket->priority->change()}}
                                                    </span>
                                                </td>
                                                <td style="color: {{ $ticket->status ?  'green' : 'red'}}">
                                                    {{($ticket->status ? 'Aberto' : 'Finalizado') }}
                                                </td>
                                                <td>
                                                    <a wire:click="confirmTicketShow( {{$ticket->id}})" wire:loading.attr="disabled" >
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                @if ($ticket->status == 1)
                                                    <td>
                                                        <a wire:click="confirmTicketEdit( {{$ticket->id}})" wire:loading.attr="disabled">
                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                                            </svg>
                                                        </a>                                          
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{route('commentaries',['ticket' => $ticket->id])}}">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">                                                
                                                            <path fill-rule="evenodd" d="M3.559 4.544c.355-.35.834-.544 1.33-.544H19.11c.496 0 .975.194 1.33.544.356.35.559.829.559 1.331v9.25c0 .502-.203.981-.559 1.331-.355.35-.834.544-1.33.544H15.5l-2.7 3.6a1 1 0 0 1-1.6 0L8.5 17H4.889c-.496 0-.975-.194-1.33-.544A1.868 1.868 0 0 1 3 15.125v-9.25c0-.502.203-.981.559-1.331ZM7.556 7.5a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2h-8Zm0 3.5a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2H7.556Z" clip-rule="evenodd"/>
                                                        </svg>                                                 
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('replies',['ticket' => $ticket->id])}}">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z"/>
                                                            <path d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('operations',['ticket' => $ticket->id])}}">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" >
                                                            <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
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
                                @endcan
                            </tbody>
                        </table>
                    </div>
                @can('pagination')
                    {{ $adm_tickets->links() }}
                @endcan
                @role('user')
                    {{ $supports->links() }}
                @endrole
            </div>
        </div>
        <x-dialog-modal wire:model="confirmingTicketAdd">

            <x-slot name="title">
                {{__('Criar novo Ticket')}}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="subject" value="{{__('Assunto')}}" />
                    <x-input id="subject" type="text" class="mt-1 block w-full" wire:model.defer="subject" />
                    <x-input-error for="subject" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="description" value="{{__('Descrição')}}" />
                    <x-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description" />
                    <x-input-error for="description" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="category" value="{{__('Categoria')}}" />
                    <select id="category" wire:model="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecione uma categoria</option>    
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" >{{$category->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="category_id" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="priority" value="{{__('Prioridade')}}" />
                    <input type="radio" wire:model="priority" id="small-input" name="High" value="0"> Alta <br>
                    <input type="radio" wire:model="priority" id="small-input" name="Medium" value="1"> Média <br>
                    <input type="radio" wire:model="priority" id="small-input" name="Low" value="2"> Baixa <br>
                    <x-input-error for="priority" class="mt-2"/>
                </div>
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
        
        <x-dialog-modal wire:model="confirmingTicketEdit">

            <x-slot name="title">
                {{__('Editar Ticket')}}
            </x-slot>

            <x-slot name="content">
                @can('edit-ticket')
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="subject" value="{{__('Assunto')}}" />
                        <x-input id="subject" type="text" class="mt-1 block w-full" wire:model.defer="subject" />
                        <x-input-error for="subject" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="description" value="{{__('Descrição')}}" />
                        <x-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description" />
                        <x-input-error for="description" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="category" value="{{__('Categoria')}}" />
                        <select id="category" wire:model="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Selecione uma categoria</option>    
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="category_id" class="mt-2"/>
                    </div>
                @endcan
                @can('edit-ticket-priority')
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="priority" value="{{__('Prioridade')}}" />
                        <input type="radio" wire:model="priority" id="small-input" name="High" value="0"> Alta <br>
                        <input type="radio" wire:model="priority" id="small-input" name="Medium" value="1"> Média <br>
                        <input type="radio" wire:model="priority" id="small-input" name="Low" value="2"> Baixa <br>
                        <x-input-error for="priority" class="mt-2"/>
                    </div>
                @endcan
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingTicketEdit',false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>
                <x-danger-button wire:click="ticketEdit()" wire:loading.attr="disabled">
                    {{ __('Salvar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>

        @isset($showticket)
            <x-dialog-modal wire:model="confirmingTicketShow">
                <x-slot name="title">
                    {{__('Ticket')}}
                </x-slot>

                <x-slot name="content">
                    <div class="card-body">
                        <h5 class="card title">ID : {{ $showticket->id }}</h5>
                        <h5 class="card title">Nome : {{ $showticket->user->name }}</h5>
                        <h5 class="card title">Email : {{ $showticket->user->email }}</h5> 
                        <h5 class="card title">Categoria : {{ $showticket->category->name }}</h5>
                        <h5 class="card title">Assunto : {{ $showticket->subject }}</h5>
                        <h5 class="card title">Descrição : {{ $showticket->description }}</h5> 
                        <h5 class="card title">Prioridade : {{ $showticket->priority->change() }}</h5> 
                        <h5 class="card title">Status : {{ $showticket->status ? 'Aberto' : 'Finalizado' }}</h5>
                        @if ($showticket->status == 0)
                            <h5 class="card title">Data de Finalização :{{$showticket->updated_at}}</h5>
                        @endif 
                    </div>
                </x-slot>

                <x-slot name="footer">
                    @can('finish-ticket')
                        <x-secondary-button wire:click="status( {{$showticket->id}})">
                            {{ $showticket->status ? 'Finalizar' : 'Abrir' }}
                        </x-secondary-button>
                    @endcan
                    @can('delete-ticket')
                        @if ($showticket->status == 0)
                            <x-secondary-button wire:click="confirmTicketDeletion( {{$showticket->id}})" wire:loading.attr="disabled">
                                Deletar
                            </x-secondary-button>
                        @endif
                    @endcan
                    <x-secondary-button wire:click="$set('confirmingTicketShow',false)" wire:loading.attr="disabled">
                        {{ __('Fechar') }}
                    </x-secondary-button>
                </x-slot>
                
            </x-dialog-modal>
        @endisset

    </div>
</div>
