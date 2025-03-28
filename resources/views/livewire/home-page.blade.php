<div>
    {{-- <div class="">
        <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Usuário
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Categoria
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Assunto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prioridade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ação
                    </th>
                </tr>
            </thead>
            <tbody>

            </tbody>         
        </table>
    </div>--}}
    
        @foreach ($categories as $category)

            <h1>{{$category->category}}</h1><br>
            <h1>{{$category->color}}</h1>
        
        @endforeach
</div>
