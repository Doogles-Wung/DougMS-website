<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>dougMS</title>
	<meta name="description" content="" />
	<meta name="keywords" content=""/>
	<link href="../static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../static/css/custom.css" rel="stylesheet" type="text/css">
	<!--link href="static/images/favicon.png" rel="shortcut icon" type="image/x-icon" /-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="robots" content="index,follow" />
	<!--[if lt IE 9]>
		<script src="static/js/ie/html5shiv.js"></script>
		<script src="static/js/ie/respond.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]>
		<style type="text/css">
			.gradient {
				filter: none;
			}
		</style>
	<![endif]-->
</head>
    <body>
    <div class="container">
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DougMS</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li><a href="download.php">Download</a></li>
                <li><a href="#">Forums</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
				<?php if (!isset($_SESSION['username'])) { ?>
                	<li><a href="login.php">Login</a></li>
                	<li><a href="register.php">Register</a></li>
                	<?php } else { ?>
                	<li><a href="logout.php">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
   </nav>
    <div class="container title">
        <h1>DougMS</h1>
    </div>
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-default">
					<?php if (!isset($_SESSION['username'])) { ?>
					<div class="panel-heading">
						<h3 class="panel-title">Control Panel</h3>
					</div>
					<div class="panel-body">
						<form id="loginform" action="login.php" method="POST">
							<div class="form-group">
								<input id="sporter04" class="form-control" placeholder="Username" type="text" name="username">
							</div>
							<div class="form-group">
								<input  id="sporter05" class="form-control" placeholder="Password" type="password" name="password">
							</div>
							<div class="form-group">
						        <button class="btn btn-block btn-violet" type="submit">Login</button>
						    </div>
						</form>
                        <div id="message"></div>
					</div>
				</div>
				<?php } else { ?>
				<div class="panel-heading">
						<h3 class="panel-title">Account Information</h3>
					</div>
					<div class="panel-body">
						Welcome <?php echo $_SESSION['username'] ?>!
						<form id="loginform" action="logout.php" method="POST">
							<div class="form-group">
					       	 	<button class="btn btn-block btn-violet" type="submit">Logout</button>
							</div>
						</form>
                        <div id="message"></div>
					</div>
				</div>
				<?php }?>
				<div id="servinfo" class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Server Info</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6">
								<p>Version:</p>
								<p>Players:</p>
								<p>Rates:</p>
							</div>
							<div class="col-xs-6 text-right">
								<p><a href="download">83</a></p>
								<p>0</p><!-- If server is offline it says Offline -->
								<p>?, ?, ?</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Download</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="media download-block">
								<div class="media-body">
									<h4 class="media-heading">DougMS Client</h4>
									Download the dougMS client here!
								</div>
								<div class="media-left">
									<form method="get" action="../files/dougMS.exe">
										<button class="btn btn-block btn-lg btn-violet" type="submit">Download</button>
									</form>
								</div>
							</div>
						</div>
                        
                        <div class="row">
							<div class="media download-block">
								<div class="media-body">
									<h4 class="media-heading">Maplestory v83</h4>
									Download the MapleStory v83 here!
								</div>
								<div class="media-left">
                                    <button class="btn btn-block btn-lg btn-violet" onclick="window.open('http://www.mediafire.com/file/fl8af9c75bpeflt/MSSetupv83.exe')">Download</button>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="container copyright">
			<div class="col-lg-12">
                <p>Copyright © 2017 DougMS. <br>
			</div>
		</div>
	</footer>
	<script src="../static/js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="../static/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>