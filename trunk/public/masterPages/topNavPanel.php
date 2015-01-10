<div class="top-navbar">
	<div class="top-navbar-inner">

		<!-- Begin Logo brand -->
		<div class="logo-brand">
			<a href="index.html"><img src="assets/img/sentir-logo-primary.png"
				alt="Sentir logo"></a>
		</div>
		<!-- /.logo-brand -->
		<!-- End Logo brand -->

		<div class="top-nav-content">

			<!-- Begin button sidebar left toggle -->
			<div class="btn-collapse-sidebar-left">
				<i class="fa fa-long-arrow-right icon-dinamic"></i>
			</div>
			<!-- /.btn-collapse-sidebar-left -->
			<!-- End button sidebar left toggle -->

			<!-- Begin button sidebar right toggle -->
			<div class="btn-collapse-sidebar-right">
				<i class="fa fa-comments"></i>
			</div>
			<!-- /.btn-collapse-sidebar-right -->
			<!-- End button sidebar right toggle -->

			<!-- Begin user session nav -->
			<ul class="nav-user navbar-right">
				<li class="dropdown"><a href="#fakelink" class="dropdown-toggle"
					data-toggle="dropdown"> <img src="assets/img/avatar/avatar-1.jpg"
						class="avatar img-circle" alt="Avatar"> Hi, <strong>Paris Hawker</strong>
				</a>
					<ul
						class="dropdown-menu square primary margin-list-rounded with-triangle">
						<li><a href="?menu=<?php echo PAGE_USER_REGISTER ?>">Create New Account</a></li>
						<li><a href="?menu=<?php echo PAGE_MANAGE_USER ?>">Manage User</a></li>
						<li><a href="?menu=<?php echo PAGE_FOOD ?>">Food</a></li>
						<li class="divider"></li>
						<li><a href="controls/Site.php?OpenPage">Site Configuration</a></li>
						<li class="divider"></li>
						<li><a href="controls/UserControl.php?Logout" target="_self">Log out</a></li>
					</ul></li>
			</ul>
			<!-- End user session nav -->

			<!-- Begin Collapse menu nav -->
			<div class="collapse navbar-collapse" id="main-fixed-nav">
				<!-- Begin nav search form -->
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
				<!-- End nav search form -->
				
			</div>
			<!-- /.navbar-collapse -->
			<!-- End Collapse menu nav -->
		</div>
		<!-- /.top-nav-content -->
	</div>
	<!-- /.top-navbar-inner -->
</div>
<!-- /.top-navbar -->