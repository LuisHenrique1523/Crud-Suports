<div>
    <h1>Cadastrar Tickets</h1>

    <form class="max-w-md mx-auto" wire:submit.prevent="submit">
        <div>
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Assunto</label>
            <input type="text" wire:model="subject" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descrição</label>
            <input type="text" wire:model="description" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
        </div>
        <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Categoria</label>
            <select id="category" wire:model="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecione uma categoria</option>    
                @foreach ($categories as $category)
                <option value="{{$category->id}}" >{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="text-lg">
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Priority</label> <br>
            <input type="radio" wire:model="priority" id="small-input" name="High" value="0"> Alta <br>
            <input type="radio" wire:model="priority" id="small-input" name="Medium" value="1"> Média <br>
            <input type="radio" wire:model="priority" id="small-input" name="Low" value="2"> Baixa <br>
        </div>
        <button href="{{ route('home') }}" type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
        <a href="javascript:history.back()">
            <button type="button" class="btn btn-sm btn-danger">Cancelar</button>
        </a>
    </form>
</div>
