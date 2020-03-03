<?php
session_start();
$product_ids = array();
//session_destroy();

//check if add to cart btton has been submitted.
if(filter_input(INPUT_POST, 'add_to_cart')){
    //check if the shopping cart session exist
    if(isset($_SESSION['shoping_cart'])) {
        //keep track of how many products are in the shoping cart
        $count = count($_SESSION['shoping_cart']);
        //craete sequential array for matching keys to product id's
        $product_ids = array_column($_SESSION['shoping_cart'], 'id');
        if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)) {
            $_SESSION['shopping_cart'][$count] = array
            (
             'id' => filter_input(INPUT_GET, 'id'),
             'name' => filter_input(INPUT_POST, 'name'),
             'price' => filter_input(INPUT_POST, 'price'),
             'quantity' => filter_input(INPUT_POST, 'quantity'),
            );
        }
        else{//product already exist, increase quantity
            //match array key to thr id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++) {
                if($product_ids[$i] == filter_input(INPUT_GET, 'id')){

                    //add item quantity to the existing product in the array
                    $_SESSION['shoping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
    }
    else{//if shoping cart does not exist, create first product with array key 0
         //create array using submitted form data, start from key 0 and filled with values.
         $_SESSION['shopping_cart'][0] = array
         (
          'id' => filter_input(INPUT_GET, 'id'),
          'name' => filter_input(INPUT_POST, 'name'),
          'price' => filter_input(INPUT_POST, 'price'),
          'quantity' => filter_input(INPUT_POST, 'quantity'),
         );
        
    }
}
if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through shoping cart untill it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
     //reset session array key so they match with $product_ids numeric array
     $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}
//pre_r($_SESSION);
function pre_r($array){
    echo'<pre>';
    print_r($array);
    echo'</pre>';

}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Eshop Cart</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="cart.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/slider.js"></script>
        <script type="text/javascript" src="js/superfish.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </head>

    <body>
    <div id="container" class="width">

<header> 
    <div class="width">

        <h1><a href="/">Tamz Eshop</a></h1>

        <nav>

            <ul class="sf-menu dropdown">
                       <li><a href="cart.php">Home</a></li>
                       <li><a href="login.php?action">Login</a></li>
                       <li><a href="register.php">Register</a></li>
            </ul>
               <div class="clear"></div>
        </nav>
    </div>

<div class="clear"></div>
</header>


<div id="intro">

    <div class="width">
  
            <div class="intro-content">

                <h2>Comfort and Style </h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                  
                 <p><a href="#" class="button button-slider"><i class="fa fa-gbp"></i> Search Our Products</a>
                 <a href="#" class="button button-reversed button-slider"><i class="fa fa-info"></i> Shop With Us</a></p>
                
            </div>
            
    </div>

</div>

        <?php
        //connect to database 
        $connect = mysqli_connect($host = 'localhost',$user = 'root', $password ='', $database = 'cart', $port = '3306', $socket = '');
        $query = 'SELECT * FROM products ORDER by id ASC';

        //execute query and store everything in a result variable
        $result = mysqli_query($connect, $query);
        // check if product table is not empty
        if($result):
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                
                    ?>
                    <div class="col-sm-4 col-md-3">
                        <form method="POST" action="cart.php?action=add&id=<?php echo $product['id']; ?>">
                           <div class="products">
                               <img src="<?php echo $product['image'];?>" class="img-responsive"/>
                               <h4 class="text-info"><?php echo $product['name'];?> </h4>
                               <h4>$<?php echo $product['price'];?> </h4>
                               <input type="text" name="quantity" class="form-control"  value="1"/>
                               <input type="hidden" name="name" value="<?php echo $product['name'];?>"/>
                               <input type="hidden" name="price" value="<?php echo $product['price'];?>"/>
                               <input type="submit" name="add_to_cart" style="margin-top:5px" lass="btn btn-info" value="Add to Cart"/>
                           </div>
                        </form>
                    </div>
                    <?php
                endwhile;
            endif;
        endif;
        ?>
        <div style="clear:both"></div>
        <br/>
        <div class="table-resposive">
            <table class="table">
                <tr><th colspan="5"><h3> Order Details</h3></th></tr>
                <tr>
                    <th width = "40%"> Product Name </th>
                    <th width = "10%"> Quantity </th>
                    <th width = "20%"> Price </th>
                    <th width = "15%"> Total </th>
                    <th width = "5%"> Action </th>
                </tr>
                <?php
                if(!empty($_SESSION['shopping_cart'])):
                    $total = 0;
                    foreach($_SESSION['shopping_cart'] as $key => $product):
                ?>
                <tr>
                    <td><?php echo $product['name'];?></td>
                    <td><?php echo $product['quantity'];?></td>
                    <td><?php echo $product['price'];?></td>
                    <td><?php echo number_format($product['quantity'] * $product['price'], 2); ;?></td>
                    <td>
                       <a href="cart.php?action=delete&id=<?php echo $product['id'];?>">
                         <div class="btn-danger">Remove</div>
                       </a>
                    </td>
                </tr>
                <?php
                  $total = $total + ($product['quantity']*$product['price']);
                    endforeach;
                ?>
                <tr>
                    <td colspan="3" align="right"> Total </td>
                    <td align="right">$ <?php echo number_format($total,2);?></td>
                    <td></td>
                </tr>
                <tr>
                    <!-- show checkout button only if the shoping cart is not empty-->
                    <td colspan="5">
                        <?php
                        if(isset($_SESSION['shopping_cart'])):
                            if(count($_SESSION['shopping_cart']) > 0):
                                ?>
                                <a href="#" class="botton"> Checkout </a>
                            <?php endif; endif;?>
                    </td>
                </tr>
                            <?php endif;?>
            </table>
        </div>
        <!--  footer section-->
        <footer class="width">
        <div class="footer-content">
            <ul>
            	<li><h4>Proin accumsan</h4></li>
                <li><a href="#">Rutrum nulla a ultrices</a></li>
                <li><a href="#">Blandit elementum</a></li>
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
            <p>&copy; YourSite 2019. <a href="http://rabtamz.com.ng/">Rabtamz Production</a> by Tamida</p>
         </div>
    </footer>
    </body>
</html>