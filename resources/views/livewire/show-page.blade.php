<div>
    <div class="card offset-9 col-12">
        <h5 class="card-header">Visualizar Ticket</h5>
        <div class="card-body">
            <h5 class="card title">ID : {{ $getRecord->id }}</h5>
            <h5 class="card title">Nome : {{ $getRecord->user->name }}</h5>
            <h5 class="card title">Email : {{ $getRecord->user->email }}</h5>
            <h5 class="card title">Categoria : {{ $getRecord->category->category }}</h5>
            <h5 class="card title">Assunto : {{ $getRecord->subject }}</h5>
            <h5 class="card title">Descrição : {{ $getRecord->description }}</h5>
            <h5 class="card title">Prioridade : {{ $getRecord->priority }}</h5>
            <h5 class="card title">Status : {{ getStatusTicket($getRecord->status) }}</h5>
        </div>
    </div>
    <div style="position: relative;
                top: 2px;
                left: 305px;">
        <button class="btn btn-success" data-toggle="modal" data-target="replies">Responder Ticket</button>
        <button class="btn btn-primary">Editar</button>
    </div>
    <br>
    <livewire:replies :replyRecord="$getRecord->id" />
</div>
