<?php 
   require_once 'admin/functions/connect.php';
   $sql = $pdo -> prepare("SELECT * FROM `base`");
   $sql -> execute();
   $blocker = $sql->fetchAll(PDO::FETCH_OBJ);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>ELENALOVEEPTA - WISHLIST#1</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width initial-scale=1 user-scalable=no">
      <meta name="description" content="<?php echo $blocker[0]->about?>">
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:image" content="img/photo_2023-08-11_23-13-15.jpg" />
      <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
      <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
      <link rel="manifest" href="favicon/site.webmanifest">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/media.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="js/main.js" defer></script>
   </head>
   <body class="hidden">
      <div class="preloader">
         <!-- <span></span> -->
      </div>
      <main>
         <header>
            <h1>ELENALOVEEPTA</h1>
         </header>
         <img class="portrait" src="img/<?php echo $blocker[0]->mainimg?>" alt="elenaloveepta">
         <div class="about">
            <h1>ABOUT</h1>
            <p><?php echo $blocker[0]->about?></p>
            <div class="social">
               <a href="#wish" class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M13 17.586V4h-2v13.586l-6.293-6.293-1.414 1.414L12 21.414l8.707-8.707-1.414-1.414L13 17.586z"/></svg></a>
               <div class="social-group" id="wish">
                  <a href="<?php echo $blocker[0]->telegram?>" target="_blank" rel="noopener noreferrer">
                     <!-- <img src="img/telegram.svg" alt="telegram"> -->
                     TELEGRAM
                  </a>
                  <a href="<?php echo $blocker[0]->instagram?>" target="_blank" rel="noopener noreferrer">
                     <!-- <img src="img/instagram.svg" alt="instagram"> -->
                     INSTAGRAM
                  </a>
               </div>
            </div>
         </div>
      </main>
      <ul class="main-content">
         <h2 class="wish">WISHLIST#1</h2>
         <?php 
            $sqo = $pdo -> prepare("SELECT * FROM `base`,`allitems`");
            $sqo -> execute();
            $blockun = $sqo->fetchAll(PDO::FETCH_OBJ);
            foreach($blockun as $blocks):?>
         <div class="all-item">
            <li class="item <?php echo $blocks->reserved ? 'reserved' : ''; ?>" style="background-image: url(img/<?php echo $blocks->img?>);" tabindex="<?php echo $blocks->id?>">
               <a data-modal="<?php echo $blocks->id?>" class="js-open-modal">
               <span><?php echo $blocks->title?></span>
               </a>
            </li>
            <div class="modal" data-modal="<?php echo $blocks->id?>">
               <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <path d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"></path>
               </svg>
               <div class="modal-body">
                  <div class="modal-items">
                     <span><?php echo $blocks->description?></span>
                     <div class="copy">
                        <input type="text" class="intut" id="<?php echo $blocks->id?>" value="<?php echo $blocks->card?>" readonly>
                        <a onclick="copyTo(this)" class="copy-button"><span class="tooltiptext" id="myTooltip">Спасибо, дорогуша!</span>Скопировать номер карты❤️</a>
                     </div>
                     <a target="_blank" href="<?php echo $blocks->link?>" class="manually-button">Ссылка на товар
                     </a>
                     <br>
                     <p class="all-reserve">Ты можешь забронировать подарок: <button class="reserve-button manually-button" name="reserve" data-product-id="<?php echo $blocks->id ?>" type="button">тык</button></p>
                     <span class="reservation-message">Подарок успешно забронирован!</span>
                  </div>
               </div>
            </div>
         </div>
         <?php endforeach?>
      </ul>
      <div class="overlay js-overlay-modal"></div>
         <script>
            $(document).ready(function() {
               $(".reserve-button").click(function() {
                  var button = $(this);
                  var productId = button.data('product-id');
                  var itemElement = button.closest(".item");
                  var allItemElement = button.closest(".all-item");
                  var allReserveBlock = allItemElement.find(".all-reserve");
                  var reservationMessage = allItemElement.find(".reservation-message");

                  $.post('update_reserved.php', { reserve: productId }, function(data) {
                     if (data.success === true) {
                        itemElement.addClass("reserved");
                        allReserveBlock.fadeOut();
                        reservationMessage.fadeIn();
                     }
                  }, 'json');
               });
            });
         </script>
         <script>
            window.onscroll = function() {
            hideArrow();
            }
            function hideArrow() {
            const arrow = document.querySelector('.arrow')
            arrow.classList.add('visability');
            }
         </script>
   </body>
</html>