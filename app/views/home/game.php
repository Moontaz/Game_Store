<!-- <?php
      var_dump($_SESSION['cart']);
      ?> -->

<div class="container-fluid bg-game pb-5 d-flex flex-column">
   <div class="container pb-3  px-0" style="max-width:940px;">
      <div class="d-flex flex-row-reverse" style="max-width:940px;">
         <?php
         if (!empty($_SESSION['cart'])) {
         ?>
         <a class=" btn btn-warning text-light rounded-0 py-0 px-4 ms-1 mt-2" style="font-size: 0.8rem;"
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
         <a class=" btn btn-primary rounded-0 py-0 px-5 ms-auto mt-2" style="font-size: 0.8rem;"
            href="<?= BASEURL ?>?url=home/wishlist">Wishlist
         </a>
      </div>
      <p class=" fs-2"><?= $data['judul'] ?></p>
      <div
         class="container-fluid container-bg-game p-0 gap-2 d-flex flex-column flex-sm-row justify-content-evenly shadow-sm">
         <div class="" style="max-width:600px;">
            <img class="img-preview" src="<?= BASEURL ?>/img/game-preview.jpg" alt="">
         </div>
         <?php
         $game = $data['game'];
         ?>
         <div class="game-banner mx-2 mx-sm-0 ms-sm-2 d-flex flex-row justify-content-between">
            <div class="game-info d-flex flex-column justify-content-between">
               <div class="">
                  <img class="" src="<?= BASEURL ?>/img/game-logo2.jpg" alt="" width="100%">
                  <p class="mt-2 fs-7 me-2" style="line-height: 14px;"><?= $game['description']; ?></p>
               </div>
               <div class="game-details">
                  <div class="m-0 p-0 d-flex flex-row align-items-center">
                     <div class="col-4 fs-8 fw-normal" scope="row">ALL REVIEWS:</div>
                     <div class="fs-7 fw-medium color-primary" id="reviews"
                        data-rating-label="<?= $data['rating_label'] ?>" data-user-count="<?= $data['user_count'] ?>">
                        <?= $data['rating_label'] ?> (<?= $data['user_count'] ?>)
                     </div>

                  </div>
                  <div class="m-0 p-0 d-flex flex-row align-items-center">
                     <div class="col-4 fs-8 fw-normal" scope="row">RELEASE DATE:</div>
                     <div class="fs-7 fw-medium"><?= $game['release_date']; ?></div>
                  </div>
                  <div class="m-0 p-0 d-flex flex-row align-items-center">
                     <div class="col-4 fs-8 fw-normal" scope="row">DEVELOPER:</div>
                     <div class="fs-7 fw-medium color-primary"><?= $game['company_name']; ?></div>
                  </div>
                  <div class="m-0 p-0 d-flex flex-row align-items-center">
                     <div class="col-4 fs-8 fw-normal" scope="row">PUBLISHER:</div>
                     <div class="fs-7 fw-medium color-primary"><?= $game['dev_username']; ?></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid container-wish d-flex flex-row-reverse p-3 shadow-sm">

         <?php
         // var_dump($_SESSION['wishsCust']['isset']);
         if ($_SESSION['wishsCust']['isset'] === true) {
            $wishes = $_SESSION['wishsCust'];
            // unset($wishes['isset']);
            foreach ($wishes as $key => $wish) :
               if ($key === 'isset') {
                  continue; // Skip the 'isset' key
               }
               if ($game['id'] == $wish['game_id']) {
                  $isIn = 1;
               }
            // $isInWishlist = in_array($game['id'], $wish);
            endforeach;
         } else {
            // echo 'KOSONGGGGGG';
         }
         if (isset($isIn)) {
            $isInWishlist = true;
         } else {
            $isInWishlist = false;
         }
         ?>

         <a id="addWish" class="btn btn-primary rounded-sm addWish"
            href="<?= BASEURL ?>?url=game/addWish/<?= $game['id'] ?>" onclick=" toggleWishlist(this);"
            style="<?= $isInWishlist ? 'display:none;' : '' ?>">
            <span style="font-size: 0.9rem;">Add to your wishlist</span>
         </a>

         <a id="onWish" class="btn btn-primary rounded-sm onWish"
            href="<?= BASEURL ?>?url=game/removeWish/<?= $game['id'] ?>" onclick=" toggleWishlist(this);"
            style="<?= !$isInWishlist ? 'display:none;' : '' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
               class="bi bi-check2-circle" viewBox="0 0 16 16">
               <path
                  d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
               <path
                  d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
            </svg>
            <span style="font-size: 0.9rem;">On Wishlist</span>
         </a>

      </div>
      <div class="container-fluid mt-3 container-wish d-flex flex-column mx-auto p-3 shadow-sm">
         <?php if ($data['can_review']) : ?>
         <?php if (empty($data['review'])) : ?>
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">
            Add Review
         </button>
         <?php else : ?>
         <?php
               $rating = $data['review']['rating'];
               $maxRating = 5;
               ?>
         <div class="rating mx-auto text-warning mb-3">
            <?php for ($i = 1; $i <= $maxRating; $i++) : ?>
            <?php if ($i <= $rating) : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
               class="bi bi-star-fill mx-2" viewBox="0 0 16 16">
               <path
                  d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
            </svg>
            <?php else : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-star mx-2"
               viewBox="0 0 16 16">
               <path
                  d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
            </svg>
            <?php endif; ?>
            <?php endfor; ?>
         </div>
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateReviewModal">
            Update
         </button>
         <?php endif; ?>
         <?php else : ?>
         <p class="text-center text-muted">You must purchase this game before you can leave a review.</p>
         <?php endif; ?>
      </div>


      <div class="container-fluid px-0 py-3 mt-2 mt-sm-5 d-flex flex-column flex-sm-row justify-content-between">
         <div class="container-play pb-3 d-flex flex-column container-bg-game  rounded-sm shadow-sm w-100"
            style="height:90px; max-width:600px;">
            <div class=" d-flex pt-3 pb-4 px-3 flex-row justify-content-between">
               <div class=" fs-5 align-items-center">Play <?= $game['title'] ?></div>
               <div class="" style="height: fit-content;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-microsoft" viewBox="0 0 16 16">
                     <path
                        d="M7.462 0H0v7.19h7.462zM16 0H8.538v7.19H16zM7.462 8.211H0V16h7.462zm8.538 0H8.538V16H16z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-xbox"
                     viewBox="0 0 16 16">
                     <path
                        d="M7.202 15.967a8 8 0 0 1-3.552-1.26c-.898-.585-1.101-.826-1.101-1.306 0-.965 1.062-2.656 2.879-4.583C6.459 7.723 7.897 6.44 8.052 6.475c.302.068 2.718 2.423 3.622 3.531 1.43 1.753 2.088 3.189 1.754 3.829-.254.486-1.83 1.437-2.987 1.802-.954.301-2.207.429-3.239.33m-5.866-3.57C.589 11.253.212 10.127.03 8.497c-.06-.539-.038-.846.137-1.95.218-1.377 1.002-2.97 1.945-3.95.401-.417.437-.427.926-.263.595.2 1.23.638 2.213 1.528l.574.519-.313.385C4.056 6.553 2.52 9.086 1.94 10.653c-.315.852-.442 1.707-.306 2.063.091.24.007.15-.3-.319Zm13.101.195c.074-.36-.019-1.02-.238-1.687-.473-1.443-2.055-4.128-3.508-5.953l-.457-.575.494-.454c.646-.593 1.095-.948 1.58-1.25.381-.237.927-.448 1.161-.448.145 0 .654.528 1.065 1.104a8.4 8.4 0 0 1 1.343 3.102c.153.728.166 2.286.024 3.012a9.5 9.5 0 0 1-.6 1.893c-.179.393-.624 1.156-.82 1.404-.1.128-.1.127-.043-.148ZM7.335 1.952c-.67-.34-1.704-.705-2.276-.803a4 4 0 0 0-.759-.043c-.471.024-.45 0 .306-.358A7.8 7.8 0 0 1 6.47.128c.8-.169 2.306-.17 3.094-.005.85.18 1.853.552 2.418.9l.168.103-.385-.02c-.766-.038-1.88.27-3.078.853-.361.176-.676.316-.699.312a12 12 0 0 1-.654-.319Z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam"
                     viewBox="0 0 16 16">
                     <path
                        d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.2 2.2 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.22 2.22 0 0 1-1.312-1.568L.33 10.333Z" />
                     <path
                        d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.7 1.7 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027m2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048" />
                  </svg>
               </div>
            </div>
            <div class="container-button me-3 d-flex flex-row-reverse ">
               <div class="bg-dark p-1 d-flex flex-row justify-content-evenly rounded-sm">
                  <?php
                  if ($game['price'] == 0) {
                     $price = 'Free to Play';
                     $desc = 'Play Now';
                     $link = 'user/addOrdersFree/' . $_SESSION['cust_id'] . '/0';
                     // $event = 'toggleCart(this)';
                  } else {
                     $price = '$ ' . $game['price'];
                     $desc = 'Add to Cart';
                     $link = 'game/addCart';
                     // $event = 'toggleCart(this)'
                  }
                  ?>
                  <div class="fs-7 d-flex align-items-center px-2 text-light me-2"><?= $price ?></div>
                  <a href='<?= BASEURL ?>?url=<?= $link ?>/<?= $game['id'] ?>'
                     class="btn btn-primary py-1 px-4 rounded-sm " style="font-size: 0.9rem;"><?= $desc ?></a>
               </div>
            </div>
         </div>
         <div class="feature-lists mt-5 mt-sm-0 p-3 row-12 col-sm-4">
            <div class="d-flex flex-column gap-1">
               <a href="#" class=" bg-item rounded-sm p-0 m-0 d-flex flex-row">
                  <div class="logo-desc px-2  rounded-sm-start">
                     <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="white"
                        class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                     </svg>
                  </div>
                  <p class="ms-2 my-auto" style="font-size: 0.75rem;">Single Player</p>
               </a>
               <a href="#" class=" bg-item rounded-sm p-0 m-0 d-flex flex-row">
                  <div class="logo-desc px-2  rounded-sm-start">
                     <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="white"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                           d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                     </svg>
                  </div>
                  <p class="ms-2 my-auto" style="font-size: 0.75rem;">Multiplayer</p>
               </a>
               <a href="#" class=" bg-item rounded-sm p-0 m-0 d-flex flex-row">
                  <div class="logo-desc px-2  rounded-sm-start">
                     <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="white" class="bi bi-cart-fill"
                        viewBox="0 0 16 16">
                        <path
                           d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                     </svg>
                  </div>
                  <p class="ms-2 my-auto" style="font-size: 0.75rem;">In-App Purchases</p>
               </a>
               <a href="#" class=" bg-item rounded-sm p-0 m-0 d-flex flex-row">
                  <div class="logo-desc px-2  rounded-sm-start">
                     <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="white"
                        class="bi bi-cloud-fill" viewBox="0 0 16 16">
                        <path
                           d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                     </svg>
                  </div>
                  <p class="ms-2 my-auto" style="font-size: 0.75rem;">Cloud Storage</p>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal Add Review -->
<div class="modal" id="addReviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateOrderLabel">Add Review</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body bg-secondary-subtle">
            <form id="addReviewForm" action="<?= BASEURL ?>/?url=game/addReview" method="post">
               <div class="mb-4 fs-2 text-center"><?= $game['title'] ?></div>
               <div class="mb-2">
                  <label for="updateProvince" class="form-label me-3">Rate: </label>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1">
                     <label class="form-check-label">1</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2">
                     <label class="form-check-label">2</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="3">
                     <label class="form-check-label">3</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="inlineRadio4" value="4">
                     <label class="form-check-label">4</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="inlineRadio5" value="5">
                     <label class="form-check-label">5</label>
                  </div>
               </div>
               <input type="hidden" id="addGameId" name="game_id" value="<?= $game['id'] ?>">
               <input type="hidden" id="addCustId" name="customer_id" value="<?= $_SESSION['cust_id'] ?>">
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
         </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Update Review -->
<div class="modal" id="updateReviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateReviewLabel">Update Review</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body bg-secondary-subtle">
            <form id="updateReviewForm" action="<?= BASEURL ?>/?url=game/updateReview" method="post">
               <div class="mb-4 fs-2 text-center"><?= $game['title'] ?></div>
               <div class="mb-2">
                  <label for="updateProvince" class="form-label me-3">Rate: </label>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="updateRadio1" value="1"
                        <?= $data['review']['rating'] == 1 ? 'checked' : '' ?>>
                     <label class="form-check-label">1</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="updateRadio2" value="2"
                        <?= $data['review']['rating'] == 2 ? 'checked' : '' ?>>
                     <label class="form-check-label">2</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="updateRadio3" value="3"
                        <?= $data['review']['rating'] == 3 ? 'checked' : '' ?>>
                     <label class="form-check-label">3</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="updateRadio4" value="4"
                        <?= $data['review']['rating'] == 4 ? 'checked' : '' ?>>
                     <label class="form-check-label">4</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="rating" id="updateRadio5" value="5"
                        <?= $data['review']['rating'] == 5 ? 'checked' : '' ?>>
                     <label class="form-check-label">5</label>
                  </div>
               </div>
               <input type="hidden" id="updateGameId" name="game_id" value="<?= $data['review']['game_id'] ?>">
               <input type="hidden" id="updateCustId" name="customer_id" value="<?= $data['review']['customer_id'] ?>">
               <input type="hidden" id="updateReviewId" name="review_id" value="<?= $data['review']['id'] ?>">
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="updateSubmitBtn">Submit</button>
         </div>
         </form>
      </div>
   </div>
</div>


<style>
a {
   text-decoration: none;
}

.rounded-sm {
   border-radius: 2px;
}

.rounded-sm-start {
   border-radius: 2px 0 0 2px;
}

.fs-7 {
   font-size: 0.8rem;
}

.game-info .fs-7,
.container-button .fs-7 {
   font-size: 0.8rem;
}

.game-info .fs-8 {
   font-size: 0.65rem;
   color: rgba(0, 0, 0, 0.5);
}

.game-info .color-primary {
   color: <?=PRIMARY_COLOR ?>;
}

.bg-game {
   position: relative;
   display: flex;
   overflow: hidden;
   background-color: rgba(26, 50, 63, 0.2);
}

.bg-game::before {
   content: "";
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: url('<?= BASEURL ?>/img/game-bg.jpg') no-repeat center center;
   background-size: cover;
   opacity: 0.3;
   z-index: -1;
}

.container-bg-game {
   background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.6) 60%, rgba(255, 255, 255, 0.65) 100%);
}

