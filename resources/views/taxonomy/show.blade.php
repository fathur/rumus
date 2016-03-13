@extends('_layout.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="list-unstyled">
                @foreach($taxonomy->posts as $post)
                    <li>
                        <a href="{{route('post.slug', $post->slug)}}">
                            <h3>{{$post->title}}</h3>
                        </a>

                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop