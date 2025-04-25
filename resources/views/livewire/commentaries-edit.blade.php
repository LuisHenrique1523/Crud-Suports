<div>
    <form class="max-w-md mx-auto" wire:submit.prevent="CommentEdit">
        <div>
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Conteúdo</label>
            <input type="text" name="content" wire:model="content" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-info">Atualizar</button>
        <button wire:navigate href="/comments" class="btn btn-sm btn-danger">Cancelar</button>
    </form>
    
</div>
