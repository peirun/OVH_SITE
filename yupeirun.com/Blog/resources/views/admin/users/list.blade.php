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

   <!-- Navigation -->
   @include('layouts.nav')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <hr class="small">
                        <span class="subheading">{{{ Auth::user()->nickname }}}, Welcome to Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
  <div class="am-g am-g-fixed">
  <div class="am-u-sm-12">
      <br/>
      @if (Session::has('message'))
        <div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
          <p>{{ Session::get('message')['content'] }}</p>
        </div>
     @endif
    <!-- users-list -->
      <table class="am-table am-table-hover am-table-striped ">
      <thead>
      <tr>
        <th>ID</th>
        <th>E-mail</th>
        <th>Nickname</th>
        <th>Management</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->email }}</td>
          <td><a href="{{ URL::to('users/' . $user->id . '/articles') }}">{{{ $user->nickname }}}</a></td>
        <td>
          <a href="{{ URL::to('users/'.$user->id .'/edit') }}" class="am-btn am-btn-xs am-btn-primary">Edit</a>
      <form action="{{URL::to('users/'.$user->id .'/reset')}}" method="get" accept-charset="utf-8" style="display: inline;">
        <button type="button" class="am-btn am-btn-xs am-btn-warning" id="reset{{ $user->id }}">Reset</button>
      </form>
      @if ($user->block)
      <form action="{{URL::to('users/'.$user->id .'/unblock')}}" method="get" accept-charset="utf-8" style="display: inline;">
        <button type="button" class="am-btn am-btn-xs am-btn-danger" id="unblock{{ $user->id }}">Unblock</button> 
      </form>
      @else
      <form action="{{URL::to('users/'.$user->id .'/delete')}}" method="get" accept-charset="utf-8" style="display: inline;">
        <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $user->id }}">Block</button>
      </form>
          @endif
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- µ¯³ö¿ò -->
<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
  <div class="am-modal-dialog">
    <div class="am-modal-bd">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>No</span>
      <span class="am-modal-btn" data-am-modal-confirm>Yes</span>
    </div>
  </div>
</div>
<script>
  $(function() {
    $('[id^=reset]').on('click', function() {
      $('.am-modal-bd').text('Sure you want to reset the password for 123456?');
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
          $(this.relatedTarget).parent().submit();
        },
        onCancel: function() {
        }
      });
    });

    $('[id^=delete]').on('click', function() {
      $('.am-modal-bd').text('Sure you want to lock it?');
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
          $(this.relatedTarget).parent().submit();
        },
        onCancel: function() {
        }
      });
    });

    $('[id^=unblock]').on('click', function() {
      $('.am-modal-bd').text('Sure you want to unlock it?');
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
          $(this.relatedTarget).parent().submit();
        },
        onCancel: function() {
        }
      });
    });
  });
</script>

                <!-- Pager -->
                @include('layouts.pager')

    <hr>

    <!-- Footer -->


</body>

</html>
