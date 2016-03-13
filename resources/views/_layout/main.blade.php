
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('components/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        var config = {
            _token: '{{csrf_token()}}'
        };
    </script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            tex2jax: {
                inlineMath: [['$','$'], ['\\(','\\)']]
            },
            processClass: 'jax'
        });
    </script>
    <script src="{{asset('components/MathJax/MathJax.js')}}?config=TeX-MML-AM_CHTML"></script>


    @yield('styles')
    @yield('style')
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item" href="{{url('/')}}">Home</a>
            <a class="blog-nav-item" href="{{url('matematika')}}">Matematika</a>
            <a class="blog-nav-item" href="{{url('fisika')}}">Fisika</a>
        </nav>
    </div>
</div>

<div class="container">

    <div class="blog-header">{{--
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>--}}
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">

           @yield('content')

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            @include('_layout.sidebar')
        </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer">
    <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('components/jquery/dist/jquery.min.js')}}"></script>
<script>window.jQuery || document.write('<script src="{{asset('components/jquery/dist/jquery.min.js')}}"><\/script>')</script>
<script src="{{asset('components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{asset('components/bootstrap3-ie10-viewport-bug-workaround/ie10-viewport-bug-workaround.js')}}"></script>
<script src="{{asset('components/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('scripts')
@yield('script')
</body>
</html>
