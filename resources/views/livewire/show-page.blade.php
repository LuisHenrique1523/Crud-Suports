<div>
    <div class="card offset-9 col-12">
        <div>
            <h5 style="background-color: black; color: aliceblue;" class="card-header">Visualizar Ticket
                
                <a href="{{ route('ticket_edit', ['ticket'=>$getRecord->id]) }}">
                    <button type="button" class="btn btn-info">Editar</button>
                </a>
                @if (!Auth()->user()->isAdmin==1)
                    <livewire:delete-ticket :id="$getRecord->id">
                @endif
            </h5>
        </div>
        <div class="card-body">
            <h5 class="card title">ID : {{ $getRecord->id }}</h5>
            <h5 class="card title">Nome : {{ $getRecord->user->name }}</h5>
            <h5 class="card title">Email : {{ $getRecord->user->email }}</h5>
            <h5 class="card title">Categoria : {{ $getRecord->category->name }}</h5>
            <h5 class="card title">Assunto : {{ $getRecord->subject }}</h5>
            <h5 class="card title">Descrição : {{ $getRecord->description }}</h5>
            <h5 class="card title">Prioridade : {{ $getRecord->priority }}</h5>
            <h5 class="card title">Status : {{ ($getRecord->status) }}</h5>
        </div>
    </div>
    <br>
        <livewire:replies :ticket="$getRecord"/>
</div>
