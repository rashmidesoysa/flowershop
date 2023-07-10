<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css"  href="product_page.css">
            <link rel="stylesheet" type="text/css"  href="style.css">
            <title> Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href ="admin.php"  class="logo"> Admin <span> pannel </span></a>
            <nav class="navbar">
                <a href ="admin.php" >Home </a>
                <a href ="admin_product.php" >Products </a>
                <a href ="admin_orders.php" >Orders </a>
                <a href ="admin_users.php" >Users </a>
                <a href ="admin_message.php" >Message </a>
            </nav>
            <div class="icons">
            <i class="fa fa-bars" > </i>
            <i class="fa fa-user" > </i>
                
            </div>        
            <div class="user-box">
              <p> UserName:<span ><?php echo $_SESSION['admin_name'];?> </span></p>
              <p> Email:<span ><?php echo $_SESSION['admin_email'];?> </span></p>
              <form method= "post" class="logout">
                <button name="logout" class="logout-btn">LOG OUT </button>
              </form>
            </div>
</div>
    </header>
</body>
</html>