<?php 
$list = "";
		$navMenu = ['html','css','javascript','sql','php','bootstrap','how to','more','references','examples' ];
		$numbers = [18,2,43,46,5,6,87,8,9];
		foreach ($navMenu as $number) {
			$list .= "<li><a href=''>$number</a></li>";
		}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Nav</title>
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		nav{
			height: 60px;
			background-color: #4caf50;
		}
		nav ul{
			height: 100%;
		}
		nav li{
			display: inline-block;
			text-transform: uppercase;
			height: 100%;
			transition: 1s ease all;
		}

		nav li:hover{
			background-color: black;
		}
		nav ul li a{
			display: inline-block;
			padding: 20px;
			font-size: 15px;
			color: white;
			text-decoration: none;
		}

	</style>
</head>
<body>
	<nav>
		<ul>
			<li><a href=""><i class="fa fa-home"></i></a></li>
			<?php echo $list ?>
		</ul>
	</nav>
</body>
</html>