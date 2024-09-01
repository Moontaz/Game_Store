<div class="container-fluid index-body ">
   <div class="container-fluid p-0 d-flex flex-column" style="max-width:940px;">
      <div class="ms-auto">
         <a class=" btn btn-primary rounded-0 py-0 px-5 fs-7 ms-auto mt-2 "
            href="<?= BASEURL ?>?url=home/wishlist">Wishlist
         </a>
         <?php
         if (!empty($_SESSION['cart'])) {
         ?>
         <a class=" btn btn-warning text-light rounded-0 py-0 px-4 fs-7 ms-auto mt-2 "
            href="<?= BASEURL ?>?url=home/cart">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill"
               viewBox="0 0 16 16">
               <path
                  d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
            Cart
         </a>
         <?php
         }
         ?>
      </div>
      <div class="text-dark rounded-0 py-0 fs-3 me-auto ms-0 mt-2"><?= $_SESSION['user'] ?>'s Wishlist</div>
      <div class="bg-secondary rounded-0 py-0 px-4 me-auto ms-0" style="height: 5px;width:100%;"></div>

      <div class="container-fluid mt-4 mx-auto px-0" style="max-width:940px;">
         <section class="container-fluid d-flex mx-0 flex-column game-section p-0" style="max-width:940px;">
            <?php
            // var_dump($_SESSION['wishsCust']);
            if ($_SESSION['wishsCust']['isset'] === true) {
               $no = 1;
               $wishes = $_SESSION['wishsCust'];
               unset($wishes['games']);
               unset($wishes['isset']);
               foreach ($_SESSION['wishsCust']['games'] as $game) :
                  foreach ($wishes as $wish) :
                     if ($wish['game_id'] == $game['id']) {
                        $wish_added = $wish['created_at'];
                     }
                  endforeach;
                  $developer = null; // Ensure $developer is not null before displaying data
                  if ($game['price'] == 0) {
                     $price = 'Free';
                  } else {
                     $price = '$ ' . $game['price'];
                  }
                  $review_label = 'No Reviews';
                  $user_count = 0;
                  if (isset($data['reviews'])) {
                     foreach ($data['reviews'] as $review_data) :
                        if ($review_data['game_id'] == $game['id']) {
                           $review_label = $review_data['rating_label'];
                           $user_count = $review_data['user_count'];
                        }
                     endforeach;
                  }

                  // Set the color based on the review rating label
                  switch ($review_label) {
                     case 'Mixed':
                        $color = 'rgba(255, 230, 1, 1)'; // Yellow
                        break;
                     case 'Bad':
                        $color = 'rgba(255, 105, 97, 1)'; // Red
                        break;
                     case 'Overwhelming Positive':
                     case 'Very Positive':
                        $color = 'rgba(0, 180, 235, 1)'; // Blue
                        break;
                     default:
                        $color = 'rgba(190, 190, 190, 1)'; // Default
                  }
            ?>
            <div style="height: 172px;"
               class="container game-container mb-2 mx-auto mx-sm-0 p-0 d-flex flex-row shadow-sm"
               data-title="<?= $game['title']; ?>" data-rating-label="<?= $review_label; ?>"
               data-user-count="<?= $user_count; ?>">
               <div class="d-flex flex-row border-end border-2 border-body-secondary">
                  <div class="px-3 align-self-center text-dark"><?= $no ?></div>
               </div>
               <a class="game-logo d-none d-sm-block m-3"
                  href="<?= BASEURL ?>?url=home/game/<?= $game['id'] ?>/<?= $review_label; ?>/<?= $user_count; ?>">
                  <img src="<?= BASEURL ?>/img/game-logo2.jpg" width="300">
               </a>
               <div class="game-detail w-100 mx-2 my-3 d-flex flex-column justify-content-between">
                  <a class=" game-title lh-1 text-black" style="font-size: 1.7rem; font-weight:500;"
                     href="<?= BASEURL ?>?url=home/game/<?= $game['id'] ?>/<?= $review_label; ?>/<?= $user_count; ?>">
                     <?= $game['title']; ?>
                  </a>
                  <div class="d-flex col-12 flex-row justify-content-between">
                     <div class="col-7 game-details d-flex flex-column lh-1">
                        <div class="m-0 p-0 d-flex flex-row align-items-center">
                           <div class="col-4 fw-normal" style="font-size: 0.7rem;" scope="row">ALL REVIEWS:</div>
                           <div class="fs-7-responsive fw-medium" id="reviews" data-rating-label="<?= $review_label ?>"
                              data-user-count="<?= $user_count ?>" style="color: <?= $color ?>;">
                              <?= $review_label ?> <span class="text-secondary">(<?= $user_count ?>)</span>
                           </div>
                        </div>
                        <div class="m-0 p-0 d-flex flex-row align-items-center">
                           <div class="col-4 fw-normal" style="font-size: 0.7rem;" scope="row">RELEASE DATE:</div>
                           <div class="fs-7 fw-medium text-dark"><?= $game['release_date']; ?></div>
                        </div>
                     </div>

                     <div class=" p-1 d-flex flex-row rounded-sm"
                        style="width:196px; background-color: <?= SECONDARY_COLOR ?>">
                        <?php
                              if ($game['price'] == 0) {
                                 $price = 'Free to Play';
                                 $desc = 'Play Now';
                                 $link = 'download';
                                 $event = 'toggleCart(this)';
                              } else {
                                 $price = '$ ' . $game['price'];
                                 $desc = 'Add to Cart';
                                 $link = 'addCart';
                                 $event = 'toggle(this)';
                              }
                              ?>
                        <div class="fs-7 d-flex align-items-center px-2 text-light mx-auto"><?= $price ?></div>
                        <a href='<?= BASEURL ?>?url=game/<?= $link ?>/<?= $game['id'] ?>' onclick="<?= $event ?>"
                           class="btn btn-primary rounded-0 py-1 px-3" style="font-size: 0.9rem;"><?= $desc ?></a>
                     </div>
                  </div>
                  <div class="col-12 d-flex flex-column justify-content-between rounded-sm">
                     <div class="d-flex flex-row gap-1 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           class="bi bi-windows" viewBox="0 0 16 16">
                           <path
                              d="M6.555 1.375 0 2.237v5.45h6.555zM0 13.795l6.555.933V8.313H0zm7.278-5.4.026 6.378L16 16V8.395zM16 0 7.33 1.244v6.414H16z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           class="bi bi-xbox" viewBox="0 0 16 16">
                           <path
                              d="M7.202 15.967a8 8 0 0 1-3.552-1.26c-.898-.585-1.101-.826-1.101-1.306 0-.965 1.062-2.656 2.879-4.583C6.459 7.723 7.897 6.44 8.052 6.475c.302.068 2.718 2.423 3.622 3.531 1.43 1.753 2.088 3.189 1.754 3.829-.254.486-1.83 1.437-2.987 1.802-.954.301-2.207.429-3.239.33m-5.866-3.57C.589 11.253.212 10.127.03 8.497c-.06-.539-.038-.846.137-1.95.218-1.377 1.002-2.97 1.945-3.95.401-.417.437-.427.926-.263.595.2 1.23.638 2.213 1.528l.574.519-.313.385C4.056 6.553 2.52 9.086 1.94 10.653c-.315.852-.442 1.707-.306 2.063.091.24.007.15-.3-.319Zm13.101.195c.074-.36-.019-1.02-.238-1.687-.473-1.443-2.055-4.128-3.508-5.953l-.457-.575.494-.454c.646-.593 1.095-.948 1.58-1.25.381-.237.927-.448 1.161-.448.145 0 .654.528 1.065 1.104a8.4 8.4 0 0 1 1.343 3.102c.153.728.166 2.286.024 3.012a9.5 9.5 0 0 1-.6 1.893c-.179.393-.624 1.156-.82 1.404-.1.128-.1.127-.043-.148ZM7.335 1.952c-.67-.34-1.704-.705-2.276-.803a4 4 0 0 0-.759-.043c-.471.024-.45 0 .306-.358A7.8 7.8 0 0 1 6.47.128c.8-.169 2.306-.17 3.094-.005.85.18 1.853.552 2.418.9l.168.103-.385-.02c-.766-.038-1.88.27-3.078.853-.361.176-.676.316-.699.312a12 12 0 0 1-.654-.319Z" />
                        </svg>
                     </div>
                     <div class="d-flex flex-row gap-1 ms-auto">
                        <span class="game-desc mt-2 fs-7 lh-1 opacity-50">Added on <?= $wish_added; ?> ( <a
                              href="<?= BASEURL ?>?url=game/removeWish/<?= $game['id'] ?>" class="text-secondary"
                              onclick="toggle(this);" style="
            text-decoration-line: underline;
            text-decoration-style: dotted;">remove</a> )</span>
                     </div>
                  </div>
               </div>
            </div>
            <?php
                  $review['user_count'] = 0;
                  $review['rating_label'] = 0;
                  $no++;
               endforeach;
            } else {
               ?>
            <div class="fs-3 pt-5 pt-sm-3 mt-5 mt-sm-3 pb-5 mb-5 pb-sm-4 mb-sm-4 mx-auto">
               <div class="fs-3 py-5 my-5">OOPS, THERE'S NOTHING TO SHOW HERE</div>
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
   opacity: 0.15;
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
   background: linear-gradient(to right, <?=PRIMARY_COLOR ?> 0%, rgba(16, 31, 40, 1) 200%);
}

.preview-reviews {
   background-color: rgba(255, 255, 255, 0.3);
}

.screenshot {
   width: 95%;
   height: 95%;
}

@media (max-width: 576px) {
   .fs-6-responsive {
      font-size: 0.65rem;
   }

   .fs-7-responsive {
      font-size: 0.55rem;
   }

   .game-container {
      height: 50px;
   }

   .game-container img {
      height: 50px;
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