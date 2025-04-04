<div>
    <div style="text-align: center">
        <table class="table">
            <thead>
                <tr>
                    <th style="background-color: black; color: aliceblue;" scope="col">Id</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Usuário</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Email</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Categoria</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Assunto</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Descrição</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Prioridade</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Status</th>
                    <th style="background-color: black; color: aliceblue;" colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @if ($tickets->count() > 0)
                @foreach ($tickets as $ticket)
                    <tr>
                        <th scope="row">{{$ticket->id}}</th>
                        <td>{{$ticket->user->name}}</td>
                        <td>{{$ticket->user->email}}</td>
                        <td>{{$ticket->category->category}}</td>
                        <td>{{$ticket->subject}}</td>
                        <td>{{$ticket->description}}</td>
                        <td>{{$ticket->priority}}</td>
                        <td>{{getStatusTicket($ticket->status) }}</td>
                        <td>
                            <a href="{{ route('show', ['id' => $ticket->id]) }}">
                                <button type="button" class="btn btn-info">Visualizar</button>
                            </a>
                        </td>
                        <td>
                            <livewire:delete-ticket :id="$ticket->id">
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="9">Nenhum Ticket Registrado</td>
                    </tr>
                @endif
            </tbody>         
        </table>
    </div>
</div>