.container-wish {
   background-color: rgba(255, 255, 255, 0.65);
}

.container-wish span {
   color: rgba(194, 218, 254, 1);
}

.container-play {
   position: relative;
}

.container-button {
   position: absolute;
   top: 65px;
   right: 0;
}

.feature-lists {
   background: linear-gradient(to right, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 1) 60%, rgba(255, 255, 255, 0.65) 100%);
}

.bg-item {
   background: linear-gradient(to right, rgba(0, 0, 0, 0.2) 0%, rgba(255, 255, 255, 1) 200%);
}

.bg-item:hover {
   background: linear-gradient(to right, rgba(13, 110, 253, 1) 0%, rgba(255, 255, 255, 1) 200%);
}

.bg-item p {
   color: black;
}

.bg-item:hover p {
   color: rgba(255, 255, 255, 1);
}

.logo-desc {
   background-color: rgba(64, 64, 64, 1);
}

@media (max-width: 576px) {
   .img-preview {
      width: 100%;
      height: 100%;
   }

   .game-banner {
      object-fit: cover;
   }
}

.table-container {
   width: 100%;
   max-width: 800px;
   height: 400px;
   margin: auto;
   padding: 15px;
   background-color: #fff;
   border: 1px solid #ddd;
   border-radius: 5px;
}

