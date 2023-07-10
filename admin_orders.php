<?php
    include 'connection.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:login.php');
    }
    
    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

    /*----deleting order details from database---------*/
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
       
        mysqli_query($conn,"DELETE FROM orders WHERE id='$delete_id'") or die
        ('querry failed');

        header('location:admin_product.php');
    }

    /*-------------update order details----------*/
   
    if(isset($_POST['update_order'])){
        $order_id=$_POST['order_id'];
        $update_payment=$_POST['update_payment'];
        mysqli_query($conn,"UPDATE  orders SET payment_status='$update_payment' WHERE id='$order_id'") or die
        ('querry failed');
        $message[]='payment status updated succesfully!';
        
    }

?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" type="text/css"  href="style.css">
            <link rel="stylesheet" type="text/css"  href="product_page.css">
            <title> Admin Pannel </title>
        </head> 
        <body>
        <?php include 'admin_header.php';?>
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
        <section class="order_container">     
            <h1 class="title"> Total Place Orders </h1>
            <div class="box-container">
                <?php 
                 $select_orders=mysqli_query($conn,"SELECT *FROM orders") or die ('query failed');
                 if(mysqli_num_rows($select_orders)>0){
                    while ($fetch_orders=mysqli_fetch_assoc($select_orders)){
                ?>
                <div class="box" >
                    <p> User Name:<span><?php echo $fetch_orders['name'];?> </span> </p> 
                    <p> UserId:<span><?php echo $fetch_orders['user_id'];?> </span> </p>      
                    <p> Placed_on:<span><?php echo $fetch_orders['placed_on'];?> </span> </p>    
                    <p> Number:<span><?php echo $fetch_orders['number'];?> </span> </p>   
                    <p> Email:<span><?php echo $fetch_orders['email'];?> </span> </p>   
                    <p> Total price:<span><?php echo $fetch_orders['total_price'];?> </span> </p>
                    <p> Method:<span><?php echo $fetch_orders['method'];?> </span> </p>      
                    <p>Address:<span><?php echo $fetch_orders['address'];?> </span> </p>   
                    <p>Total products:<span><?php echo $fetch_orders['total_products'];?> </span> </p>  
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">
                        <select name="update_payment">
                            <option disable selected> <?php echo $fetch_orders['payment_status'];?></option>
                            <option value="pending"> Pending </option>
                            <option value="completed"> Completed </option>
                         </select>
                         <input type="submit" name="update_order" value="update_order" class="btn">
                         <a href ="admin_orders.php? delete=<?php echo $fetch_orders['id'];?>" class="delete" onclick= "return
                          confirm('delete this')">Delete</a>
                    </form>
                </div> 
                <?php
                    }
                 }
                  ?>
            </div>
        </section>          
        <script type="text/javascript"  src="script.js" > </script>
        
        </body>
    </html>