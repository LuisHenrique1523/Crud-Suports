<div>
    <div class="offset-9 col-12">
    <a href="{{ route('home') }}">
        <button type="button" class="btn btn-sm btn-danger">Voltar</button>
    </a>
    </div>
    <div class="card offset-9 col-12">
        <div>
            <h5 style="background-color: black; color: aliceblue;" class="card-header">Visualizar Ticket
                @if ($getRecord->status == 1)
                    <a href="{{ route('ticket_edit', ['ticket'=>$getRecord->id]) }}">
                        <button type="button" class="btn btn-sm btn-info">Editar</button>
                    </a>
                    @endif
                    @if (!Auth()->user()->isAdmin==1)
                        @if ($getRecord->status == 0)
                            <livewire:delete-ticket :id="$getRecord->id">
                        @endif
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
            <h5 class="card title">Prioridade : {{ $getRecord->priority->change() }}</h5>
            <h5 class="card title">Status : {{ ($getRecord->status ? 'Aberto' : 'Finalizado') }}</h5>
            @if ($getRecord->status == 0)
                <h5 class="card title">Data de Finalização :{{$getRecord->updated_at}}</h5>
            @endif
        </div>
    </div>
    <br>
        <livewire:replies :ticket="$getRecord"/>
        
        @if(Auth()->user()->isAdmin==2)
            <livewire:operations-create :ticket="$getRecord"/>
        @endif
        @if(Auth()->user()->isAdmin==2)
            <livewire:operations :ticket="$getRecord"/>
        @endif
</div>
