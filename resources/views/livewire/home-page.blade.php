<div>
    <div class="">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        Usuário
                    </th>
                    <th scope="col">
                        Email
                    </th>
                    <th scope="col">
                        Categoria
                    </th>
                    <th scope="col">
                        Assunto
                    </th>
                    <th scope="col">
                        Descrição
                    </th>
                    <th scope="col">
                        Prioridade
                    </th>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Ação
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    
                    <td>{{$ticket->user->name}}</td>
                    <td>{{$ticket->user->email}}</td>
                    <td>{{$ticket->category->category}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->description}}</td>
                    <td>{{$ticket->priority}}</td>
                    <td>{{getStatusTicket($ticket->status) }}</td>
                    <td><button type="button" class="btn btn-info">Visualizar</button></td>
                </tr>
                @endforeach
            </tbody>         
        </table>
    </div>
    
        
</div>
