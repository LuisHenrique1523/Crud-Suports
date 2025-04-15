<div>
    <div class="card offset-9 col-12">
        <div>
            <h5 class="card-header">Visualizar Ticket
                @if (!Auth()->user()->isAdmin==1)
                    <button class="btn btn-info">Editar</button>
                    <button class="btn btn-danger">Deletar</button>
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
            <h5 class="card title">Status : {{ getStatusTicket($getRecord->status) }}</h5>
        </div>
    </div>
    <br>
        <livewire:replies :ticket="$getRecord"/>
</div>
