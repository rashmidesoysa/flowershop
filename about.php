
<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }


    ?>
    <style type="text/css">
       <?php  include "about.css";?>
        </style>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <link rel="stylesheet" type="text/css"  href="style.css">
            <link rel="stylesheet" type="text/css"  href="footer.css">
            
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
         <title> Flower Shop </title>
        </head> 
        <body>
         <?php include 'header.php' ;?>
         <div class="banner">
            <h1>About Us </h1>
            <p> Flowers are the most powerful medium of different emotions. People are in loss of
                 words when they are extremely emotional. Besides this, words cannot portray your 
                 feelings or emotions with accuracy because the depth of these emotions can be felt
                  only by the people who are experiencing them. 
                Send flowers online in bloom vintage for the complete 
                portrayal of your love, possession, happiness, pride </p>
         </div>
         <div class="about">
            <div class="row">
                <div class="detail">
                    <h1>Visit Our Beautiful Showroom</h1>
                    <p>With a rich heritage of over 20 years, Bloom Vintage offers premium greenhouse-grown flowers to harness the diverse floral requirements of our clients.</p>
                    <a href="shop.php" class="btn2">shop now </a>
                </div>

          <div class="img-box">
          <img src="img/buntile.jpg">
         </div>
</div>
</div>
<div class="banner-2">
    <h1> Let us make your wishes fulfil with blooming</h1>
    <a href=shop.php class="btn2">Shop Now </a>
</div>
<div class="services">
    <h1 class="title" > Our Services </h1>
    <div class="box-container">
        <div class="box">
            <i class="fa fa-credit-card"> </i>
            <h3> Payment Options </h3>
            <p>  Cash on Delivery  available</p>
        </div>
        <div class="box">
            <i class="fas fa-shield-alt"> </i>
            <h3>  Secured Payments </h3>
            <p>Payments are secured  </p>
        </div>
        <div class="box">
            <i class="	fas fa-bullhorn"> </i>
            <h3> Super Flexible </h3>
            <p>Customize receipient,date,or flowers,skip or cancel anytime </p>
        </div>
</div>
</div>
<!--<div class="stylist">
    <h1 class="title"> Florial Stylist </title>
    <p>Meet the team that makes miracle happen </p>
    <div class="box-container">
        <div class="box">
            <div class="img-box">
                <img src="img/">
                <div class="social-links">
                <i class="fa fa-instagram"></i>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-whatsapp"></i> 
            </div>
        </div>    
        <h3> LIYA DE SILVA </h3>
        <p>Florist</p>
        <div class="box">
            <div class="img-box">
                <img src="img/">
                <div class="social-links">
                <i class="fa fa-instagram"></i>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-whatsapp"></i> 
            </div>
        </div>    
        <h3> TANI FONSEKA </h3>
        <p> Designer</p>
        <div class="box">
            <div class="img-box">
                <img src="img/">
                <div class="social-links">
                <i class="fa fa-instagram"></i>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-whatsapp"></i> 
            </div>
        </div>   
        <h3> NIUNI FERNANDO </h3>
        <p> Coordinator</p>
</div>   
</div>-->
<div class="testimonial-container">
        <h1 class="title"> what people say </h1>
        <div class="container">
            <div class="testimonial-item active">
                
                <img src="img/user.png">
                <h3> Sadamini Fenando</h3>
                <p>Easy to order beautiful flowers! Very reliable</p>
            </div>
            <div class="testimonial-item">
                <img src="img/user.png">
                <h3>leesha fenando</h3>
                <p>We can customizw easialy</p>
            </div>
            <div class="testimonial-item">
                <img src="img/user.png">
                <h3> Nilni Fenando</h3>
                <p>Easy to order beautiful flowers! Very reliable</p>
            </div>
<div class="left-arrow" onclick="nextSlide();"> <i class="glyphicon glyphicon-backward"></i></div>
<div class="right-arrow"  onclick="prevSlide();"> <i class="glyphicon glyphicon-forward"></i></div>
</div>
</div>


        <?php include 'footer.php' ;?>
         <script type="text/javascript" src="script.js"> </script>
        </body>
    </html>