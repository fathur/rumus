@extends('_layout.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="renderme"></div>

        <button type="button" id="render">render</button>
    </div>
</div>
@stop

@section('script')
    <script>
        var text = '$\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}$';

        $('#render').click(function(){
            $('#renderme').html(text);
            MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById('renderme')]);
        });
    </script>
@stop