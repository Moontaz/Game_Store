<div class="container-fluid index-body ">
   <div class="container-fluid p-0 d-flex flex-column" style="max-width:940px;">
      <div class="ms-auto">
         <a class=" btn btn-primary rounded-0 py-0 px-5 fs-7 ms-auto mt-2 " href="<?= BASEURL ?>?url=home/wishlist">Wishlist
         </a>
         <?php
         if (!empty($_SESSION['cart'])) {
         ?>
            <a class=" btn btn-warning text-light rounded-0 py-0 px-4 fs-7 ms-auto mt-2 " href="<?= BASEURL ?>?url=home/wishlist">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
               </svg>
               Cart
            </a>
         <?php
         }
         ?>
      </div>
      <div class="text-light rounded-0 py-0 fs-3 me-auto ms-0 mt-2" style="font-weight: 800;font-family: 'Poppins', sans-serif;">My Game
      </div>

      <div class="container mt-4 mx-auto px-0 d-flex flex-column flex-sm-row" style="max-width:940px;">
         <section class="container-fluid mx-0 row row-cols-1 row-cols-sm-2 gap-2 gap-sm-4 game-section p-0 mb-4 text-light" style="max-width:940px;">
            <?php
            // var_dump($data['myGames']);
            if (isset($data['myGames'])) {
               $games = $data['myGames'];

               // var_dump($games);
               foreach ($games as $mygame) :
                  // var_dump($mygame);
                  // echo ' SPASI ';
                  $review_label = 'No Reviews';
                  $user_count = 0;
                  // var_dump($data['reviews']);
                  if (isset($data['reviews'])) {
                     foreach ($data['reviews'] as $review_data) :
                        if ($review_data['game_id'] == $mygame['id']) {
                           $review_label = $review_data['rating_label'];
                           $user_count = $review_data['user_count'];
                        }
                     endforeach;
                  }
            ?>
                  <div class="container col game-container mx-auto mx-sm-0 p-0 d-flex flex-column rounded-sm shadow-sm">
                     <a class="game-logo" href="<?= BASEURL ?>?url=home/game/<?= $mygame['id'] ?>/<?= $review_label; ?>/<?= $user_count; ?>">
                        <img src="<?= BASEURL ?>/img/game-logo2.jpg" width="225">
                     </a>
                     <div class="game-detail mx-3 my-3 d-flex flex-column justify-content-between">
                        <a class=" game-title lh-1 fs-4 text-black" style=" font-weight:500;" href="<?= BASEURL ?>?url=home/game/<?= $mygame['id'] ?>/<?= $review_label; ?>/<?= $user_count; ?>">
                           <?= $mygame['title']; ?>
                        </a>
                        <div class=" d-flex flex-column justify-content-between rounded-sm">

                           <div class="mt-4 text-end">
                              <a class="btn btn-primary rounded-sm" href="<?= BASEURL ?>?url=game/downloadFile/<?= $mygame['id'] ?>">Download</a>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
                  $review['user_count'] = 0;
                  $review['rating_label'] = 0;
               endforeach;
            } else {
               ?>
               <div class="fs-3 pt-5 pt-sm-3 mt-5 mt-sm-3 pb-5 mb-5 pb-sm-4 mb-sm-4 mx-auto">
                  <div class="fs-3 py-5 my-5 text-light">OOPS, THERE'S NOTHING TO SHOW HERE</div>
                  <div class="fs-3 py-5 my-5 d-block d-sm-none"></div>
               </div>
            <?php
            }
            ?>
         </section>
      </div>
   </div>
</div>

<style>
   .rounded-sm {
      border-radius: 2px;
   }

   .rounded-sm-start {
      border-radius: 2px 0 0 2px;
   }

   a {
      text-decoration: none;
   }

   .index-body {
      position: relative;
      display: flex;
      overflow: hidden;
   }

   .index-body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('<?= BASEURL ?>/img/bg-signup.jpg') no-repeat center center;
      background-size: cover;
      opacity: 0.8;
      z-index: -1;
   }

   .fs-7 {
      font-size: 0.8rem;
   }

   .game-detail .fs-8 {
      font-size: 0.65rem;
      color: rgba(0, 0, 0, 0.5);
   }

   .fs-7-responsive {
      font-size: 0.8rem;
   }

   .game-section .game-container {
      position: relative;
      background: linear-gradient(to left, grey -200%, rgba(255, 255, 255, 1) 100%);
      text-decoration: none;
   }

   .game-detail span,
   .game-detail p {
      color: black;
   }

   .game-detail .game-title {
      opacity: 0.6;
   }

   .tab-preview {
      background: linear-gradient(to right, <?= PRIMARY_COLOR ?> 0%, rgba(16, 31, 40, 1) 200%);
   }

   .preview-reviews {
      background-color: rgba(255, 255, 255, 0.3);
   }

   .screenshot {
      width: 95%;
      height: 95%;
   }

   .payment-container {
      background: linear-gradient(to right, grey -200%, rgba(255, 255, 255, 1) 100%);
   }

   .game-container img {
      height: 100%;
      width: 100%;
   }

   @media (max-width: 576px) {
      .fs-6-responsive {
         font-size: 0.65rem;
      }

      .fs-7-responsive {
         font-size: 0.55rem;
      }

      .game-container {
         width: 100%;
      }

      .game-container div {
         /* height: 50px; */
         width: 380px;
      }

      .game-container img {
         height: 100%;
         width: 100%;
      }

   }

   @media (min-width: 576px) {

      .game-container {
         width: 450px;
      }
   }
</style>
<script>
   function toggle(element) {
      event.preventDefault();
      var url = element.href;

      fetch(url)
         .then(response => response.text())
         .then(data => {
            location.reload();
         })
         .catch(error => {
            console.error('Error:', error);
         });
   }
</script>