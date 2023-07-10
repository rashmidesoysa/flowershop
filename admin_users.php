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
       
        mysqli_query($conn,"DELETE FROM users WHERE id='$delete_id'") or die
        ('querry failed');

        header('location:admin_users.php');
    }

    

?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="style.css ">
            <link rel="stylesheet" href="product_page.css ">

            <title> Admin User Page</title>
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
    <section class ="user_container">
        <h1 class="title">Total Registered  Users</h1> 
        <div class="box-container">
        <?php 
                 $select_users=mysqli_query($conn,"SELECT *FROM users") or die ('query failed');
                 if(mysqli_num_rows($select_users)>0){
                    while ($fetch_users=mysqli_fetch_assoc($select_users)){
                ?>
                <div class="box">
                    <p> User Id:<span><?php echo $fetch_users['id'];?><span> </p>
                    <p> User Name:<span><?php echo $fetch_users['name'];?><span> </p>
                    <p> Email:<span><?php echo $fetch_users['email'];?><span> </p>
                    <p> User Type:<span style="color:<?php if ($fetch_users['user_type']=='admin'){echo 'orange';};?>">
                    <?php echo $fetch_users['user_type'];?><span> </p>
                    <a href ="admin_users.php? delete=<?php echo $fetch_users['id'];?>" class="delete" onclick= "return
                          confirm('delete this')">Delete</a>
                </div >   
                <?php
                    }
                 }
                  ?>
    </div>
    </section>
    <script type="text/javascript" src="script.js"> </script>
</body>
</html>