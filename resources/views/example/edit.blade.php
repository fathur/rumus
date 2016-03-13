@extends('_layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>{{$example->post->title}}</h2>
        </div>
    </div>

    <div class="row examples">
        <div class="col-md-12">

            <div class="m-bot-20">
                <form action="{{route('post.example.update', [$example->post->id, $example->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#editor" aria-controls="editor" role="tab" data-toggle="tab">Editor</a></li>
                        <li role="presentation"><a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">Preview</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content m-top-15">
                        <div role="tabpanel" class="tab-pane active" id="editor">

                            <div class="form-group">
                                <label for="question">Pertanyaan</label>
                                <textarea name="question" id="question" class="form-control">{!! $example->question !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="answer">Jawaban</label>
                                <textarea name="answer" id="answer" class="form-control">{!! $example->answer !!}</textarea>
                            </div>



                        </div>
                        <div role="tabpanel" class="tab-pane" id="preview">
                            <div id="parsed_content"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa fa-save"></i> Save
                    </button>

                </form>

            </div>


        </div>
    </div>
@stop


@section('script')
    <script>

        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var target = $(e.target).attr('href'); // newly activated tab

            target = target.substr(1);


            $.post('{{route('example.preview')}}', {
                _token: '{{csrf_token()}}',
                question: $('#question').val(),
                answer: $('#answer').val()
            }, function(resp) {
                $('#parsed_content').html(resp);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, document.getElementById('parsed_content')]);

            });
        });

        $("#question, #answer").markdown({
            autofocus:false,
            savable:false,
            hiddenButtons: 'cmdPreview',
            disabledButtons: 'cmdPreview'
        })
    </script>
@stop