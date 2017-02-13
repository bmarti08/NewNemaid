<!-- Navigation -->
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
                        <a href="SelectGenus.php">Genus selection</a>
                    </li>
                    <li>
                        <a href="sampleDataEntry.php">Sample Data Entry</a>
                    </li>
					<li>
                        <a href="PerformComparison.php">Comparison Performance</a>
                    </li>
					<li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Databases views<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="findSpecies.php">Species data view</a></li>
							<li><a href="findReferences.php">References view</a></li>
							<li><a href="findCharacters.php">Characters view</a></li>							 
                         </ul>
                    </li>		
				<?php
					if($Admin == 1){
						echo'			
					<li>
					<a href="" class="dropdown-toggle" data-toggle="dropdown">Database Management<b class="caret"></b></a>
						<ul class="dropdown-menu multi-level" role="menu" aria-labelleby="dropdownMenu">   
							<li class ="dropdown-submenu">
								<a tabindex="-1" href="#">Genera</a>  
								<ul class="dropdown-menu">
									<li><a tabindex="-1" href="addgenus.php">Add a new genus</a></li>
									<li><a href="findGenus.php">Manage genus</a></li>
								</ul>
							</li>
							<li class ="dropdown-submenu">
								<a tabindex="-1" href="#">Species Data</span></a>  
								<ul class="dropdown-menu">
									<li><a href="addSpecies.php">Add a new species</a></li>
									<li><a href="findSpecies.php">Manage species</a></li>
								</ul>
							</li>
							<li class ="dropdown-submenu">
								<a tabindex="-1" href="#">Characters</a>
								<ul class="dropdown-menu">
									<li><a href="addCharacters.php">Add a new characters</a></li>
									<li><a href="findCharacters.php">Manage character</a></li>
								</ul>
							</li>	
							<li class ="dropdown-submenu">
								<a tabindex="-1" href="#">Authors</span></a>  
								<ul class="dropdown-menu">
									<li><a href="addAuthors.php">Add an author</a></li>
									<li><a href="findAuthors.php">Manage author</a></li>
								</ul>
							</li>							
							<li class ="dropdown-submenu">
								<a tabindex="-1" href="#">References</span></a>  
								<ul class="dropdown-menu">
									<li><a href="addReferences.php">Add a references</a></li>
									<li><a href="findReferences.php">Manage references</a></li>
								</ul>
							</li>
							<li>
								<a href="user.php">Users</a>
							</li>
						</ul>
					';
					}
			?>
					<li>
                        <a href="help.php"><span class="glyphicon glyphicon-question-sign text-center" style="font-size:15px;" title="Help"></span></a>
                    </li>
					<li>
                        <a href="deconnexion.php">
							<span class="glyphicon glyphicon-off text-center" style="color:red;font-size:15px;" title="Log off"></span>
						</a>
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
<style>	
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
</style>