
<!DOCTYPE html>

<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>WeTranslate</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<!-- <meta http-equiv="pragma" content="no-cache" /> -->

	<link rel="icon" href="{{ URL::asset('assets/images/favicon.png') }}" />

	<!-- Open Sans font from Google CDN -->
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css"> -->
	<link href="{{ URL::asset('assets/temp/css.css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin') }}" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="{{ URL::asset('assets/stylesheets/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/pixel-admin.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/widgets.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/pages.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/rtl.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/themes.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/custom.css') }}" rel="stylesheet" type="text/css">

	<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>-->
	<script src="{{ URL::asset('assets/temp/angular.min.js') }}"></script>

	<script src="{{ URL::asset('angularjs/controllers/mainCtrl.js') }}"></script>
	<script src="{{ URL::asset('angularjs/services/commentService.js') }}"></script>
	<script src="{{ URL::asset('angularjs/app.js') }}"></script>

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->
</head>

<body class="theme-default main-menu-animated {{ $theme or '' }}">

<script>var init = [];</script>


<div id="main-wrapper">

	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
		
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">

				<!-- Logo -->
				<a href="{{ URL::route('home') }}" class="navbar-brand">
					<div><img alt="Pixel Admin" src="{{ URL::asset('assets/images/pixel-admin/main-navbar-logo.png') }}"></div>
					<img src="{{ URL::asset('assets/images/logo.png') }}" alt="" style="width: 100px">
				</a>

				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">
							<!-- /3. $END_NAVBAR_ICON_BUTTONS -->

							<li class="dropdown">
								<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
									<img src="{{ Auth::user()->photo(); }}" alt="">
									<span>{{ Auth::user()->firstname }}</span>
								</a>
								<ul class="dropdown-menu"> 
									<li><a href="{{ URL::route('users-profile', Auth::id()) }}">Profile</a></li>
									@if (Auth::user()->auth >= USER_AUTH_ADMIN)
									<li><a href="{{ URL::route('users-manage') }}">Manage users</a></li>
									@endif
									<li><a href="{{ URL::route('about') }}">About</a></li>
									<li class="divider"></li>
									<li><a href="{{ URL::route('account-sign-out') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
								</ul>
							</li>
						</ul> <!-- / .navbar-nav -->
					</div> <!-- / .right -->
				</div>
			</div> <!-- / #main-navbar-collapse -->
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->


	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
			<div class="menu-content top" id="menu-content-demo">
				<!-- Menu custom content demo
					 CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
					 Javascript: html/assets/demo/demo.js
				 -->
				<div>
					<div class="text-bg"><span class="text-slim">Hello,</span> <span class="text-semibold">{{ Auth::user()->firstname; }}</span></div>

					<img src="{{ Auth::user()->photo(); }}" alt="" class="">
					<div class="btn-group">						
						<a href="{{ URL::route('users-profile', Auth::id()) }}" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
						<!-- <a rhef="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a> -->
						<a href="{{ URL::route('account-sign-out') }}" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
					</div>
					<a href="#" class="close">&times;</a>
				</div>
			</div>
			<ul class="navigation">
				<li>
					<a href="{{ URL::route('home') }}"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
				</li>
				<li>
					<a href="{{ URL::route('home') }}"><i class="menu-icon fa fa-comments-o"></i><span class="mm-text">Time Linguístico</span></a>
				</li>

				<li>
					<a href="{{ URL::route('videos-translating') }}">&nbsp;&nbsp;&nbsp;&nbsp;<i class="menu-icon fa fa-angle-right"></i><span class="mm-text">Em aberto</span></a>
				</li>
				<li>
					<a href="{{ URL::route('videos-translating') }}">&nbsp;&nbsp;&nbsp;&nbsp;<i class="menu-icon fa fa-angle-right"></i><span class="mm-text">Publicados</span></a>
				</li>

				<li>
					<a href="{{ URL::route('videos-synchronizing') }}"><i class="menu-icon fa fa-wordpress"></i><span class="mm-text">Blog</span></a>
				</li>
				<li>
					<a href="{{ URL::route('articles-available') }}">&nbsp;&nbsp;&nbsp;&nbsp;<i class="menu-icon fa fa-angle-right"></i><span class="mm-text">Em aberto</span></a>
				</li>
				<li>
					<a href="{{ URL::route('articles-available') }}">&nbsp;&nbsp;&nbsp;&nbsp;<i class="menu-icon fa fa-angle-right"></i><span class="mm-text">Publicados</span></a>
				</li> 

				
			</ul> <!-- / .navigation -->

		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->

	<div id="content-wrapper">
		@if (Session::has('success'))
	    	<div class="alert alert-success alert-dark">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{ Session::get('success') }}
			</div>
		@elseif (Session::has('fail'))
			<div class="alert alert-danger alert-dark">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{ Session::get('fail') }}
			</div>			
    	@endif
		
	@yield('content')

	</div> <!-- / #content-wrapper -->
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->



<!-- Pixel Admin's javascripts -->
<script src="{{ URL::asset('assets/javascripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/javascripts/pixel-admin.min.js') }}"></script>



@yield('script')

</body>
</html>