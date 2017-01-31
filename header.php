<!-- Navigation -->
<style>
	.dropdown-submenu {
		position: relative;
	}
	
	.dropdown-submenu .dropdown-menu {
		top: 0;
		left: 100%;
		margin-top: -1px;
	}
</style>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">SITE</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">NEMAID</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">                    
					<li>
                        <a href="SelectGenus.php">SelectGenus</a>
                    </li>
                    <li>
<<<<<<< HEAD
                        <a href="SampleDataEntry.php">Sample Data Entry</a>
=======
                        <a href="sampleDataEntry.php">Sample Data Entry</a>
>>>>>>> origin/master
                    </li>
					<li>
                        <a href="#">Perform a Comparison</a>
                    </li>
					<li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Databases<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                             <li><a href="#">Sous page 1</a></li>
							 <li><a href="#">Sous Page 2</a></li>							 
                         </ul>
                    </li>					
					<li>
						<a href="#" class="dropdown-toggle"  data-toggle="dropdown">Database Mangement<span class="caret"></span></a>
                        <ul class="dropdown-menu">   
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Genera <span class="caret"></span></a>  
								<ul class="dropdown-menu">
									<li><a href="#">Add a new genus</a></li>
									<li><a href="#">Find a genus</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Species Data<span class="caret"></span></a>  
								<ul class="dropdown-menu">
									<li><a href="#">Add a new description</a></li>
									<li><a href="#">Find a species</a></li>
								</ul>
							</li>
							<li><a href="#">References</a></li>
							<li>
								<a href="" class="dropdown" data-toggle="dropdown">Characters<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Add a new characters</a></li>
									<li><a href="#">List of characters</a></li>
									<li><a href="#">Fill characters</a></li>
								</ul>
							</li>					
							<li>
								<a href="#">Users</a>
							</li>
                        </ul>
                    </li>
					<li>
                        <a href="help.php">Help</a>
                    </li>
					<li>
                        <a href="deconnexion.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
		<script>
			$(document).ready(function(){
			$('.dropdown-submenu a.test').on("click", function(e){
				$(this).next('ul').toggle();
				e.stopPropagation();
				e.preventDefault();
			});
			});
		</script>		
    </nav>
