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
        $product_image=$_POST['product_image'];

        $wishlist_number=mysqli_query($conn,"SELECT * FROM wishlist WHERE name='$product_name' AND user_id='$user_id'") or die
        ('querry failed');
        $cart_number=mysqli_query($conn,"SELECT * FROM cart WHERE name='$product_name' AND user_id='$user_id'") or die
        ('querry failed');
        if (mysqli_num_rows($wishlist_number)>0){
        $message[]='product already exist in wishlist!';
        }elseif(mysqli_num_rows($cart_number)>0){
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
    $product_image=$_POST['product_image'];
    $product_quantity=$_POST['product_quantity'];
    
    $cart_number=mysqli_query($conn,"SELECT * FROM cart WHERE name='$product_name' AND user_id='$user_id'") or die
    ('querry failed');
    if(mysqli_num_rows($cart_number)>0){
        $message[]='product already exist in cart!';
}  else{
    mysqli_query($conn,"INSERT INTO cart (user_id,pid,name,price,quantity,image)VALUES('$user_id','$product_id'
    ,'$product_name'.'$product_price','$product_quantity','$product_image')");
     $message[]='product successfuly added in cart!';
}
}
    ?>
    <style type="text/css">
       
        </style>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@1&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link rel="stylesheet" type="text/css"  href="footer.css">
            <link rel="stylesheet" type="text/css"  href="style.css">
            <link rel="stylesheet" type="text/css"  href="product_page.css">
            <link rel="stylesheet" type="text/css"  href="view_page.css">
            
            
           
            <title> Flower Shop </title>
        </head> 
        <body>
         <?php include 'header.php' ;?>
         <div class="banner">
            <h1>Product Details </h1>
            <p> Flowers are the most powerful medium of different emotions. People are in loss of
                 words when they are extremely emotional. Besides this, words cannot portray your 
                 feelings or emotions with accuracy because the depth of these emotions can be felt
                  only by the people who are experiencing them. 
                Send flowers online in bloom vintage for the complete 
                portrayal of your love, possession, happiness, pride</p>
         </div>
         <?php
         if (isset($message)){
            foreach($message as $message){
                echo '
                <div class="message">
                <span> '.$message.'</span>
                <i class="" onclick="this.parentElement.remove()"> </i>
                </div>
                ';
            }
         }
      ?>  
    <div class="veiw_page">
        <?php
          if(isset($_GET['pid'])){
            $pid=$_GET['pid'];
            $select_products=mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'") or die 
            ('query failed');
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products=mysqli_fetch_assoc($select_products)){

                

            

               
         ?>
        
         <form method="post" action="" class="box">
         <img src="image/<?php echo $fetch_products['image'];?>">
        <div class="detail">  
        <div class="price">$<?php echo $fetch_products['price'];?>/- </div>
        <div class="name"><?php echo $fetch_products['name'];?> </div>
        <div class="detail"><?php echo $fetch_products['product_details'];?> </div>
        <input type="hidden" name="product_id"  value="<?php echo $fetch_products['id'];?>">
        <input type="hidden" name="product_name"  value="<?php echo $fetch_products['name'];?>">
        <input type="hidden" name="product_price"  value="<?php echo $fetch_products['price'];?>">
        <input type="hidden" name="product_image"  value="<?php echo $fetch_products['image'];?>">
       
        <div class="icons">
           <button type="submit" name="add-to-wishlist" class="fa fa-heart"></button>
            <input type="number"  name="product_quantity" class="quantity" value="1" min="0" >
            <button type="submit" name="add-to-cart" class="fas fa-shopping-cart"></button>
        </div>
                </div>
            </form>
        <?php 
          }
        }
    }
        ?>
        </div>
    
    
         <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
        </body>
    </html>