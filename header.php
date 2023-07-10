<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css"  href="product_page.css">
            <link rel="stylesheet" type="text/css"  href="footer.css">
            <link rel="stylesheet" type="text/css"  href="style.css">
            
            <title> Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href ="admin.php"  class="logo"> BLOOM <span> VINTAGE</span></a>
            <nav class="navbar">
                <a href ="index.php" >Home </a>
                <a href ="shop.php" >Shop </a>
                <a href ="order.php" >Orders </a>
                <a href ="about.php" >About Us</a>
                <a href ="contact.php" >Contact </a>
</nav>
          <div class="icons">
           
            <?php
            $select_wishlist=mysqli_query($conn,"SELECT *FROM wishlist WHERE user_id='$user_id' ")or
            die('query failed');
            $wishlist_num_rows=mysqli_num_rows($select_wishlist);
            ?>
           <a href="wishlist.php"><i class="fa fa-heart"></i><span>(<?php echo $wishlist_num_rows;?>)</span></a>
            
            <?php
            $select_cart=mysqli_query($conn,"SELECT *FROM cart WHERE user_id='$user_id' ")or
            die('query failed');
            $cart_num_rows=mysqli_num_rows($select_cart);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows;?>)</span></a>
            
            <i class="fa fa-bars" > </i>
            <i class="fa fa-user" > </i>
</div>          
        <div class="user-box">
            <p> UserName: <span><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?></span></p>
           <p> Email: <span><?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></span></p>
          <form method="post" class="logout">
            <button type="submit" name="logout" class="logout-btn">LOG OUT</button>
          </form>
        </div>
</div>


</header>
</body>
</html>