@extends('layouts.blog')

@isset($showing)
    @php $description = 'Artículos acerca de ' . $showing->name; @endphp
    @section('meta_title', $description)
@endisset

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            @if ($posts->count())
                @isset($showing)
                    <div class="alert alert-info">
                        Showing posts in <strong>{{ $showing->name }}</strong>
                    </div>
                @endisset()
                @foreach ($posts as $post)
                    <article>
                        <h2 style="font-family: Nunito">
                            <a href="{{ route('posts', ['title' => str_replace(' ', '-', $post->url_path)]) }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <div>
                            <span class="badge badge-success">{{ $post->published_at }}</span>
                            <span class="badge badge-primary">{{ $post->category->name }}</span>
                            @if ($post->tags->count())
                                @foreach ($post->tags as $tag)
                                    <span class="badge badge-light">{{ $tag->name }}</span>
                                @endforeach
                            @endif
                        </div>
                        <p class="text-justify">
                            {!! substr(strip_tags($post->content), 0, 256) . '...' !!}
                        </p>
                        <footer class="pt-2">
                            by {{ $post->author->user->name }}
                        </footer>
                    </article><br /><br />
                @endforeach
            @else
                @if(isset($showing))
                    <div class="alert alert-info">
                        There are no posts in this category
                    </div>
                @else
                    <div class="alert alert-info">
                        There are no posts
                    </div>
                @endif()
            @endif
        </div>
        <div class="col-sm-3">
            <div class="widget">
                <h5>Categorías</h5>
                <ul style="list-style: none; padding: 0;">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category', ['id' => $category->category_id]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