.table {
   margin-bottom: 0;
}

.pagination {
   margin-top: 15px;
}

.section {
   display: none;
}

.section.active {
   display: block;
}

.fs-7 {

   font-size: 0.92rem;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

   const radioButtons = document.querySelectorAll('input[name="rating"]');
   const submitBtn = document.getElementById('submitBtn');

   radioButtons.forEach(function(radio) {
      radio.addEventListener('change', function() {
         submitBtn.disabled = false;
      });
   });

   const updateRadioButtons = document.querySelectorAll('#updateReviewForm input[name="rating"]');
   const updateSubmitBtn = document.getElementById('updateSubmitBtn');

   updateRadioButtons.forEach(function(radio) {
      radio.addEventListener('change', function() {
         updateSubmitBtn.disabled = false;
      });
   });

   var reviewsElement = document.getElementById('reviews');

   function setReviewText(ratingLabel, userCount) {
      var color;
      if (userCount == 0) {
         reviewsElement.innerHTML = '<span style="color: rgba(0, 0, 0, 0.3);">no user reviews</span>';
      } else {
         switch (ratingLabel) {
            case 'Mixed':
               color = 'rgba(210, 210, 10, 1)';
               break;
            case 'Bad':
               color = 'rgba(255, 105, 97, 1)';
               break;
            case 'OverwhelmingPositive':
               ratingLabel = 'Overwhelming Positive';
               color = 'rgba(0, 180, 235, 1)';
               break;
            case 'VeryPositive':
               ratingLabel = 'Very Positive';
               color = 'rgba(0, 180, 235, 1)';
               break;
            default:
               color = 'rgba(0, 0, 0, 0.3)';
         }
         reviewsElement.innerHTML =
            `<span style="color: ${color};">${ratingLabel}</span> <span style="color: rgba(0, 0, 0, 0.3);">(${userCount})</span>`;
      }
   }

   var ratingLabel = reviewsElement.getAttribute('data-rating-label');
   var userCount = reviewsElement.getAttribute('data-user-count');

   setReviewText(ratingLabel, userCount);
});

