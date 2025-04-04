<div>
    @foreach ($tickets as $ticket)
        <p>
            {{$ticket->id}}
            {{$ticket->user->name}}
            {{$ticket->user->email}}
            {{$ticket->category->category}}
            {{$ticket->subject}}
            {{$ticket->description}}
            {{$ticket->priority}}
            {{getStatusTicket($ticket->status) }}
        </p>
    @endforeach
</div>
