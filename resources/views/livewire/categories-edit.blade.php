<div id="updateCategoryModal">
    <form class="max-w-md mx-auto" wire:submit.prevent="categoryEdit">
        <div>
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
            <input type="text" id="category" name="category" wire:model="category" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
    
        <label for="Color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cor</label>
        <select id="colorSelect" wire:model="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="changeColor()">
            <option value="#F4A261">Laranja</option>
            <option value="#E76F51">Vermelho</option>
            <option value="#2A9D8F">Verde Água</option>
            <option value="#8ECAE6">Azul</option>
            <option value="#FFB703">Amarelo</option>
            <option value="#D4A373">Bege</option>
            <option value="#B5E48C">Verde Claro</option>
            <option value="#F15BB5">Rosa</option>
            <option value="#9B5DE5">Roxo</option>
            <option value="#FEE440">Amarelo Neon</option>
        </select>

        <div id="preview"></div>

        <script>
            function changeColor() {
                let selectedColor = document.getElementById("colorSelect").value;
                document.getElementById("preview").style.backgroundColor = selectedColor;
            }
        </script>
        <button type="button" wire:click="categoryEdit({{$id}})" class="btn btn-info">Atualizar</button>
        <button wire:navigate href="/categories" class="btn btn-primary">Cancelar</button>

    </form>
</div>
