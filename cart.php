<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }

    
   
    
/*-----update product to cart-------*/
    if(isset($_POST['update_quantity_btn'])){
        $update_quantity_id=$_POST['update_quantity_id'];
        $update_value=$_POST['update_quantity'];

        $update_query=mysqli_query($conn,"UPDATE  cart SET quantity='$update_value' WHERE id='$update_quantity_id'") or die
        ('querry failed');
        if($update_query){
            header('location:cart.php');
        }
    }


 /*---delete product to wishlist-------*/
 if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
   
    mysqli_query($conn,"DELETE FROM cart WHERE id='$delete_id'") or die
    ('querry failed');

    header('location:cart.php');
}
/*---delete product to wishlist-------*/
if(isset($_GET['delete_all'])){
    
    mysqli_query($conn,"DELETE FROM cart WHERE user_id='$user_id'") or die
    ('querry failed');

    header('location:cart.php');
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
          
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link rel="stylesheet" type="text/css"  href="footer.css">
            <link rel="stylesheet" type="text/css"  href="style.css">
            <link rel="stylesheet" type="text/css"  href="product_page.css">
           
            <title> Flower Shop </title>
        </head> 
        <body>
         <?php include 'header.php' ;?>
         <div class="banner">
            <h1> My Cart </h1>
            <p> Flowers are the most powerful medium of different emotions. People are in loss of
                 words when they are extremely emotional. Besides this, words cannot portray your 
                 feelings or emotions with accuracy because the depth of these emotions can be felt
                  only by the people who are experiencing them. 
                Send flowers online in bloom vintage for the complete 
                portrayal of your love, possession, happiness, pride</p>
         </div>
        <div class="shop">
            <h1 class="title">Product Added In Cart </h1>
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
           $select_cart=mysqli_query($conn,"SELECT * FROM cart WHERE user_id='$user_id'")or
            die('query failed');
           if(mysqli_num_rows($select_cart)>0){
            while ($fetch_cart=mysqli_fetch_assoc($select_cart)){
               
         ?>
         <div class="box">
            <div class="icons">
                <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" class="fas fa-eye" ></a>
                <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="fas fa-eye"></a>
            

        <img src="image/<?php echo $fetch_cart['image'];?>">
        <div class="price"><?php echo $fetch_cart['price'];?>/- </div>
        <div class="name"><?php echo $fetch_cart['name'];?> </div>
        <form method="post" >
        <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id'];?>">
        <div class="qty">
            <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']?>">
            <input type="submit" name="update_container_btn" value="update">
        </div>    
        </form>
        <div class="total_amt">
            Total Amount:<span><?php echo $total_amt=($fetch_cart['price']=$fetch_cart['quantity']);?></span>
        </div>    
        </div>

        <?php 
           $grand_total+=$total_amt;
           }
        }else{
            echo '<div class="empty">
            <img src="img/ccc.png">
            <p> no products in your cart yet</p>
            </div>
            ';
        }
        ?>
        </div>
        <div class="dlt">
            <a href="cart.php?delete_all" class="btn2 <?php echo ($grand_total > 1)?'':'disabled'?>" onclick="return
        confirm('do you want to delete all from cart')">delete all</a>
         </div>
        <div class= "wishlist_total">
        <P> total amount payable:<span>$<?php echo $grand_total?>/-</span></a>
        <a href="shop.php">continue shopping </a>
        <a href="checkout.php" class="btn2 <?php echo ($grand_total > 1)?'':'disabled'?>">proceed to check out</a>
    </div>
         <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
        </body>
    </html>