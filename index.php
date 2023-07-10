
<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }

    /*-----adding product to wishlist-------*/
   
    if(isset($_POST['add_to_wishlist'])){
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['prpduct_image'];

        $wishlist_number=mysqli_query($conn,"SELECT * FROM wishlist WHERE name='$product_name' AND user_id='$user_id'") or die
        ('querry failed');
        $cart_number=mysqli_query($conn,"SELECT * FROM cart WHERE name='$product_name' AND user_id='$user_id'") or die
        ('querry failed');
        if (mysqli_num_rows($wishlist_number)>0){
        $message[]='product already exist in wishlist!';
        }else if(mysqli_num_rows($cart_number)>0){
            $message[]='product already exist in cart!';
    }  else{
        mysqli_query($conn,"INSERT INTO wishlist (user_id,pid,name,price,image)VALUES('$user_id','$product_id'
        ,'$product_name','$product_price','$product_image')");
         $message[]='product successfuly added in wishlist!';
    }
}
/*-----adding product to cart-------*/

if(isset($_POST['add_to_cart'])){
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_quantity=$_POST['product_quantity'];
    $product_image=$_POST['product_image'];
    
    
    $cart_number=mysqli_query($conn,"SELECT * FROM cart WHERE name='$product_name' AND user_id='$user_id'") or die
    ('querry failed');
    if(mysqli_num_rows($cart_number)>0){
        $message[]='product already exist in cart!';
}  else{
    mysqli_query($conn,"INSERT INTO cart (user_id,pid,name,price,quantity,image)VALUES('$user_id','$product_id'
    ,'$product_name','$product_price','$product_quantity','$product_image')");
     $message[]='product successfuly added in cart!';
}
}
    ?>
    <style type="text/css">
        <?php include 'footer.css';?>
        </style>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link rel="stylesheet" type="text/css"  href="footer.css">
            <link rel="stylesheet" type="text/css"  href="style.css">
           
            <title> Flower Shop </title>
        </head> 
        <body>
         <?php include 'header.php' ;?>
         <!-- <div class="slider-section">
            <div class="slide-show-container">
                <div class="wrapper-one">
                    <dv class="wrapper-text"> Inspired by Nature </div>
                 </div>   
                 <div class="wrapper-two">
                    <dv class="wrapper-text"> Flower For You </div>
                 </div>   
                 <div class="wrapper-three">
                    <dv class="wrapper-text"> Inspired by Nature </div>
                 </div>   
            </div>
        </div> -->
        <div class="row">
            <div class="card">
                <div class="detail">
                    <span> 30% OFF TODAY </span>
                    <h1> Simple & Elegant </h1>
                    <a href="shop.php"> shop now </a>
                </div>
            </div>
            <div class="card">
                <div class="detail">
                    <span> 30% OFF TODAY </span>
                    <h1> Simple & Elegant </h1>
                    <a href="shop.php"> shop now </a>
                </div>
            </div>
            <div class="card">
                <div class="detail">
                    <span> 30% OFF TODAY </span>
                    <h1> Simple & Elegant </h1>
                    <a href="shop.php"> shop now </a>
                </div>
            </div>
        </div>
        <div class="categories">
            <h1 class="title">TOP CATEGORIES</h1>
            <div class="box-container">
                    <div class="box">
                       <img src="img/bday.jpg">
                       <span> Birthday</span>
                    </div> 
                     <div class="box">
                       <img src="img/congrats.jpg">
                       <span> Congratulation</span>
                    </div>
                    <div class="box">
                       <img src="img/anniv.jpg">
                       <span> anniversary</span>
                    </div>
                   <div class="box">
                       <img src="img/newborn.jpg">
                      <span> newborn</span>
                   </div>
                    <div class="box">
                         <img src="img/love.jpg">
                        <span> love & romance</span>
                    </div>
                <div class="box">
                    <img src="img/gws.jpg">
                    <span> get well soon</span>
                </div>  
                <div class="box">
                         <img src="img/symp.jpg">
                        <span> sympthye</span>
                    </div>
                    <div class="box">
                         <img src="img/sry.jpg">
                        <span>thank you</span>
                    </div> 
            </div>
        </div>
        <div class="banner3">
            <div class="detail">
                <span> BETTER THAN CAKE </span>
                <h1> BIRTHDAY BOQUETS </h1>
                <p> Believe in birthday magic? Celebrate with us-BLOOM VINTAGE</p>
                <a href="shop.php">explore <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>      
        <div class="shop">
            <h1 class="title"> shop best seller </h1>
            <?php
                if (isset($message)){
                foreach($message as $message){
                 echo'
                <div class ="message">
             <span >'.$message.' </span>
            <i class ="bi bi-x--circle" onclick="this.parentElement.remove()"> </i>
            </div>
            ';
        }
      }
    ?>
    <div class="box-container">
        <?php
           $select_products=mysqli_query($conn,"SELECT * FROM products")or die('query failed');
           if(mysqli_num_rows($select_products)>0){
            while ($fetch_products=mysqli_fetch_assoc($select_products)){
               
         ?>
         <form method="post" action="" class="box">
        <img src="image/<?php echo $fetch_products['image'];?>">
        <div class="price"><?php echo $fetch_products['price'];?>/- </div>
        <div class="name"><?php echo $fetch_products['name'];?> </div>
        <input type="hidden" name="product_id"  value="<?php echo $fetch_products['id'];?>">
        <input type="hidden" name="product_name"  value="<?php echo $fetch_products['name'];?>">
        <input type="hidden" name="product_price"  value="<?php echo $fetch_products['price'];?>">
        <input type="hidden" name="product_quantity"  value="1" min="0">
        <input type="hidden" name="product_image"  value="<?php echo $fetch_products['image'];?>">
        <div class="icons">
            <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="fas fa-eye"></a>
            <button type="submit" name="add-to-wishlist" class="fa fa-heart"></button>
            <button type="submit" name="add-to-cart" class="fas fa-shopping-cart"></button>
            </div>
            </form>
        <?php 
            }
        }else{
            echo '<p class="empty"> no products add yet </p>';
        }
        ?>
        </div>
    <div class="more">
        <a href="shop.php">load more </a>
        <i class="fa fa-arrow-down"></i>
    </div>
    </div>
         <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
        </body>
    </html>