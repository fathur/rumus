@extends('_layout.main')

@section('content')
    <div class="row article">
        <div class="col-md-12">
            <h2>{{$post->title}}</h2>
            <div class="edit">
                <a href="{{route('post.edit', $post->id)}}" class="btn">
                    <i class="fa fa-edit"></i> edit
                </a>
            </div>
            <div>
                {!! $post->parsed_content !!}
            </div>
        </div>
    </div>

    <hr>

    <div class="row examples">
        <div class="col-md-12">
            <h4>Contoh</h4>
            <div class="new m-bot-15">
                <a href="{{route('post.example.create', $post->id)}}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus-circle"></i> Buat Contoh
                </a>
            </div>
            <ol>
                @foreach($post->examples as $example)
                <li>
                    <div class="question">
                        {!! $example->parsed_question !!}
                    </div>
                    <div class="tools">

                        <a href="#" class="btn btn-xs btn-primary answer" data-answer-id="{{$example->id}}">
                            <i class="fa fa-check-square-o"></i> Jawaban
                        </a>

                        <a href="{{route('post.example.edit', [$post->id, $example->id])}}" class="btn btn-xs btn-warning">
                            <i class="fa fa-pencil"></i> Edit
                        </a>

                        <a href="{{route('post.example.show', [$post->id, $example->id])}}" class="btn btn-xs btn-primary">
                            <i class="fa fa-link"></i>
                        </a>
                    </div>

                    <div class="hide-me" id="answer-{{$example->id}}"></div>

                    <div class="clearfix"></div>
                </li>
                @endforeach

            </ol>
        </div>
    </div>
@stop

@section('styles')

@stop

@section('script')
    <script>
        $('.answer').click(function(e){
            e.preventDefault();
            var $this = $(this);

            var exampleId = $this.data('answerId');


            $.get('{{route('example.answer')}}', {
                example: exampleId
            }, function(resp){
                $this.parent().next().html(resp);
                $this.parent().next().toggle('fast');
                MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById('answer-'+exampleId)]);

            });
        });

    </script>
@stop