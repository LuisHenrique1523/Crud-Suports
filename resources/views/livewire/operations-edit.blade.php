<div>
    <form class="max-w-md mx-auto" wire:submit.prevent="operationEdit">
        <div>
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Operações Realizadas</label>
            <input type="text" id="description" name="description" wire:model="description" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
        <a href="javascript:history.back()">
            <button type="button" class="btn btn-sm btn-danger">Voltar</button>
        </a>
    </form>
</div>
