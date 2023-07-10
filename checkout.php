<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }
    /*---------order placed----------*/
   if (isset($_POST['order_btn'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $number=mysqli_real_escape_string($conn,$_POST['number']);
    $method=mysqli_real_escape_string($conn,$_POST['method']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $placed_on=date('d-M-Y');
    $cart_total=0;
    $cart_products[]='';
    $cart_query=mysqli_query($conn,"SELECT * FROM cart WHERE user_id='$user_id'")or die('query failed');

    if (mysqli_num_rows($cart_query)>0){
        while($cart_item=mysqli_fetch_assoc($cart_query)){
            $cart_products[]=$cart_item['name'].'('.$cart_item['quantity'].')';
            $sub_total=($cart_item['price'] * $cart_item['quantity']);
            $cart_total+=$sub_total;
        }
    }
  $total_products=implode(',',$cart_products);
  mysqli_query($conn,"INSERT INTO orders(user_id,name,number,email,method,address,total_products,total_price
  ,placed_on)VALUES ('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')");
  mysqli_query($conn,"DELETE FROM cart WHERE user_id='$user_id'");
  $message[]='order laced succesfully';
  header('location:checkout.php');
    
    


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
            <h1> Checkout Page</h1>
            <p> Flowers are the most powerful medium of different emotions. People are in loss of
                 words when they are extremely emotional. Besides this, words cannot portray your 
                 feelings or emotions with accuracy because the depth of these emotions can be felt
                  only by the people who are experiencing them. 
                Send flowers online in bloom vintage for the complete 
                portrayal of your love, possession, happiness, pride</p>
</div>
<div class="checkout-form">
    <h1 class="title" >Payment Process </h1>
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
    <div class="display-order">
        <?php
        $select_cart=mysqli_query($conn,"SELECT * FROM cart WHERE  user_id='$user_id'") ;
        $total=0;
        $grand_total=0;
        if (mysqli_num_rows($select_cart)>0){
             while ($fetch_cart=mysqli_fetch_assoc($select_cart)){
            $total_price= ($fetch_cart['price']* $fetch_cart['quantity']);
                $grand_total=$total += $total_price;
                ?>
                <span> <?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)
                <?php
             }
        };
        ?>
        <span class="grand-total"> Total Amount Payble: $<?=$grand_total; ?>/-</span>
    </div>
    <form method="post">
        <div class="input-field">
            <label>your name </label>
            <input type="text" name="name">
         </div>    
         <div class="input-field">
            <label>your number </label>
            <input type="text" name="number">
         </div>    
         <div class="input-field">
            <label>your email</label>
            <input type="text" name="email">
         </div>    
         <div class="input-field">
            <label>address</label>
            <input type="text" name="address">
         </div>  
         <div class="input-field">
            <label>payment method </label>
           <select name="method">
            <option class="cash on delivry"> cash on </option>
    </select>
   
         </div>  
         <input type="submit" name="order_btn" class="btn"  value="order now">
    </form>
    </div>
    

         <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
        </body>
    </html>