<div>
    @foreach ($ticket->replies as $reply)
        <div class="card offset-9 col-12">
        <h5 class="card-header">Resposta ao Ticket</h5>
            <div class="card-body">
                <h5 class="card title">Resposta : {{ $reply->ticket_id }}</h5> 
                <h5 class="card title">Responsável : {{ $reply->user->name }}</h5>
                <h5 class="card title">Resposta : {{ $reply->reply }}</h5>  
            </div>
        </div>
    @endforeach
    <br>
        @if (Auth()->user()->isAdmin==1)
        <div class="card offset-9 col-12"  >
            <h5 class="card-header">Adicionar Resposta ao Ticket</h5>
            <form wire:submit.prevent = "submit">
                <h5 class="card title">Resposta ao Ticket: </h5>
                <input wire:model="rep" type="text" name="rep">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
        @endif
    
</div>
