<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
   <head>
	<title>Registration system PHP and MySQL</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="header.css">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
<body>
<div class="container">
        <div id="container" class="width">

        <header> 
        <div class="width">

        <h1><a href="/">Tamz Eshop</a></h1>

        <nav>

            <ul class="sf-menu dropdown">
                <li class="selected"><a href="cart.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Reister</a></li>
            </ul>

        
           <div class="clear"></div>
        </nav>
       </div>

<div class="clear"></div>

   
</header>


<div id="intro">

<div class="width">
  
    <div class="intro-content">

                <h2>Comfort and Style</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                  
                       <p><a href="#" class="button button-slider"><i class="fa fa-gbp"></i> Search Our Products</a>
                        <a href="#" class="button button-reversed button-slider"><i class="fa fa-info"></i> Shop With Us</a></p>
                

            </div>
            
        </div>
	</div>
	
	<div class="header">
		<h2>Login</h2>
	</div>
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
    </form>
    
    <footer class="width">
        <div class="footer-content">
            <ul>
            	<li><h4>Proin accumsan</h4></li>
                <li><a href="#">Rutrum nulla a ultrices</a></li>
            </ul>
            
            <ul>
            	<li><h4>Condimentum</h4></li>
                <li><a href="#">Curabitur sit amet tellus</a></li>
                <li><a href="#">Morbi hendrerit libero </a></li>
            </ul>

 	        <ul>
                <li><h4>Suspendisse</h4></li>
                <li><a href="#">Morbi hendrerit libero </a></li>
                <li><a href="#">Proin placerat accumsan</a></li>
            </ul>
            
            <ul class="endfooter">
            	<li><h4>Suspendisse</h4></li>
                <li>Integer mattis blandit turpis, quis rutrum est. Maecenas quis arcu vel felis lobortis iaculis fringilla at ligula. Nunc dignissim porttitor dolor eget porta. <br /><br />

                    <div class="social-icons">

                        <a href="#"><i class="fa fa-facebook fa-2x"></i></a>

                         <a href="#"><i class="fa fa-twitter fa-2x"></i></a>

                         <a href="#"><i class="fa fa-youtube fa-2x"></i></a>

                        <a href="#"><i class="fa fa-instagram fa-2x"></i></a>

                    </div>
                </li>
            </ul>
            
            <div class="clear"></div>
        </div>
              <div class="footer-bottom">
                  <p>&copy; 2019. <a href="http://rabtamz.com.ng/">Rabtamz Production</a> by Tamida</p>
              </div>
    </footer>
</body>
</html>