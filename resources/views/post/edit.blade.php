@extends('_layout.main')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="m-bot-20">
            <form action="{{route('post.update', $post->id)}}" method="POST">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#editor" aria-controls="editor" role="tab" data-toggle="tab">Editor</a></li>
                    <li role="presentation"><a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">Preview</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content m-top-15">
                    <div role="tabpanel" class="tab-pane active" id="editor">


                        <div class="form-group">
                            <input type="text"
                                   class="form-control input-lg"
                                   title="Title"
                                   value="{{$post->title}}"
                                   placeholder="Title"
                                   name="title"
                                   id="title">
                        </div>

                        <div class="form-group">
                            <textarea name="content" id="content" title="content" class="form-control">{!! $post->content !!}</textarea>
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


        $.post('{{route('post.preview')}}', {
            _token: '{{csrf_token()}}',
            title: $('#title').val(),
            content: $('#content').val()
        }, function(resp) {
            $('#parsed_content').html(resp);
            MathJax.Hub.Queue(["Typeset", MathJax.Hub,document.getElementById('parsed_content')]);

        });
        //e.relatedTarget // previous active tab
    });

    $("#content").markdown({
        autofocus:false,
        savable:false,
        hiddenButtons: 'cmdPreview',
        disabledButtons: 'cmdPreview'
    })
</script>
@stop