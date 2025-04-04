<div>
    <div style="table-layout: auto; width: 100%; border: 1px solid;" >
        <table style="" class="table">
            <thead>
                <tr style="text-align: center">
                    <th style="background-color: black; color: aliceblue;" scope="col">Id</th>
                    <th style="background-color: black; color: aliceblue;" scope="col">Categoria</th>
                    <th style="background-color: black; color: aliceblue;" colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr style="text-align: center;">
                    <td style="background: {{$category->color}}">{{$category->id}}</td>
                    <td style="background: {{$category->color}}">{{$category->category}}</td>
                    <td style="background: {{$category->color}}">
                        <a href="{{ route('category_show', ['id'=>$category->id]) }}" wire:click:categoryEdit{{ $category->id }}>
                            <button type="button" class="btn btn-info">Editar</button>
                        </a>
                    </td>
                    <td style="background: {{$category->color}}">
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