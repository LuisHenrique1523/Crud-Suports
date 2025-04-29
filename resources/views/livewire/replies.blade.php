<div>
    @foreach ($ticket->replies as $reply)
        <div class="card offset-9 col-12">
            <h5 style="background-color: black; color: aliceblue;" class="card-header">Resposta ao Ticket
                @if (Auth()->user()->isAdmin==1)
                    @if ($ticket->status == 1)
                        <a href="{{ route('operations', ['ticket'=>$ticket->id]) }}">
                            <button type="button" class="btn btn-sm btn-secondary">Operações</button>
                        </a>
                        <a href="{{ route('operation_create',['ticket'=>$ticket->id]) }}"> 
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v14m-8-7h2m0 0h2m-2 0v2m0-2v-2m12 1h-6m6 4h-6M4 19h16c.5523 0 1-.4477 1-1V6c0-.55228-.4477-1-1-1H4c-.55228 0-1 .44772-1 1v12c0 .5523.44772 1 1 1Z"/>
                            </svg>
                        </a>
                    @endif
                @endif
            </h5>
            <div class="card-body">
                <h5 class="card title">Responsável : {{ $reply->user->name }}</h5>
                <h5 class="card title">Resposta : {{ $reply->reply }}</h5>  
            </div>
        </div>
    @endforeach
    <br>
        @if (Auth()->user()->isAdmin==1)
            @if ($ticket->status == 1)
                <div class="card offset-9 col-12"  >
                    <h5 style="background-color: black; color: aliceblue;" class="card-header">Adicionar Resposta ao Ticket</h5>
                    <form wire:submit.prevent = "submit">
                        <h5 class="card title">Resposta ao Ticket: </h5>
                        <input wire:model="rep" type="text" name="rep">
                        <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
                    </form>
                </div>
            @endif
        @endif
</div>
