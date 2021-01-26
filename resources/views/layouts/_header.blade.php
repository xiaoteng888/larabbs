<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
	<div class="container">
		<!-- Branding Image -->
		<a href="{{url('/')}}" class="navbar-brand">论坛网站</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <!-- Left Side Of Navbar -->
	      <ul class="navbar-nav mr-auto">
	      	<li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link" href="{{ route('topics.index') }}">话题</a></li>
	      	@if(isset($categories))
	      	 @foreach($categories as $category)
             <li class="nav-item {{active_class((if_route('categories.show') && if_route_param('category',$category->id))) }}"><a class="nav-link" href="{{ route('categories.show',$category->id) }}">{{$category->name}}</a></li>
             @endforeach
            @endif
	      </ul>

	      <!-- Right Side Of Navbar -->
	      <ul class="navbar-nav navbar-right">
	        <!-- Authentication Links -->
	        @guest
	        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">登录</a></li>
	        <li class="nav-item"><a class="nav-link" href="{{route('register')}}">注册</a></li>
	        @else
	        <li class="nav-item">
	            <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
	              <i class="fa fa-plus"></i>
	            </a>
            </li>

            <li class="nav-item notification-badge">
	            <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
	              {{ Auth::user()->notification_count }}
	            </a>
           </li>

            <li class="nav-item dropdown">
            	<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            		<img src="{{Auth::user()->avatar}}" class="img-responsive img-circle" width="30px" height="30px">
            		{{Auth::user()->name}}
            	</a>
            	<div class="dropdown-menu" aria-lableledby="navbarDropdown">
            	<a href="{{route('users.show',Auth::user()->id)}}" class="dropdown-item">个人中心</a>
            	<a href="{{route('users.edit',Auth::user()->id)}}" class="dropdown-item">编辑资料</a>
            	<div class="dropdown-divider"></div>
            	<a href="#" class="dropdown-item" id="logout">
            		<form action="{{route('logout')}}" method="post" onsubmit="return confirm('您确定要退出吗？');">
            			@csrf
            			
            			<button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
            		</form>
            	</a>	
            	</div>
            </li>
	        @endguest
	      </ul>
	    </div>
	</div>
</nav>