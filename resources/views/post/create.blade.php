@extends('_layout.main')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="m-bot-20">
                <form action="{{route('post.store')}}" method="POST">


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#editor" aria-controls="editor" role="tab" data-toggle="tab">Editor</a></li>
                        <li role="presentation"><a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">Preview</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content m-top-15">
                        <div role="tabpanel" class="tab-pane active" id="editor">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text"
                                       class="form-control input-lg"
                                       title="Title"
                                       placeholder="Title"
                                       name="title"
                                       id="title">
                            </div>

                            <div class="form-group">
                                <textarea name="content" id="content" title="content" class="form-control"></textarea>
                            </div>



                        </div>
                        <div role="tabpanel" class="tab-pane" id="preview">
                            <div id="parsed_content"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categories">Categories</label>
                                {!! Form::select('categories[]', $categories, null, [
                                    'class' => 'form-control', 'id' => 'categories', 'multiple' => 'multiple'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tags">Tag</label>
                                <textarea name="tags" id="tags" class="form-control"></textarea>
                            </div>
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

@section('styles')
    <link rel="stylesheet" href="{{asset('components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('components/jquery.tagsinput/src/jquery.tagsinput.css')}}">
@stop

@section('scripts')
    <script src="{{asset('components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('components/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
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

        $('#categories').select2();
        $('#tags').tagsInput();

        $("#content").markdown({
            autofocus:false,
            savable:false,
            hiddenButtons: 'cmdPreview',
            disabledButtons: 'cmdPreview'
        })
    </script>
@stop