<div>
    <div  class="card offset-9 col-12"  >
        <h5 class="card-header">Resposta ao Ticket</h5>
        <form wire:submit.prevent = "submit">
            <h5 class="card title">Resposta ao Ticket: </h5>   
            {{-- <input wire:model="reply" type="hidden" name="ticket_id"> --}}
            <input wire:model="replies" type="text" name="reply">
        </form>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    @foreach ($reply as $rep)
        <li>{{$rep->reply}}</li>
    @endforeach
</div>
