	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">
					<img src="images/logo.png" width="30" height="30"> Samit Space
				</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li <?php echo $active_home; ?>><a href="index.php">Home</a></li>
					<li <?php echo $active_about; ?>><a href="about.php">About</a></li>
					<li <?php echo $active_service; ?>><a href="service.php">Service</a></li>
					<li <?php echo $active_portfolio; ?>><a href="portfolio.php">Portfolio</a></li>
					<li <?php echo $active_contact; ?>><a href="contact.php">Contact</a></li>
				</ul>
				
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>