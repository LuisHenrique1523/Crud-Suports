<div>
    <div class="card offset-9 col-12"  >
        <h5 class="card-header">Adicionar Resposta ao Ticket</h5>
        <form wire:submit.prevent = "submit">
            <h5 class="card title">Resposta ao Ticket: </h5>
            <input wire:model="replies" type="text" name="reply">
        </form>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    @foreach ($reply as $rep)
        {{-- <li>{{$rep->user_id}}</li> --}}
    
    <div class="card offset-9 col-12">
    <h5 class="card-header">Resposta ao Ticket</h5>
        <div class="card-body">
            <h5 class="card title">Responsável : {{ $rep->user_id }}</h5>
            <h5 class="card title">Resposta : {{ $rep->reply }}</h5>      
        </div>
    </div>
    @endforeach
</div>
