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
                        <span class="subheading"> Welcome to Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="am-g am-g-fixed">
  <div class="am-u-sm-12">
      <h1>Edit Article</h1>
      <hr/>
    @if ($errors->has())
    <div class="am-alert am-alert-danger" data-am-alert>
      <p>{{ $errors->first() }}</p>
    </div>
    @endif
<!-- ÎÄÕÂ±à¼­±íµ¥ -->
  <form action="{{ URL::route('article.update',$article->id)}}" method="post" accept-charset="utf-8" class="am-form">
      <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">
      <div class="am-form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $article->title}}" placeholder="">
      </div>
      <div class="am-form-group">
        <label for="content">Content:</label>
        <textarea name="content" id="content" rows="20" >{{ $article->content }}</textarea>
        <p class="am-form-help">
          <button id="preview" type="button" class="am-btn am-btn-xs am-btn-primary">
          <span class="am-icon-eye"></span> Preview
          </button>
        </p>
      </div>
      <div class="am-form-group">
        <label for="tags">Tags:
            <input type="text" name="tags" value="{{ $article->tags }}" placeholder="">
        </label>
        <p class="am-form-help">Separate multiple tags with a comma ","</p>
      </div>
      <p><button type="submit" class="am-btn am-btn-success">
        <span class="am-icon-pencil"></span> Modify</button>
      </p>
  </form>
  </div>
</div>

<div class="am-popup" id="preview-popup">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title"></h4>
      <span data-am-modal-close
            class="am-close">&times;</span>
    </div>
    <div class="am-popup-bd">
    </div>
  </div>
</div>
<script>
  $(function() {
      $('#preview').on('click', function() {
          $('.am-popup-title').text($('#title').val());
          $.post('preview', {'content': $('#content').val(),'_token':$('#token').val()}, function(data, status) {
            $('.am-popup-bd').html(data);
          });
          $('#preview-popup').modal();
      });
  });
</script>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.1/js/amazeui.min.js"></script>
 

</body>

</html>