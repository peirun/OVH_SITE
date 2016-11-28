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
	 <script src="{{asset('js/jquery.min.js')}}"></script>
	 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.1/css/amazeui.min.css"/>
	
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
	<script src="http://cdn.amazeui.org/amazeui/2.7.1/js/amazeui.min.js"></script>
	

   
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

   <!-- Navigation -->
    @include('layouts.nav')
            <!-- /.navbar-collapse -->
       
        <!-- /.container -->
    

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style= "background-image: url('/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <hr class="small">
                        <span class="subheading">{{{Auth::user()->nickname}}}, Welcome to Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
	<div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p></p>
				@if (Session::has('message'))
					<div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
						<p>{{ Session::get('message')['content'] }}</p>
					</div>
				@endif
		@if ($errors->has())
        <div class="am-alert am-alert-danger" data-am-alert>
          <p>{{ $errors->first() }}</p>
        </div>
      @endif
     <form  action="{{URL::to('users/'.$user->id)}}" method="post"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					
                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<label for="email">Email:
						<br>
				<input type="email" name="email" value="" placeholder="" class="">
					</label>
					<br>
				<label for="nickname">NickName:
					<br>
				<input type="text" name="nickname" value="" placeholder="">
				</label>
					<br>
				<label for="old_password">OldPassword:
					<br>
				<input type="password" name="old_password" value="" placeholder="">
				</label>
					<br>
				<label for="password">NewPassword:
					<br>
				<input type="password" name="password" value="" placeholder="">
				</label>
					<br>
				<label for="confirm_password">ConfirmPassword:
					<br>
				<input type="password" name="password_confirmation" value="" placeholder="">
					</label>
					<br>
				<div class="am-cf">
          <input type="submit" name="submit" value="Modify" class="am-btn am-btn-primary am-btn-sm am-fl">
				</div>
			</form>
	     </div>
        </div>
    </div>
                <!-- Pager -->
                @include('layouts.pager')

    <hr>

    <!-- Footer -->
   @include('layouts.footer')
	<!-- jQuery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Contact Form JavaScript -->
   

    <!-- Theme JavaScript -->
    

</body>

</html>
