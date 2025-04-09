<div>
    <div style="table-layout: auto; width: 100%; border: 1px solid;" >
        <table style="margin-bottom: 0px;" class="table">
            <thead>
                <tr style="text-align: center;" >
                    <th style="background-color: black; color: aliceblue; border: none;" scope="col">Id</th>
                    <th style="background-color: black; color: aliceblue; border: none;" scope="col">Categoria</th>
                    <th style="background-color: black; color: aliceblue; border: none;" colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr style="text-align: center;">
                    <td style="background: {{$category->color}}; border: none;">{{$category->id}}</td>
                    <td style="background: {{$category->color}}; border: none;">{{$category->category}}</td>
                    <td style="background: {{$category->color}}; border: none;">
                        <a href="{{ route('category_show', ['id'=>$category->id]) }}">
                        <button type="button" class="btn btn-info">Editar</button>
                        </a>
                    </td>
                    <td style="background: {{$category->color}}; border: none;">
                        <livewire:delete-category :id="$category->id" >
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{route('category_create')}}">
        <button style="background-color: black; color: aliceblue;" type="submit" class="btn">Criar Nova Categoria</button>
    </a>
</div>