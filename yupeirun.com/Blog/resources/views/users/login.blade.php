<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog - Contact</title>

   
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

  
    <link href="{{ asset('css/clean-blog.min.css')}}" rel="stylesheet">
	
	<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.1/css/amazeui.min.css"/>
	
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  
</head>

<body>

@include('layouts.nav')

   
    <header class="intro-header" style="background-image: url('../img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <hr class="small">
                        <span class="subheading" ></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p></p>
				@if (Session::has('message'))
					<div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
						<p>{{ Session::get('message')['content'] }}</p>
					</div>
				@endif
              
                <form  action="{{URL::action('LoginController@postLogin')}}" method="post"  >
					
                   
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <label  for="email">E-mail:
            <input type="email" name="email" value="{{Input::old('email')}}" placeholder="">
        </label>
        <br>
        <label for="password">Password:
            <input type="password" name="password" value="" placeholder="">
        </label>
        <br>
        <label for="remember_me">
          <input id="remember_me" name="remember_me" type="checkbox" value="1">
          Remember Me
        </label>
        <br>
        <div class="am-cf">
        <input type="submit" name="submit" value="Login" class="am-btn am-btn-primary am-btn-sm am-fl">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.1/js/amazeui.min.js"></script>
  
</body>

</html>