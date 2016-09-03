<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
	#container {
		margin: 50px;
		border: 1px solid #D0D0D0;
		box-shadow: -3px 3px 8px #D0D0D0;
	}
	#container h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 25px;
		
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
	#container p {
		display: block;
		margin-left:20px;
		color:#666;
	}
</style>
</head>

<body>
	<div id="container">
    	<h1>404 Page Not Found</h1>
        <p><?php echo $error;?></p>
        <p>The page you requested was not found.</p>
    </div>
</body>
</html>