<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
	
	
    <!-- Theme CSS -->
    <link href="{{ asset('css/clean-blog.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.1/css/amazeui.min.css"/>
	
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
	<script src="http://cdn.amazeui.org/amazeui/2.7.1/js/amazeui.min.js"></script>
	

    <!-- Custom Fonts -->
    
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    @include('layouts.nav')

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('../img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <hr class="small">
                        <span class="subheading"> Welcome to Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="am-g am-g-fixed">
  <div class="am-u-md-8">
    <!-- 循环输出文章 -->
      @foreach ($articles as $article)
      <article class="blog-main">
        <h3 class="am-article-title blog-title">
          <a href="{{ URL::route('article.show', $article->id) }}">{{{ $article->title }}}</a>
        </h3>
        <h4 class="am-article-meta blog-meta">
            by <a href="{{ URL::to('users/' . $article->users->id . '/articles') }}">{{{ $article->users->nickname }}}</a> posted on {{ $article->created_at->format('Y/m/d H:i') }} under 
            <!-- 输出标签 -->
        @foreach ($article->tags as $tag)
        <a href="#" style="color: #fff;" class="am-badge am-badge-success am-radius">{{ $tag->name }}</a>
            @endforeach
        </h4>
        <div class="am-g">
          <div class="am-u-sm-12">
            @if ($article->summary)
          <p>{!! $article->summary !!}</p>
            @endif
            <hr class="am-article-divider"/>
          </div>
        </div>
      </article>
      @endforeach
  </div>

  <!-- 显示标签信息侧栏 -->
  <div class="am-u-md-4 blog-sidebar">
      <br/>
    <div class="am-panel-group">
      <section class="am-panel am-panel-default">
        <div class="am-panel-hd"><span class="am-icon-tags"></span> <a href="{{ URL::to('tag')}}" title="Tags">Tags</a></div>
        <ul class="am-list">
          @for ($i = 0, $len = count($tags); $i < $len; $i++)
            <li>
              <a href="#">{{ $tags[$i]->name }} 
            @if ($i == 0)
              <span class="am-fr am-badge am-badge-danger am-round">{{ $tags[$i]->count }}</span>
            @elseif ($i == 1)
              <span class="am-fr am-badge am-badge-warning am-round">{{ $tags[$i]->count }}</span>
            @elseif ($i == 2)
              <span class="am-fr am-badge am-badge-success am-round">{{ $tags[$i]->count }}</span>
            @else
              <span class="am-fr am-badge am-round">{{ $tags[$i]->count }}</span>
            @endif
              </a>
            </li>
          @endfor          
        </ul>
      </section>
    </div>
  </div>
</div>
{!! $articles->render() !!} 
 

</body>

</html>
