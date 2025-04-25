<div>
    <a href="javascript:history.back()">
        <button type="button" class="btn btn-sm btn-danger">Voltar</button>
    </a>
    <div style="table-layout: auto; width: 170%; border: 1px solid;" >
        <table style="margin-bottom: 0px;" class="table">
            <thead>
                <tr style="text-align: center;" >
                    <th style="background-color: black; color: aliceblue; border: none;" scope="col">id</th>
                    <th style="background-color: black; color: aliceblue; border: none;" scope="col">Usuário</th>
                    <th style="background-color: black; color: aliceblue; border: none;" scope="col">Ticket</th>
                    <th style="background-color: black; color: aliceblue; border: none;" scope="col">Descrição</th>
                    <th style="background-color: black; color: aliceblue; border: none;" colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @if ($operations->count() > 0)
                    @foreach ($operations as $operation)
                    <tr style="text-align: center;">
                        <td>{{$operation->id}}</td>
                        <td>{{$operation->user->name}}</td>
                        <td>{{$operation->ticket->subject}}</td>
                        <td>{{$operation->description}}</td>
                        <td>
                            <a href="{{  route('operation_edit',['operation'=>$operation->id])}}">
                                <button type="button" class="btn btn-sm btn-info">Editar</button>
                            </a>
                        </td>
                        <td>
                            <livewire:operation-delete :id="$operation->id" >                           
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Nenhuma Operação Registrada</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>