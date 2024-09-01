<div class="container mt-5  px-0" style="max-width:1000px;">

   <section class="container-fluid game-section mt-5 p-0">
      <?php
      $dev = $data['Dev'];
      foreach ($data['Games'] as $game) :
         if ($game['developer_id'] == $dev['id']) : // Ensure $developer is not null before displaying data
      ?>
            <a href="<?= BASEURL ?>?url=home/game/<?= $game['id'] ?>" class="container game-container m-1  p-0 d-flex flex-row" style="height: 69px;max-width:700px;">
               <div class="">
                  <img src="<?= BASEURL ?>/img/game-logo.jpg" alt="">
               </div>
               <div class="w-100 m-2 d-flex flex-row justify-content-between">
                  <div class="col-8 d-flex flex-column justify-content-between">
                     <span class="game-title fs-6 fw-bold text-light "><?= $game['title']; ?></span>
                     <span class="game-desc fs-7 lh-1 text-light opacity-50"><?= $game['short_desc']; ?></span>
                  </div>
                  <div class="col-4 d-flex my-auto  justify-content-end">
                     <p class="my-auto me-3 text-light">$ <?= $game['price']; ?></p>
                  </div>
               </div>
            </a>
      <?php
         endif;
      endforeach;
      ?>
   </section>

   <div class="container mt-5" style="max-width: 1000px;" id="game_bar">
      <div class="container my-5">
         <ul class="nav nav-tabs" id="paginationGameBar">
            <li class="nav-item">
               <a class="nav-link active" href="#" data-section="games">Games</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#" data-section="wishlists">Wishlists</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#" data-section="reviews">Reviews</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#" data-section="downloads">Downloads</a>
            </li>
         </ul>


         <div class="section game-section active" id="games">
            <form class="mb-5" id="multiDeleteGamesForm" action="<?= BASEURL ?>/?url=Game/deleteGames/Dashboard/index2#game" method="post">

               <button type="submit" class="btn btn-danger btn-sm ms-4 my-3 disabled" id="deleteSelectedGames">
                  Delete
               </button>
               <button type="button" class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addGameModal">add Game</button>
               <div class="accordion overflow-auto" id="gamesAccordion" style="max-height: 400px;">
                  <?php
                  $dev = $data['Dev'];
                  foreach ($data['Games'] as $game) : // Ensure $developer is not null before displaying data
                  ?>
                     <div class="accordion-item">
                        <h2 class="accordion-header d-flex align-items-center" id="heading<?= $game['id']; ?>">
                           <input type="checkbox" class="form-check-input mx-2" name="deleteGameIds[]" value="<?= $game['id']; ?>" style="width: 16px; height: 16px">
                           <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $game['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $game['id']; ?>">
                              <?= $game['title']; ?>
                           </button>
                        </h2>
                        <div id="collapse<?= $game['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $game['id']; ?>" data-bs-parent="#gamesAccordion">
                           <div class="accordion-body d-flex flex-row">
                              <div class="container ms-3 col-11">
                                 <p><strong>Description:</strong> <?= $game['description']; ?></p>
                                 <p><strong>Price:</strong> $<?= $game['price']; ?></p>
                                 <p><strong>Release Date:</strong> <?= $game['release_date']; ?></p>
                                 <p><strong>Developer:</strong> <?= $dev['company_name']; ?></p>
                                 <p><strong>File Path:</strong> <?= $game['file_path']; ?></p>
                              </div>
                              <div class="container details col-1">
                                 <button type="button" class="btn btn-primary btn-sm mb-1" aria-label="Details">Details</button>
                                 <button type="button" class="btn btn-warning btn-sm m-auto updateGame" data-bs-toggle="modal" data-bs-target="#updateDataGame" data-id="<?= $game['id']; ?>" data-developer_id="<?= $game['developer_id']; ?>" data-title="<?= $game['title']; ?>" data-description="<?= $game['description']; ?>" data-price="<?= $game['price']; ?>" data-release_date="<?= $game['release_date']; ?>" data-file_path="<?= $game['file_path']; ?>">
                                    Change
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php
                  endforeach;
                  ?>
               </div>
            </form>
         </div>
         <div class="section game-section" id="wishlists">
            <div class="container my-2">
               <form id="multiDeleteFormWish" action="<?= BASEURL ?>/?url=Game/deleteWishs/Dashboard/index2" method="post">
                  <div class="container table-container mt-5 d-flex flex-column shadow" style="max-width: 1000px;">
                     <table class="table table-hover table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th scope="col" class="col">#</th>
                              <th scope="col" class="col">ID</th>
                              <th scope="col" class="col">Customer</th>
                              <th scope="col" class="col">Game</th>
                              <th scope="col" class="col">Time</th>
                           </tr>
                        </thead>
                        <tbody id="wishTable">
                           <?php
                           $no = 1;
                           foreach ($data['wishs'] as $wish) :
                              $customer = null;
                              $game = null;
                              foreach ($data['custs'] as $cust) :
                                 if ($cust['id'] == $wish['customer_id']) {
                                    $customer = $cust;
                                    break; // Exit the loop after finding the matching developer
                                 }
                              endforeach;
                              foreach ($data['Games'] as $data_game) :
                                 if ($data_game['id'] == $wish['game_id']) {
                                    $game = $data_game;
                                    break; // Exit the loop after finding the matching developer
                                 }
                              endforeach;
                              if ($game != null && $customer != null) : // Ensure $developer is not null before displaying data
                           ?>
                                 <tr>
                                    <th class="text-center" scope="row" class="col"><?= $no; ?></th>
                                    <?php $no += 1; ?>
                                    <td class="col"><?= $wish['id']; ?></td>
                                    <td class="col"><?= $customer['full_name']; ?></td>
                                    <td class="col"><?= $game['title']; ?></td>
                                    <td class="col"><?= $wish['created_at']; ?></td>
                                 </tr>
                           <?php
                              endif;
                           endforeach;
                           ?>
                        </tbody>
                     </table>
                  </div>
            </div>
            </form>
         </div>
      </div>
      <div class="section game-section" id="reviews">
         <div class="container table-container mt-5 d-flex flex-column shadow" style="max-width: 1000px;">
            <table class="table table-hover table-bordered">
               <thead>
                  <tr class="text-center">
                     <th scope="col" class="col">#</th>
                     <th scope="col" class="col">ID</th>
                     <th scope="col" class="col">Customer</th>
                     <th scope="col" class="col">Game</th>
                     <th scope="col" class="col">Rate</th>
                     <th scope="col" class="col">Time</th>
                  </tr>
               </thead>
               <tbody id="reviewTable">
                  <?php
                  $no = 1;
                  foreach ($data['reviews'] as $review) :
                     $customer = null;
                     $game = null;
                     foreach ($data['custs'] as $cust) :
                        if ($cust['id'] == $review['customer_id']) {
                           $customer = $cust;

                           foreach ($data['users'] as $user_data) :
                              if ($cust['user_id'] == $user_data['id']) {
                                 $user = $user_data;
                                 break;
                              }
                           endforeach;
                           break; // Exit the loop after finding the matching developer
                        }
                     endforeach;
                     foreach ($data['Games'] as $data_game) :
                        if ($review['game_id'] == $data_game['id']) {
                           $game = $data_game;
                           break; // Exit the loop after finding the matching developer
                        }
                     endforeach;
                     if ($game != null && $customer != null) : // Ensure $developer is not null before displaying data
                  ?>
                        <tr>
                           <th class="text-center" scope="row" class="col"><?= $no; ?></th>
                           <?php $no += 1; ?>
                           <td class="col"><?= $review['id']; ?></td>
                           <td class="col"><?= $user['username']; ?></td>
                           <td class="col"><?= $game['title']; ?></td>
                           <td class="col"><?= $review['rating']; ?></td>
                           <td class="col fst-italic"><?= $review['created_at']; ?></td>
                        </tr>
                  <?php
                     endif;
                  endforeach;
                  ?>
               </tbody>
            </table>
         </div>

      </div>
      <div class="section game-section" id="downloads">
         <div class="container table-container mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
            <table class="table table-hover table-bordered">
               <thead>
                  <tr class="text-center">
                     <th scope="col">#</th>
                     <th scope="col">ID</th>
                     <th scope="col">Cust ID</th>
                     <th scope="col">Game ID</th>
                     <th scope="col">Game Name</th>
                     <th scope="col">Time</th>
                  </tr>
               </thead>
               <tbody id="downloadsTable">
                  <?php
                  $no = 1;
                  foreach ($data['downloads'] as $download) :
                     foreach ($data['Games'] as $game) :
                        if ($download['game_id'] == $game['id']) {
                  ?>
                           <tr>
                              <th class="text-center" scope="row"><?= $no; ?></th>
                              <?php $no += 1; ?>
                              <td><?= $download['id']; ?></td>
                              <td><?= $download['customer_id']; ?></td>
                              <td><?= $download['game_id']; ?></td>
                              <td><?= $game['title']; ?></td>
                              <td><?= $download['download_date']; ?></td>
                           </tr>
                  <?php
                           break;
                        }
                     endforeach;
                  endforeach;
                  ?>
               </tbody>
            </table>

            <!-- Pagination -->
            <nav class="d-flex justify-content-between">
               <div class="container">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary btn-sm m-auto" data-bs-toggle="modal" data-bs-target="#addItemModal" disabled>
                     Add Data
                  </button>
               </div>
            </nav>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<div class="modal-container">
   <!-- Modal Add Game -->
   <div class="modal" id="addGameModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="addGameLabel">Add Game</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="addGameForm" action="<?= BASEURL ?>/?url=game/addGame" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                     <label for="title" class="form-label">Title</label>
                     <input type="text" class="form-control" id="title" name="title" required>
                  </div>
                  <div class="mb-3">
                     <label for="short_desc" class="form-label">Short Description</label>
                     <textarea class="form-control" id="short_desc" name="short_desc" required></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="description" class="form-label">Description</label>
                     <textarea class="form-control" id="description" name="description" required></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="price" class="form-label">Price</label>
                     <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                  </div>
                  <div class="mb-3">
                     <label for="release_date" class="form-label">Release Date</label>
                     <input type="date" class="form-control" id="release_date" name="release_date" required>
                  </div>
                  <div class="mb-3">
                     <label for="game_file" class="form-label">Game File</label>
                     <input type="file" class="form-control" id="game_file" name="game_file" required>
                  </div>
                  <input type="hidden" id="developer_id" name="developer_id" value="<?= $_SESSION['dev_id'] ?>">
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>


   <!-- Modal Update Data Game -->
   <div class="modal" id="updateDataGame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="updateDataLabel">Update Data Game</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updateForm" action="<?= BASEURL ?>/?url=Game/updateGame/Dashboard/index#game" method="post">
                  <div class="mb-3">
                     <label for="updateTitle" class="form-label">Title</label>
                     <input type="text" class="form-control" id="updateTitle" name="title">
                  </div>
                  <div class="mb-3">
                     <label for="updateDescription" class="form-label">Description</label>
                     <input type="text" class="form-control" id="updateDescription" name="description">
                  </div>
                  <div class="mb-3">
                     <label for="updatePrice" class="form-label">Price $</label>
                     <input type="number" step="0.01" class="form-control" id="updatePrice" name="price">
                     <div id="emailHelp" class="form-text">Max 50 characters long.</div>
                  </div>
                  <div class="mb-3">
                     <label for="updateReleaseDate" class="form-label">Release Date</label>
                     <input type="date" class="form-control" id="updateReleaseDate" name="release_date">
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <div class="mb-3">
                     <label for="updateFilePath" class="form-label">File Path</label>
                     <input type="text" class="form-control" id="updateFilePath" name="file_path">
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" id="updateGameId" name="id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>


<style>
   .header-second {
      background-color: <?= PRIMARY_COLOR ?>;

      overflow: hidden;
   }

   .fs-7 {
      font-size: 0.8rem;
   }

   .header-second a {
      color: white;
      position: relative;
      overflow: hidden;
   }

   .header-second a:hover {
      color: white;
   }

   .header-second a::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 200px;
      /* Tambahkan width dan height agar elemen before terlihat */
      height: 40px;
      /* Menentukan posisi agar z-index berfungsi */
      background: linear-gradient(to bottom right, <?= SECONDARY_COLOR ?> 15%, rgba(0, 0, 0, 0) 65%);
      opacity: 0;
      z-index: 0;
   }

   .header-second a:hover::before {
      opacity: 0.25;
   }

   .game-section .game-container {
      background-color: rgba(58, 142, 165, 0.9);
      text-decoration: none;
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
   $(document).ready(function() {
      const rowsPerPage = 5;
      const rows = $('#developerTable tr');
      const rowsCount = rows.length;
      const pageCount = Math.ceil(rowsCount / rowsPerPage);
      const pagination = $('#pagination');
      const deleteButton = $('#deleteSelected');
      const deleteGamesButton = $('#deleteSelectedGames');

      for (let i = 1; i <= pageCount; i++) {
         pagination.append(`<li class="page-item"><a class="page-link btn-sm" href="#">${i}</a></li>`);
      }

      rows.hide();
      rows.slice(0, rowsPerPage).show();
      pagination.find('li:first').addClass('active');

      pagination.find('li').on('click', function(e) {
         e.preventDefault();
         const pageIndex = $(this).index();
         pagination.find('li').removeClass('active');
         $(this).addClass('active');
         const start = pageIndex * rowsPerPage;
         const end = start + rowsPerPage;
         rows.hide().slice(start, end).show();
      });

      function toggleDeleteButton(selector, button) {
         if ($(selector + ':checked').length > 0) {
            button.removeClass('disabled');
         } else {
            button.addClass('disabled');
         }
      }
      $('#selectAllWishs').on('click', function() {
         $('input[name="deleteIdsWish[]"]').prop('checked', this.checked);
         toggleDeleteButton('input[name="deleteIdsWish[]"]', $('#deleteSelectedWishs'));
      });

      $('input[name="deleteIdsWish[]"]').on('click', function() {
         const allChecked = $('input[name="deleteIdsWish[]"]').length === $(
            'input[name="deleteIdsWish[]"]:checked').length;
         $('#selectAllWishs').prop('checked', allChecked);
         toggleDeleteButton('input[name="deleteIdsWish[]"]', $('#deleteSelectedWishs'));
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
      $('.updateWish').on('click', function() {
         const id = $(this).data('id');
         const cust_id = $(this).data('cust_id');
         const game_id = $(this).data('game_id');

         // console.log("Wish ID: ", id);
         // console.log("Customer ID: ", cust_id);
         // console.log("Game ID: ", game_id);

         $('#updateWishId').val(id);
         $('#updateCustId').val(cust_id);
         $('#updateWishGameId').val(game_id);
      });


      $('input[name="deleteGameIds[]"]').on('click', function() {
         toggleDeleteGamesButton();
      });

      function toggleDeleteGamesButton() {
         if ($('input[name="deleteGameIds[]"]:checked').length > 0) {
            deleteGamesButton.removeClass('disabled');
         } else {
            deleteGamesButton.addClass('disabled');
         }
      }

      $('#selectAllGames').on('click', function() {
         $('input[name="deleteGameIds[]"]').prop('checked', this.checked);
         toggleDeleteGamesButton();
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
      $(document).ready(function() {
         $('#paginationGameBar-WishBar .nav-link').on('click', function(e) {
            e.preventDefault();
            $('#paginationGameBar-WishBar .nav-link').removeClass('active');
            $(this).addClass('active');

            const sectionToShow = $(this).data('section');
            $('.game-section-wish').removeClass('active');
            $('#' + sectionToShow).addClass('active');
         });
      });
   });
</script>