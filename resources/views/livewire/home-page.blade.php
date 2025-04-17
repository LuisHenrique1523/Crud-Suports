<div>
    <div style="text-align:center; table-layout:auto; width:300%; border:1px solid; margin-bottom:0px;">
        <table style="margin-bottom:0px;" class="table">
            <thead>
                <tr>
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
                @if ($tick->count() > 0)
                @foreach ($tick as $ti)
                    <tr>
                        <td>{{$ti->user->name}}</td>
                        <td>{{$ti->user->email}}</td>
                        <td>{{$ti->category->name}}</td>
                        <td>{{$ti->subject}}</td>
                        <td>{{$ti->description}}</td>
                        <td>{{$ti->priority}}</td>
                        <td>{{$ti->status ? 'Aberto' : 'Finalizado' }}</td>
                        <td>
                            <a href="{{ route('show', $ti->id) }}">
                                <button type="button" class="btn btn-info">Visualizar</button>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('ticket_status',['ticket'=>$ti->id]) }}">
                                <button wire:click.prevent="update({{$ti->id}})" type="button" class="btn btn-success">Finalizar</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="9">Nenhum Ticket Registrado</td>
                    </tr>
                @endif
            @else
                @if ($supports->count() > 0)
                    @foreach ($supports as $support)
                    <tr>
                        <td>{{$support->user->name}}</td>
                        <td>{{$support->user->email}}</td>
                        <td>{{$support->category->name}}</td>
                        <td>{{$support->subject}}</td>
                        <td>{{$support->description}}</td>
                        <td>{{$support->priority}}</td>
                        <td>{{($support->status ? 'Aberto' : 'Finalizado') }}</td>
                        <td>
                            <a href="{{ route('show', $support->id) }}">
                                <button type="button" class="btn btn-info">Visualizar</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">Nenhum Ticket Registrado</td>
                    </tr>
                @endif
            @endif
            </tbody>         
        </table>
    </div>
</div>
