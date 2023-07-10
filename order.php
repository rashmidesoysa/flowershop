<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
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
      <link rel="stylesheet" type="text/css"  href="product_page.css">
      <title> Flower Shop </title>
    </head> 
<body>
<?php include 'header.php' ;?>
 <div class="banner">
    <h1> Orders</h1>
    <p> Flowers are the most powerful medium of different emotions. People are in loss of
        words when they are extremely emotional. Besides this, words cannot portray your 
        feelings or emotions with accuracy because the depth of these emotions can be felt
        only by the people who are experiencing them. Send flowers online in bloom vintage for the complete 
        portrayal of your love, possession, happiness, pride
    </p>
 </div>
    <div class="order-section">
    <div class="box-container">
    <?php
        $select_orders=mysqli_query($conn,"SELECT * FROM orders WHERE user_id='$user_id'") or 
        die('query failed');
        if(mysqli_num_rows($select_orders )>0){
        while($fetch_orders=mysqli_fetch_assoc($select_orders)){
    ?>
        <div class="box">
            
            <p>Name: <span> <?php echo $fetch_orders ['name'];?> </span></div>
            <p>Number: <span> <?php echo $fetch_orders ['number'];?> </span></div>
            <p>Email: <span> <?php echo $fetch_orders ['email'];?> </span></div>
            <p>Payment Method: <span> <?php echo $fetch_orders ['method'];?> </span></div>
            <p>Address: <span> <?php echo $fetch_orders ['address'];?> </span></div>
            <p>Your Order: <span> <?php echo $fetch_orders ['total_products'];?> </span></div>
            <p>Total Price: <span> <?php echo $fetch_orders ['total_price'];?> </span></div>
            <p>Placed On: <span> <?php echo $fetch_orders ['placed_on'];?> </span></div>
            <p>Payment Status: <span> <?php echo $fetch_orders ['payment_status'];?> </span></div>
        </div>
   <?php
   }
   }else{
         echo '
            <div class="empty">
            <img src="img\">
            <p > no order place yet! </p>
            </div>
            ';
        }
     ?>
</div>
</div>
<?php include 'footer.php' ;?>
<script type="text/javascript" src="script.js"> </script>
</body>
</html>