<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }

    /*-----adding product to wishlist-------*/
   
    
/*-----adding product to cart-------*/

if(isset($_POST['add_to_cart'])){
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $product_quantity=1;
    
    $cart_number=mysqli_query($conn,"SELECT * FROM cart WHERE name='$product_name' AND user_id='$user_id'") or die
    ('querry failed');
    if(mysqli_num_rows($cart_number)>0){
        $message[]='product already exist in cart!';
}  else{
    mysqli_query($conn,"INSERT INTO cart (user_id,pid,name,price,image,quantyty)VALUES('$user_id','$product_id'
    ,'$product_name','$product_price','$product_image','$product_quantity')");
     $message[]='product successfuly added in cart!';
}
}
 
/*---delete product to wishlist-------*/
if(isset($_GET['delete_all'])){
    
    mysqli_query($conn,"DELETE FROM wishlist WHERE user_id='$user_id'") or die
    ('querry failed');

    header('location:wishlist.php');
}
if (isset($_GET['delete_all'])) {
    // Assuming you have already established a database connection and authenticated the user.

    $user_id = mysqli_real_escape_string($conn, $user_id); // Sanitize user_id

    $query = "DELETE FROM wishlist WHERE user_id='$user_id'";

    if (mysqli_query($conn, $query)) {
        // Delete successful
        header('location: wishlist.php');
    } else {
        // Handle the error gracefully
        echo "Error: " . mysqli_error($conn);
    }
}

     ?>
    <style type="text/css">
        <?php include "footer.css";?>
    </style>
<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link rel="stylesheet" type="text/css"  href="style.css">
            <link rel="stylesheet" type="text/css"  href="product_page.css">
            <link rel="stylesheet" type="text/css"  href="wishlist.css">
            <title> Flower Shop </title>
       </head> 
<body>
         <?php include 'header.php' ;?>
         <div class="banner">
            <h1> My Wishlist </h1>
            <p> Flowers are the most powerful medium of different emotions. People are in loss of
                 words when they are extremely emotional. Besides this, words cannot portray your 
                 feelings or emotions with accuracy because the depth of these emotions can be felt
                  only by the people who are experiencing them. 
                Send flowers online in bloom vintage for the complete 
                portrayal of your love, possession, happiness, pride</p>
         </div>
<div class="shop">
   <h1 class="title">Product Added In Wishlist </h1>
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
            $grand_total=0;
            $select_wishlist=mysqli_query($conn,"SELECT * FROM wishlist WHERE user_id='$user_id'")or
            die('query failed');
            if(mysqli_num_rows($select_wishlist)>0){
            while ($fetch_wishlist=mysqli_fetch_assoc($select_wishlist)){
        ?>
       

         <div class="box">
        <form method="post" action="" class="box">
       
            <div class="icons">
                <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id'];?>" class="fas fa-eye" ></a>
                <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="fas fa-eye"></a>
            </div>

           <img src="image/<?php echo $fetch_wishlist['image'];?>">
           <div class="price"><?php echo $fetch_wishlist['price'];?>/- </div>
           <div class="name"><?php echo $fetch_wishlist['name'];?> </div>
           <input type="hidden" name="product_id"  value="<?php echo $fetch_wishlist['id'];?>">
           <input type="hidden" name="product_name"  value="<?php echo $fetch_wishlist['name'];?>">
           <input type="hidden" name="product_price"  value="<?php echo $fetch_wishlist['price'];?>">
           <input type="hidden" name="product_image"  value="<?php echo $fetch_wishlist['image'];?>">
           <button type="submit" name="add-to-cart" class="btn2">add to cart<i class="fas fa-shopping-cart"> </i></button>
        </form>
        <?php 
           $grand_total+=$fetch_wishlist['price'];
            }
        }else{
            echo '<img src="img/empty-cart.png">';
        }
        ?>
    </div>
    <div class= "wishlist_total">
        <P> Total Amount Payable:<span>$<?php echo $grand_total?>/-</span></a> </p>
        <a href="shop.php">Continue Shopping </a>
        <a href="wishlist.php?delete_all" class="btn2<?php echo ($grand_total > 1)?'':'disabled'?>" 
        onclick="return confirm('do you want to delete all from wishlist')">Delete All</a>
    </div>
 </div>
         <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
</body>
</html>