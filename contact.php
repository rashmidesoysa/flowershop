<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }
    /*---------send message----------*/
    if(isset($_POST['submit-btn'])){
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $number=mysqli_real_escape_string($conn,$_POST['number']);
        $message=mysqli_real_escape_string($conn,$_POST['message']);

        $select_message=mysqli_query($conn,"SELECT * FROM message WHERE name='$name' AND email='$email' AND
        number='$number' AND message='$message'") or die('querry failed');
       
        if (mysqli_num_rows($select_message)>0){
        echo 'messaage already send!';
        
    }  else{
        mysqli_query($conn,"INSERT INTO message (user_id,name,email,number,message)VALUES('$user_id','$name'
        ,'$email','$number','$message')") or die('query failed');
        
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
         <div class="banner">
            <h1> my contact</h1>
            <p> What can we help you with?</p>
         </div>
        <div class="help">
            <h1 class="title" > need help </h1>
            <div class="box-container">
                <div class="box">
                    <div>
                        <img src="img/adress.png">
                        <h2> address</h2>
                    </div>    
                <p>holl street,colombo 03</p>
            </div>
            <div class="box">
                    <div>
                        <img src="img/open.png">
                        <h2> opening</h2>
                    </div>    
                <p>We are here for you 24 hours a day</p>
            </div>
            <div class="box">
                    <div>
                        <img src="img/cntc.png">
                        <h2> our contacts</h2>
                    </div>    
                <p>+940745685621/01125684568</p>
            </div>
            <div class="box">
                    <div>
                        <img src="img/offer.png">
                        <h2> special offer</h2>
                    </div>    
                <p>lorem dolor sit asmet consector adipising wer</p>
            </div>
</div>
</div>
<div class="form-container">
    <div class="form-section">
        <form method="post">
            <h1> send us your question?</h1>
            <p> we will get back to you within two days</p>
            <div class="input-field">
                <label> your name </label>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label> your email </label>
                <input type="text" name="email">
            </div>
            
            <div class="input-field">
                <label> your number </label>
                <input type="number" name="number">
            </div>
            
            <div class="input-field">
                <label> message </label>
                <textarea name="message"> </textarea>
            </div>
            <input type="submit" name="submit-btn" class="btn" value="send message">
        </form>
</div>
</div>
         <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
        </body>
    </html>