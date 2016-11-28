
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
           
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/')}}">Blog</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar">
				
					
					
					@if(!Auth::guest() && Auth::user() )
                    <li>
                        <a href="{{ URL::to('users/'. Auth::id() . '/articles') }}">Home</a>
                    </li>
					@else
					<li>
                        <a href="{{URL::to('welcome')}}">Home</a>
                    </li>
					@endif
					
					@if(!Auth::guest() && Auth::user()->is_admin)
                    <li >
					
                        <a href="{{ URL::to('admin/users') }}">Users</a>
					
                    </li>
					@endif
					
					@if(!Auth::guest() && Auth::user()->is_admin)
					<li >
					
                        <a href="{{ URL::to('admin/articles') }}">Articles</a>
					
                    </li>
					@endif
					
					@if(!Auth::guest() && Auth::user()->is_admin)
					<li >
					
                        <a href="{{ URL::to('admin/tags') }}">Tags</a>
					
                    </li>
					@endif
                   
					@if(!Auth::guest() && Auth::user() )
					<li>
					<a href="{{ URL::to('article/create') }}">
					 Publish Article</a>
					</li>
					@else
					<li>
					<a href="{{ URL::to('welcome') }}">
					 Publish Article</a>
					</li>
					@endif
					
					
                    
               
				@if(Auth::check())
				<li class="dropdown">
                  <a  class="dropdown-toggle" data-toggle="dropdown">My space <b class="caret"></b></a>
				  <ul class="dropdown-menu" >
                  <li><a id="action-1" href="{{ URL::to('logout') }}">Logout</a>
                  </li>
                  <li><a href="{{ URL::to('users/'. Auth::id() . '/edit') }}" >Modify</a></li>
				  </ul>
				 </li>
                @else
				<li class="dropdown">
                  <a  class="dropdown-toggle" data-toggle="dropdown">My space <b class="caret"></b></a>
				  <ul class="dropdown-menu" >
                  <li><a id="action-1" href="{{URL::action('RegisterController@getLogin')}}">Login</a>
                  </li>
                  <li><a href="{{URL::action('RegisterController@getRegister')}}" >Register</a></li>
				  </ul>
				 </li>
				@endif
     
           
        </div>
		<script>
   $(function(){
      $(".dropdown-toggle").dropdown('toggle');
      });
</script>

    </nav>