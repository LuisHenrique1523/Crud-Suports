<div>
    <div style="text-align:center; table-layout:auto; width:170%; border:1px solid; margin-bottom:0px;">
        <table style="margin-bottom:0px;" class="table">
            <thead>
                <tr>
                    <th style="background-color: black; color: aliceblue;" scope="col">Usuário</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Conteúdo</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Ticket</th>
                    <th style="background-color: black; color: aliceblue;" colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
            @if (Auth()->user()->isAdmin==1)
                @if ($commentaries->count() > 0)
                @foreach ($commentaries as $commentary)
                    <tr>
                        <td>{{$commentary->user->name}}</td>
                        <td>{{$commentary->content}}</td>
                        <td>{{$commentary->ticket->subject}}</td>                            
                        <td>
                            <a href="{{ route('comment_edit', ['comment'=>$commentary->id]) }}">
                                <button type="button" class="btn btn-sm btn-info">Editar</button>
                            </a>
                        </td>
                        <td><livewire:delete-comment :id="$commentary->id" ></td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="4">Nenhum Comentário Registrado</td>
                    </tr>
                @endif
            @else
                @if ($comments->count() > 0)
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{$comment->user->name}}</td>
                            <td>{{$comment->content}}</td>
                            <td>{{$comment->ticket->subject}}</td>
                            <td><a href="{{ route('comment_edit', ['comment'=>$comment->id]) }}">
                                <button type="button" class="btn btn-info">Editar</button>
                                </a>
                            </td>
                            <td><livewire:delete-comment :id="$comment->id" ></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Nenhum Comentário Registrado</td>
                    </tr>
                @endif
            @endif
        </tbody>
        </table>
    </div>
    <button style="background-color: black; color: aliceblue;" href="/comments.create" wire:navigate class="btn btn-sm">Criar Comentário</button>
    <a href="{{ route('home') }}">
        <button type="button" class="btn btn-sm btn-danger">Voltar</button>
    </a>
</div>
