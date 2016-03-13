<div class="m-top-15 answer lists">
    <div class="header">
        <div class="title"><h4>Jawaban: </h4></div>
        <div class="edit">
            <button type="button" class="btn btn-warning btn-xs" onclick="editAnswer(this)">
                <i class="fa fa-pencil"></i>
            </button>
        </div>

    </div>
    <div class="body">
        <div class="text" id="text-{{$id}}">
        {!! $example->parsed_answer !!}
        </div>
        <div class="editor hide-me">
            <form action="{{route('example.answer.update')}}"
                  method="POST"
                  data-id="{{$id}}"
                  class="form-answer">

                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#editor-{{$id}}" aria-controls="editor" role="tab" data-toggle="tab">Editor</a>
                    </li>
                    <li role="presentation">
                        <a href="#preview-{{$id}}" aria-controls="preview" role="tab" data-toggle="tab"
                           data-id="{{$id}}"
                           onclick="generatePreviewOnTheFly(this)">Preview</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content m-top-15">
                    <div role="tabpanel" class="tab-pane active" id="editor-{{$id}}">

                        <div class="form-group">
                            <textarea name="content"
                                      id="content"
                                      title="content"
                                      class="form-control answer-textarea">{!! $example->answer !!}</textarea>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="preview-{{$id}}">
                        <div id="parsed_content-{{$id}}"></div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary btn-sm" onclick="saveAnswer(this)">
                    <i class="fa fa-save"></i> Save
                </button>

            </form>
        </div>
    </div>
</div>