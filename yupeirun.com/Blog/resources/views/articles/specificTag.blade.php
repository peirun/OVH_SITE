<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

  
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{ asset('css/clean-blog.min.css')}}" rel="stylesheet">
	 
	<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.1/css/amazeui.min.css"/>
	
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	

    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

   

</head>

<body>

  
    @include('layouts.nav')

   
    <header class="intro-header" style="background-image: url('/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <hr class="small">
						@if(!Auth::guest())
                        <span class="subheading">{{{Auth::user()->nickname}}}, Welcome to Blog</span>
					    @else
						<span class="subheading">Welcome to Blog</span>
					    @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

   
    <div class="am-g am-g-fixed">
  <div class="am-u-sm-12">
    <br/>
    <blockquote>Tag: <span class="am-badge am-badge-success am-radius">{{{ $tag->name }}}</span></blockquote>
      @foreach ($articles as $article)
      <article class="blog-main">
        <h3 class="am-article-title blog-title">
          <a href="{{ URL::route('article.show', $article->id) }}">{{{ $article->title }}}</a>
        </h3>
        <h4 class="am-article-meta blog-meta">
            by <a href="{{ URL::to('users/' . $article->users->id . '/articles') }}">{{{ $article->users->nickname }}}</a> posted on {{ $article->created_at->format('Y/m/d H:i') }} under 
            @foreach ($article->tags as $tag)
        <a href="{{ URL::to('tag/' . $tag->id . '/articles') }}" style="color: #fff;" class="am-badge am-badge-success am-radius">{{ $tag->name }}</a>
            @endforeach
        </h4>
        <div class="am-g">
          <div class="am-u-sm-12">
            @if ($article->summary)
          <p>{{ $article->summary }}</p>
            @endif
            <hr class="am-article-divider"/>
          </div>
        </div>
      </article>
      @endforeach
    {{ $articles->render() }}
  </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.1/js/amazeui.min.js"></script>
	

               
</body>

</html>
