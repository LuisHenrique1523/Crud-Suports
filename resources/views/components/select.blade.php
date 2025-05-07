<div class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    <select id="colorSelect" wire:model="color" class="mt-1 block w-full" onchange="changeColor()">
        <option selected>Selecione uma cor</option>
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
</div>