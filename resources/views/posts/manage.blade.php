@extends('layouts.main')

@section('title')

@section('content')


<div style="overflow: auto;">
    <table class="table mt-5 alert-info rounded">
        <thead>
            <tr>
                <th>Заголовок</th>
                <th>Содержание</th>
                <th>Видимость</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr style="border-color: {{$post->color}}; border-style: solid; border-width: 4px;">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->getShortContent() }}</td>
                    <td>{{ $post->isPersonal() }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="post" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Удалить пост {{$post->title}}?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    
    {{ $posts->links('pagination::bootstrap-5') }} <!-- Пагинация -->




@endsection
