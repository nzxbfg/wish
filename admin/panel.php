<?php 
   session_start();
   if(!empty($_SESSION["login"])) :
   else: header('Location: functions/login.php');
   endif;
   
   require_once 'functions/connect.php';
   $new = $pdo -> prepare("SELECT * FROM `base`");
   $new -> execute();
   $blocking = $new->fetchAll(PDO::FETCH_OBJ);
   ?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ADMIN - <?php echo $_SESSION["login"];?></title>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/media.css">
      <script src="../js/main.js" defer></script>
   </head>
   <body class="hidden">
      <div class="preloader">
         <!-- <span></span> -->
      </div>
      <header>
         <a href="../" class="admin"><h1><?php echo $_SESSION["login"];?></h1></a>
         <a href="functions/logout.php" class="logout">Logout</a>
      </header>
      <div class="main-content main-panel">
         <h2 class="kish">Base Info</h2>
         <form class="panel-form" action="functions/base.php" method="POST" enctype="multipart/form-data">
            <section>
               <div>
                  <label for="card">Card:</label>
                  <input type="text" name="card" id="card" value="<?php echo $blocking[0]->card?>">
               </div>
               <div>
                  <label for="about">About:</label>
                  <input type="text" name="about" id="about" value="<?php echo $blocking[0]->about?>">
               </div>
               <div>
                  <label for="telegram">Telegram:</label>
                  <input type="text" name="telegram" id="telegram" value="<?php echo $blocking[0]->telegram?>">
               </div>
               <div>
                  <label for="instagram">Instagram:</label>
                  <input type="text" name="instagram" id="instagram" value="<?php echo $blocking[0]->instagram?>">
               </div>
               <div>
                  <label for="mainimg">MainIMG:</label>
                  <input type="file" name="mainimg" id="mainimg" value="<?php echo $blocking[0]->mainimg?>">
               </div>
            </section>
            <img src="../img/<?php echo $blocking[0]->mainimg?>" alt="">
            <button type="submit" class="save" name="save" style="border:none;font-size:20px;padding:0">Save</button>   
         </form>
      </div>
      <?php 
         $all = $pdo -> prepare("SELECT * FROM `allitems`");
         $all -> execute();
         while($res = $all->fetch(PDO::FETCH_OBJ)):?>
      <div class="main-content">
         <h2 class="kish">Item<span style="color: var(--fiol-color)">#<?php echo $res->id?></span></h2>
         <form class="panel-form" action="functions/allitems.php/<?php echo $res->id?>" method="POST" enctype="multipart/form-data">
            <section>
               <div>
                  <label for="card">Title:</label>
                  <input type="text" name="title" id="title" value="<?php echo $res->title?>">
               </div>
               <div>
                  <label for="mainimg">Link:</label>
                  <input type="text" name="link" id="link" value="<?php echo $res->link?>">
               </div>
               <div>
                  <label for="instagram">Description:</label>
                  <input type="text" name="description" id="description" value="<?php echo $res->description?>">
               </div>
               <div>
                  <label for="about">IMG:</label>
                  <input type="file" name="img" id="img" value="<?php echo $res->img?>">
               </div>
            </section>
            <img src="../img/<?php echo $res->img?>" alt="">
            <button type="submit" class="save" name="save" style="border:none;font-size:20px;padding:0">Save</button> 
         </form>
         <form class="delete-form" action='functions/delete.php' method='POST' style="padding: 0;">
            <button type="submit" name="id" class="manually-button" value="<?php echo $res->id?>">Delete</button> 
         </form>
      </div>
      <?php endwhile?>
      <button class="manually-button js-open-modal" data-modal="1">ADD NEW WISH</button>
      <div class="modal" data-modal="1">
         <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
            <path d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"></path>
         </svg>
         <div class="modal-body">
            <div class="modal-items">
               <form class="panel-form" action="functions/addnew.php" method="POST" enctype="multipart/form-data">
                  <section>
                     <div>
                        <label for="card">Title:</label>
                        <input type="text" name="titlenew" id="titlenew">
                     </div>
                     <div>
                        <label for="mainimg">Link:</label>
                        <input type="text" name="linknew" id="linknew">
                     </div>
                     <div>
                        <label for="instagram">Description:</label>
                        <input type="text" name="descriptionnew" id="descriptionnew">
                     </div>
                     <div>
                        <label for="about">IMG:</label>
                        <input type="file" name="imgnew" id="imgnew">
                     </div>
                  </section>
                  <button type="submit" class="manually-button" name="add">Add</button> 
               </form>
            </div>
         </div>
      </div>
      <div class="overlay js-overlay-modal"></div>
   </body>
</html>