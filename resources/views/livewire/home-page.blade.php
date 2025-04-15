<div>
    <div style="text-align:center; table-layout:auto; width:260%; border:1px solid; margin-bottom:0px;">
        <table style="margin-bottom:0px;" class="table">
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
            @if (Auth()->user()->isAdmin==1)
                @if ($tickets->count() > 0)
                @foreach ($tickets as $ticket)
                    <tr>
                        <th scope="row">{{$ticket->id}}</th>
                        <td>{{$ticket->user->name}}</td>
                        <td>{{$ticket->user->email}}</td>
                        <td>{{$ticket->category->name}}</td>
                        <td>{{$ticket->subject}}</td>
                        <td>{{$ticket->description}}</td>
                        <td>{{$ticket->priority}}</td>
                        <td>{{getStatusTicket($ticket->status) }}</td>
                        <td>
                            <a href="{{ route('show', $ticket->id) }}">
                                <button type="button" class="btn btn-info">Visualizar</button>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('show', $ticket->id) }}">
                                <button type="button" class="btn btn-success">Finalizar</button>
                            </a>
                        </td>
                        {{-- <livewire:delete-ticket :id="$ticket->id"> --}}
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="9">Nenhum Ticket Registrado</td>
                    </tr>
                @endif
            @else
                @foreach ($supports as $support)
                <tr>
                    <th scope="row">{{$support->id}}</th>
                    <td>{{$support->user->name}}</td>
                    <td>{{$support->user->email}}</td>
                    <td>{{$support->category->category}}</td>
                    <td>{{$support->subject}}</td>
                    <td>{{$support->description}}</td>
                    <td>{{$support->priority}}</td>
                    <td>{{getStatusTicket($support->status) }}</td>
                    <td>
                        <a href="{{ route('show', $support->id) }}">
                            <button type="button" class="btn btn-info">Visualizar</button>
                        </a>
                    </td>
                    {{-- <td>
                        <livewire:delete-ticket :id="$support->id">
                    </td> --}}
                </tr>
                @endforeach
            @endif
            </tbody>         
        </table>
    </div>
</div>