function toggleCart(element) {
   // event.preventDefault();
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

$(document).ready(function() {
   $('.updateDev').on('click', function() {
      const id = $(this).data('id');
      const username = $(this).data('username');
      const email = $(this).data('email');
      const companyName = $(this).data('company_name');
      const password = $(this).data('password');

      $('#updateUserId').val(id);
      $('#updateUsername').val(username);
      $('#updateEmail').val(email);
      $('#updateCompanyName').val(companyName);
      $('#updatePassword').val(password);
   });

   $('.updateGame').on('click', function() {
      const id = $(this).data('id');
      const title = $(this).data('title');
      const description = $(this).data('description');
      const price = $(this).data('price'); // Assuming data-price is set as a decimal in the HTML
      const releaseDate = $(this).data('release_date');
      const filePath = $(this).data('file_path');

      // Parse the date to the correct format for the date input
      const date = new Date(releaseDate);
      const formattedDate = date.toISOString().split('T')[0];

      $('#updateGameId').val(id);
      $('#updateTitle').val(title);
      $('#updateDescription').val(description);
      $('#updatePrice').val(price);
      $('#updateReleaseDate').val(formattedDate);
      $('#updateFilePath').val(filePath);
   });

   $(document).ready(function() {
      $('#paginationGameBar .nav-link').on('click', function(e) {
         e.preventDefault();
         $('#paginationGameBar .nav-link').removeClass('active');
         $(this).addClass('active');

         const sectionToShow = $(this).data('section');
         $('.game-section').removeClass('active');
         $('#' + sectionToShow).addClass('active');
      });
   });
});
</script>