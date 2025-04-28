<div>
    <form class="max-w-md mx-auto" wire:submit.prevent="submit">
        <div>
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Conteúdo</label>
            <input type="text" name="content" wire:model="content" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div>
            <label for="ticket_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Ticket</label>
            <select id="ticket_id" wire:model="ticket_id" class="bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecione um Ticket</option>    
                @if (!Auth()->user()->isAdmin==1)                
                    @foreach ($ticket as $tick)
                        <option value="{{$tick->id}}" >{{$tick->subject}}</option>
                    @endforeach
                @else
                    @foreach ($tic as $ti)
                        <option value="{{$ti->id}}" >{{$ti->subject}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
        <a href="{{ route('home') }}">
            <button type="button" class="btn btn-sm btn-danger">Cancelar</button>
        </a>
    </form>
</div>
