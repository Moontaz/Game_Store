<div class="container-fluid index-body ">
   <div class="container-fluid p-0 d-flex flex-column" style="max-width:940px;">
      <div class="ms-auto">
         <a class=" btn btn-primary rounded-0 py-0 px-5 fs-7 ms-auto mt-2 " href="<?= BASEURL ?>?url=home/wishlist">Wishlist
         </a>
         <?php
         // var_dump($_SESSION['cart']);
         if (!empty($_SESSION['cart'])) {
         ?>
            <a class=" btn btn-warning text-light rounded-0 py-0 px-4 fs-7 ms-auto mt-2 " href="<?= BASEURL ?>?url=home/cart">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
               </svg>
               Cart
            </a>
         <?php
         }
         ?>
      </div>
      <div class="container-fluid mt-4 d-flex flex-row justify-content-between mx-auto px-0" style="max-width:940px;">
         <section class="container-fluid d-flex mx-0 flex-column game-section  p-0" style="max-width:618px;">
            <?php
            foreach ($data['Games'] as $index => $game) :
               $developer = null; // Ensure $developer is not null before displaying data
               if ($game['price'] == 0) {
                  $price = 'Free';
               } else {
                  $price = '$ ' . $game['price'];
               }
               if (isset($data['reviews'])) {
                  foreach ($data['reviews'] as $review_data) :
                     if ($review_data['game_id'] == $game['id']) {
                        $review = $review_data;
                     }
                  endforeach;
               }
            ?>
               <a href="<?= BASEURL ?>?url=home/game/<?= $game['id'] ?>/<?= $review['rating_label']; ?>/<?= $review['user_count']; ?>" class="container game-container mb-2 mx-auto mx-sm-0 p-0 d-flex flex-row shadow-sm <?php if ($index == 0) echo 'active'; ?>" style="max-height: 69px;" data-title="<?= $game['title']; ?>" data-rating-label="<?= $review['rating_label']; ?>" data-user-count="<?= $review['user_count']; ?>">
                  <div class="game-logo my-auto my-sm-0">
                     <img src="<?= BASEURL ?>/img/game-logo.jpg" alt="">
                  </div>
                  <div class=" game-detail w-100 m-2 d-flex flex-row justify-content-between">
                     <div class="col-8 d-flex flex-column justify-content-between">
                        <span class="game-title lh-1 fs-6-responsive fw-bold"><?= $game['title']; ?></span>
                        <span class="game-desc fs-7-responsive lh-1 opacity-50"><?= $game['short_desc']; ?></span>
                     </div>
                     <div class="col-4 d-flex my-auto  justify-content-end">
                        <p class="my-auto me-3 fs-6-responsive"><?= $price; ?></p>
                     </div>
                  </div>
               </a>
            <?php
               $review['user_count'] = 0;
               $review['rating_label'] = 0;
            endforeach;
            ?>
         </section>
         <div class="tab-preview p-3 lh-1 d-none d-sm-flex flex-column" style="height: 690px; width:308px;">
            <div class="fs-5 mb-2 text-light" id="title"><?= $data['Games'][0]['title'] ?></div>
            <div class="preview-reviews rounded-1 px-2 py-2 d-flex flex-column">
               <div class="fs-7 text-light">Overall user reviews:</div>
               <div class="fs-7 mt-1" id="reviews"><?= $data['reviews'][0]['rating_label'] ?>
                  (<?= $data['reviews'][0]['user_count'] ?>)</div>
            </div>
            <?php
            $no = 1;
            for ($no = 1; $no <= 4; $no++) :
            ?>
               <div class="screenshot mt-2 mx-auto" style="background: url('<?= BASEURL ?>/img/ss-<?= $no ?>.jpg') no-repeat center center;background-size: cover;">
               </div>
            <?php
            endfor;
            ?>
         </div>
      </div>
   </div>
</div>

<style>
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

   .fs-7-responsive {
      font-size: 0.8rem;
   }

   .game-section .game-container {
      position: relative;
      background: linear-gradient(to left, grey -200%, rgba(255, 255, 255, 1) 100%);
      text-decoration: none;
   }

   .game-section .game-container:hover,
   .game-section .game-container.active {
      background: linear-gradient(to left, <?= PRIMARY_COLOR ?> 0%, rgba(194, 218, 254, 1) 200%);
      padding-right: 10px;
   }

   .game-section .game-container::before {
      content: "";
      position: absolute;
      top: 0;
      right: -15px;
      width: 17px;
      height: 100%;
      background-color: <?= PRIMARY_COLOR ?>;
      background-size: cover;
      opacity: 0;
      z-index: 10;
   }

   .game-section .game-container:hover::before,
   .game-section .game-container.active::before {
      opacity: 1;
   }

   .game-detail span,
   .game-detail p {
      color: black;
   }

   .game-detail .game-title {
      opacity: 0.6;
   }

   .game-container:hover .game-detail span,
   .game-container.active .game-detail span {
      color: white;
      opacity: .8;
   }

   .game-container:hover .game-detail p,
   .game-container.active .game-detail p {
      color: white;
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

   @media (max-width: 576px) {
      .fs-6-responsive {
         font-size: 0.8rem;
      }

      .fs-7-responsive {
         font-size: 0.55rem;
      }

      .game-container {
         height: 70px;
      }

      .game-container img {
         height: 60px;
      }
   }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
      var gameContainers = document.querySelectorAll('.game-container');
      var titleElement = document.getElementById('title');
      var reviewsElement = document.getElementById('reviews');
      var activeContainer = document.querySelector('.game-container.active');

      function setReviewText(ratingLabel, userCount) {
         var color;
         if (userCount == 0) {
            reviewsElement.innerHTML = '<span style="color: rgba(255, 255, 255, 0.5);">no user reviews</span>';
         } else {
            switch (ratingLabel) {
               case 'Mixed':
                  color = 'rgba(255, 255, 153, 1)';
                  break;
               case 'Bad':
                  color = 'rgba(255, 105, 97, 1)';
                  break;
               case 'Overwhelming Positive':
               case 'Very Positive':
                  color = 'rgba(135, 206, 235, 1)';
                  break;
               default:
                  color = 'rgba(255, 255, 255, 0.5)';
            }
            reviewsElement.innerHTML =
               `<span style="color: ${color};">${ratingLabel}</span> <span style="color: white;">(${userCount})</span>`;
         }
      }

      if (activeContainer) {
         var title = activeContainer.getAttribute('data-title');
         var ratingLabel = activeContainer.getAttribute('data-rating-label');
         var userCount = activeContainer.getAttribute('data-user-count');

         titleElement.textContent = title;
         setReviewText(ratingLabel, userCount);
      }

      gameContainers.forEach(function(container) {
         container.addEventListener('mouseover', function() {
            if (activeContainer) {
               activeContainer.classList.remove('active');
            }
            activeContainer = this;
            this.classList.add('active');

            var title = this.getAttribute('data-title');
            var ratingLabel = this.getAttribute('data-rating-label');
            var userCount = this.getAttribute('data-user-count');
            titleElement.textContent = title;
            setReviewText(ratingLabel, userCount);
         });
      });
   });
</script>