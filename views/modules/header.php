<header class="main-header">
	<!-- logo -->
	<a href="home" class="logo">
		<!-- mini logo -->
		<span class="logo-mini">
			<img src="views/img/template/icono-blanco.png" class="img-responsive" style="padding: 10px">
		</span>
		<!-- mini natural -->

		<span class="logo-natural">
			<img src="views/img/template/logo-blanco-lineal.png" class="img-responsive" style="padding: 10px 0px">
		</span>

		

	</a>
	<!-- Navigation bar -->

	<nav class="navbar navbar-static-top" role="navigation">
		<!-- nav button -->
		
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			<!--<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span> -->
		</a>
		<!-- user profile -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="views/img/users/default/anonymous.png" class="user-image">
						<span class="hidden-xs"> <?php echo $_SESSION["name"]; ?> </span>

					</a>
					<!-- Dropdown-toggle -->
					<ul class="dropdown-menu">
						<li class="user-body">
							<div class="pull-right">

								<a href="logout" class="btn-default">Logout</a>
					
							</div>
				
						</li>

			
					</ul>
					
				</li>
				
			</ul>
			
		</div>



		

		


	</nav>
	
</header>