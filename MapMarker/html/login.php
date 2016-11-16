<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述三个meta标签*必须*放在最前面-->
	<meta name="description" content="mapMarker_Login">
	<meta name="author" content="SQS">
	<link rel="stylesheet" type="text/css" href="../../favicon.ico">
	<title>Login</title>
	<!--Bootstrap core CSS-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!-- Loading Flat UI -->
    <link href="../css/flat-ui.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
<div class="container">
    <div class="login">
    	<div class="login-screen">
          	<div class="login-icon">
            	<img src="../img/Map.png" alt="Welcome to Map Marker" />
            	<h4>Welcome to <small>Map Marker</small></h4>
          	</div>

          	<form class="login-form" action="../php/logincheck.php" method="post">
            	<div class="form-group">
              		<input type="text" class="form-control login-field"  placeholder="Enter your name" name="login-name" />
              		<label class="login-field-icon fui-user" for="login-name">	</label>
            	</div>

            	<div class="form-group">
              		<input type="password" class="form-control login-field"  placeholder="Password" name="login-pass" />
              		<label class="login-field-icon fui-lock" for="login-pass"></label>
            	</div>

            	<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="login" />
            	<a class="login-link" href="#">Lost your password?</a>
           	</form>
       	</div>
    </div>
</div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/vendor/video.js"></script>
    <script src="../js/flat-ui.min.js"></script>
</body>
</html>