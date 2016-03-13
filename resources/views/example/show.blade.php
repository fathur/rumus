@extends('_layout.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('post.slug', $example->post->slug)}}">
            <h2>{{$example->post->title}}</h2>
            </a>
        </div>
    </div>
    <div class="row examples">

        <div class="col-md-12">

            <div class="edit">
                <a href="{{route('post.example.edit', [$example->post->id, $example->id])}}" class="btn">
                    <i class="fa fa-edit"></i> edit
                </a>
            </div>
            <div class="question">
                <h4>Pertanyaan</h4>
                {!! $example->parsed_question !!}
            </div>

            <div class="answer">
                <h4>Jawaban</h4>
                {!! $example->parsed_answer !!}
            </div>
        </div>
    </div>

@stop