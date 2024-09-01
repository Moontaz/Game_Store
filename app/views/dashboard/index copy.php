<div class="container mt-5 " style="max-width: 1000px;" id="user_bar">
   <div class="container my-5">
      <ul class="nav nav-tabs" id="paginationBar">
         <li class="nav-item">
            <a class="nav-link active" href="<?= BASEURL ?>/?url=Dashboard/index">Users</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="<?= BASEURL ?>/?url=Dashboard/index2">Games</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="<?= BASEURL ?>/?url=Dashboard/index3">Activity</a>
         </li>
      </ul>
   </div>
</div>

<div class="container mt-5 " style="max-width: 1000px;" id="user_bar">
   <div class="container my-5">
      <ul class="nav nav-tabs" id="paginationUserBar">
         <li class="nav-item">
            <a class="nav-link active" href="#" data-section="developers">Developers</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#" data-section="customers">Customers</a>
         </li>
      </ul>

      <div class="section user-section active" id="developers">
         <form id="multiDeleteForm" action="<?= BASEURL ?>/?url=User/deleteDev/Dashboard/index" method="post">
            <div class="container table-container  mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
               <table class="table table-hover table-bordered">
                  <thead>
                     <tr class="text-center">
                        <th scope="col"><input type="checkbox" id="selectAll"></th>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Actions</th>
                     </tr>
                  </thead>
                  <tbody id="developerTable">
                     <?php
                     $no = 1;
                     foreach ($data['users'] as $users) :
                        if ($users['role'] == 'developer') {
                           foreach ($data['devs'] as $devs) :
                              if ($users['id'] == $devs['user_id']) {
                                 $userId = $users['id'];
                     ?>
                                 <tr>
                                    <td class="text-center"><input type="checkbox" name="deleteIds[]" value="<?= $users['id']; ?>">
                                    </td>
                                    <th class="text-center" scope="row"><?= $no; ?></th>
                                    <?php $no += 1; ?>
                                    <td><?= $users['username']; ?></td>
                                    <td><?= $users['email']; ?></td>
                                    <td><?= $devs['company_name']; ?></td>
                                    <td>
                                       <button type="button" class="btn btn-primary btn-sm" aria-label="Details">Details</button>
                                       <button type="button" class="btn btn-warning btn-sm m-auto updateDev" data-bs-toggle="modal" data-bs-target="#updateDataDev" data-id="<?= $users['id']; ?>" data-username="<?= $users['username']; ?>" data-email="<?= $users['email']; ?>" data-company_name="<?= $devs['company_name']; ?>" data-password="<?= $users['password']; ?>">
                                          Change
                                       </button>
                                    </td>
                                 </tr>
                     <?php
                              }
                           endforeach;
                        }
                     endforeach;
                     ?>
                  </tbody>
               </table>

               <!-- Pagination -->
               <nav class="d-flex justify-content-between">
                  <div class="container">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary btn-sm m-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add Data
                     </button>
                     <button type="submit" class="btn btn-danger btn-sm m-auto disabled" id="deleteSelected">
                        Delete
                     </button>
                  </div>
                  <ul class="pagination justify-content-center" id="pagination">
                     <!-- Pagination items will be dynamically generated here -->
                  </ul>
               </nav>
            </div>
         </form>
         <div class="container" style="height:1px;">
         </div>
      </div>
      <div class="section user-section" id="customers">
         <form id="multiDeleteFormCustomer" action="<?= BASEURL ?>/?url=User/deleteCust/Dashboard/index" method="post">
            <div class="container table-container mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
               <table class="table table-hover table-bordered">
                  <thead>
                     <tr class="text-center">
                        <th scope="col"><input type="checkbox" id="selectAllCustomers"></th>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Actions</th>
                     </tr>
                  </thead>
                  <tbody id="customerTable">
                     <?php
                     $no = 1;
                     foreach ($data['users'] as $users) :
                        if ($users['role'] == 'customer') {
                           foreach ($data['custs'] as $custs) :
                              if ($users['id'] == $custs['user_id']) {
                     ?>
                                 <tr>
                                    <td class="text-center"><input type="checkbox" name="deleteIdsCust[]" value="<?= $users['id']; ?>">
                                    </td>
                                    <th class="text-center" scope="row"><?= $no; ?></th>
                                    <?php $no += 1; ?>
                                    <td><?= $users['username']; ?></td>
                                    <td><?= $custs['full_name']; ?></td>
                                    <td><?= $users['email']; ?></td>
                                    <td><?= $custs['address']; ?></td>
                                    <td>
                                       <button type="button" class="btn btn-primary btn-sm" aria-label="Details">Details</button>
                                       <button type="button" class="btn btn-warning btn-sm m-auto updateCustomer" data-bs-toggle="modal" data-bs-target="#updateCustomerData" data-id="<?= $users['id']; ?>" data-username="<?= $users['username']; ?>" data-email="<?= $users['email']; ?>" data-full_name="<?= $custs['full_name']; ?>" data-address="<?= $custs['address']; ?>" data-password="<?= $users['password']; ?>">
                                          Change
                                       </button>
                                    </td>
                                 </tr>
                     <?php
                              }
                           endforeach;
                        }
                     endforeach;
                     ?>
                  </tbody>
               </table>

               <!-- Pagination -->
               <nav class="d-flex justify-content-between">
                  <div class="container">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary btn-sm m-auto" data-bs-toggle="modal" data-bs-target="#addCustomerData">
                        Add Data
                     </button>
                     <button type="submit" class="btn btn-danger btn-sm m-auto disabled" id="deleteSelectedCustomers">
                        Delete
                     </button>
                  </div>
                  <ul class="pagination justify-content-center" id="paginationCustomers">
                     <!-- Pagination items will be dynamically generated here -->
                  </ul>
               </nav>
            </div>
         </form>
      </div>
   </div>
</div>

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
      </ul>

      <div class="section game-section active" id="games">
         <form class="mb-5" id="multiDeleteGamesForm" action="<?= BASEURL ?>/?url=Game/deleteGames/Dashboard/index#game" method="post">
            <button type="submit" class="btn btn-danger btn-sm ms-4 my-3 disabled" id="deleteSelectedGames">
               Delete
            </button>
            <div class="accordion overflow-auto" id="gamesAccordion" style="max-height: 400px;">
               <?php
               foreach ($data['games'] as $game) :
                  $developer = null;
                  foreach ($data['devs'] as $devs) :
                     if ($devs['id'] == $game['developer_id']) {
                        $developer = $devs;
                        break; // Exit the loop after finding the matching developer
                     }
                  endforeach;
                  if ($developer) : // Ensure $developer is not null before displaying data
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
                                 <p><strong>Developer:</strong> <?= $devs['company_name']; ?></p>
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
                  endif;
               endforeach;
               ?>
            </div>
         </form>
         <div class="container" style="height:1px;">
         </div>
      </div>
      <div class="section game-section" id="wishlists">
         <div class="container my-2">
            <ul class="nav nav-tabs" id="paginationGameBar-WishBar">
               <li class="nav-item">
                  <a class="nav-link active" href="#" data-section="history">History</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#" data-section="dataPerGame">Data per Game</a>
               </li>
            </ul>

            <div class="section game-section-wish active" id="history">
               <form id="multiDeleteFormWish" action="<?= BASEURL ?>/?url=Game/deleteWishs/Dashboard/index" method="post">
                  <div class="container table-container mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
                     <table class="table table-hover table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th scope="col" class="col-1">
                                 <input type="checkbox" id="selectAllWishs" class="me-1"> #
                              </th>
                              <th scope="col" class="col-2">Customer</th>
                              <th scope="col" class="col-4">Game</th>
                              <th scope="col" class="col-3">Time</th>
                              <th scope="col" class="col-2">Details</th>
                           </tr>
                        </thead>
                     </table>
                     <div class="overflow-auto" style="max-height: 400px;width:911px;">
                        <table class="table table-hover table-bordered">
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
                                 foreach ($data['games'] as $data_game) :
                                    if ($data_game['id'] == $wish['game_id']) {
                                       $game = $data_game;
                                       break; // Exit the loop after finding the matching developer
                                    }
                                 endforeach;
                                 if ($game != null && $customer != null) : // Ensure $developer is not null before displaying data
                              ?>
                                    <tr>
                                       <th class="text-center" scope="row" class="col-1">
                                          <input type="checkbox" name="deleteIdsWish[]" value="<?= $wish['id']; ?>" class="me-1">
                                          <?= $no; ?>
                                       </th>
                                       <?php $no += 1; ?>
                                       <td class="col-2"><?= $customer['full_name']; ?></td>
                                       <td class="col-4"><?= $game['title']; ?></td>
                                       <td class="col-3"><?= $wish['created_at']; ?></td>
                                       <td class="col-2">
                                          <button type="button" class="btn btn-warning btn-sm m-auto updateWish" data-bs-toggle="modal" data-bs-target="#updateWishData" data-id="<?= $wish['id']; ?>" data-cust_id="<?= $cust['id']; ?>" data-game_id="<?= $game['id']; ?>">
                                             Change
                                          </button>
                                       </td>
                                    </tr>
                              <?php
                                 endif;
                              endforeach;
                              ?>
                           </tbody>
                        </table>
                     </div>

                     <!-- Pagination -->
                     <nav class="d-flex justify-content-between mt-3">
                        <div class="container">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn btn-primary btn-sm m-auto disabled" data-bs-toggle="modal" data-bs-target="#addCustomerData">
                              Add Data
                           </button>
                           <button type="submit" class="btn btn-danger btn-sm m-auto disabled" id="deleteSelectedWishs">
                              Delete
                           </button>
                        </div>
                     </nav>
                  </div>
               </form>

               <div class="container" style="height:1px;">
               </div>
            </div>
            <div class="section game-section-wish" id="dataPerGame">
               <form id="multiDeleteFormCustomer" action="<?= BASEURL ?>/?url=User/deleteCust/Dashboard/index" method="post">
                  <div class="container table-container mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
                     <table class="table table-hover table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th scope="col"><input type="checkbox" id="selectAllCustomers"></th>
                              <th scope="col">#</th>
                              <th scope="col">Username</th>
                              <th scope="col">Full Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Address</th>
                              <th scope="col">Actions</th>
                           </tr>
                        </thead>
                        <tbody id="customerTable">
                           <?php
                           $no = 1;
                           foreach ($data['users'] as $users) :
                              if ($users['role'] == 'customer') {
                                 foreach ($data['custs'] as $custs) :
                                    if ($users['id'] == $custs['user_id']) {
                           ?>
                                       <tr>
                                          <td class="text-center"><input type="checkbox" name="deleteIdsCust[]" value="<?= $users['id']; ?>">
                                          </td>
                                          <th class="text-center" scope="row"><?= $no; ?></th>
                                          <?php $no += 1; ?>
                                          <td><?= $users['username']; ?></td>
                                          <td><?= $custs['full_name']; ?></td>
                                          <td><?= $users['email']; ?></td>
                                          <td><?= $custs['address']; ?></td>
                                          <td>
                                             <button type="button" class="btn btn-primary btn-sm" aria-label="Details">Details</button>
                                             <button type="button" class="btn btn-warning btn-sm m-auto updateBtn" data-bs-toggle="modal" data-bs-target="#updateCustomerData" data-id="<?= $users['id']; ?>" data-username="<?= $users['username']; ?>" data-email="<?= $users['email']; ?>" data-full_name="<?= $custs['full_name']; ?>" data-address="<?= $custs['address']; ?>">
                                                Change
                                             </button>
                                          </td>
                                       </tr>
                           <?php
                                    }
                                 endforeach;
                              }
                           endforeach;
                           ?>
                        </tbody>
                     </table>

                     <!-- Pagination -->
                     <nav class="d-flex justify-content-between">
                        <div class="container">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn btn-primary btn-sm m-auto" data-bs-toggle="modal" data-bs-target="#addCustomerData">
                              Add Data
                           </button>
                           <button type="submit" class="btn btn-danger btn-sm m-auto disabled" id="deleteSelectedCustomers">
                              Delete
                           </button>
                        </div>
                        <ul class="pagination justify-content-center" id="paginationCustomers">
                           <!-- Pagination items will be dynamically generated here -->
                        </ul>
                     </nav>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="section game-section" id="reviews">
         <div class="container table-container mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
            <table class="table table-hover table-bordered">
               <thead>
                  <tr class="text-center">
                     <th scope="col" class="col-1">#</th>
                     <th scope="col" class="col-2">Customer</th>
                     <th scope="col" class="col-4">Game</th>
                     <th scope="col" class="col-1">Rate</th>
                     <th scope="col" class="col-3">Time</th>
                     <th scope="col" class="col-1">Actions</th>
                  </tr>
               </thead>
            </table>
            <div class="overflow-auto" style="max-height: 400px;width:936px;">
               <table class="table table-hover table-bordered">
                  <tbody id="wishTable">
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
                        foreach ($data['games'] as $data_game) :
                           if ($review['game_id'] == $data_game['id']) {
                              $game = $data_game;
                              break; // Exit the loop after finding the matching developer
                           }
                        endforeach;
                        if ($game != null && $customer != null) : // Ensure $developer is not null before displaying data
                     ?>
                           <tr>
                              <th class="text-center" scope="row" class="col-1"><?= $no; ?></th>
                              <?php $no += 1; ?>
                              <td class="col-2"><?= $user['username']; ?></td>
                              <td class="col-4"><?= $game['title']; ?></td>
                              <td class="col-1"><?= $review['rating']; ?></td>
                              <td class="col-3 fst-italic"><?= $review['created_at']; ?></td>
                              <td class="col-1">
                                 <a href="<?= BASEURL ?>/?url=Game/deleteReviews/Dashboard/index&reviewId=<?= $review['id'] ?>" class="btn btn-danger btn-sm m-auto" onclick="return confirm('Are you sure you want to delete this review?')">
                                    Delete
                                 </a>
                              </td>
                           </tr>
                     <?php
                        endif;
                     endforeach;
                     ?>
                  </tbody>
               </table>
            </div>

         </div>
         <div class="container" style="height:1px;">
         </div>
      </div>
   </div>
</div>

<div class="modal-container">
   <!-- Modal Update Data Developer -->
   <div class="modal" id="updateDataDev" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="updateDataLabel">Update Data Developer</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updateForm" action="<?= BASEURL ?>/?url=User/updateDev/Dashboard/index" method="post">
                  <div class="mb-3">
                     <label for="updateCompanyName" class="form-label">Company Name</label>
                     <input type="text" class="form-control" id="updateCompanyName" name="company_name">
                  </div>
                  <div class="mb-3">
                     <label for="updateUsername" class="form-label">Username</label>
                     <input type="text" class="form-control" id="updateUsername" name="username">
                  </div>
                  <div class="mb-3">
                     <label for="updateEmail" class="form-label">Company Email</label>
                     <input type="email" class="form-control" id="updateEmail" name="email">
                     <div id="emailHelp" class="form-text">Max 50 characters long.</div>
                  </div>
                  <div class="mb-3">
                     <label for="updatePassword" class="form-label">Password</label>
                     <input type="password" class="form-control" id="updatePassword" name="password">
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" class="form-control" id="updateRole" name="role" value="developer">
                  <input type="hidden" id="updateUserId" name="id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Modal Update Customer Data -->
   <div class="modal" id="updateCustomerData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCustomerDataLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="updateCustomerDataLabel">Update Customer Data</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updateCustomerForm" action="<?= BASEURL ?>/?url=User/updateCust/Dashboard/index" method="post">
                  <div class="mb-3">
                     <label for="updateFullName" class="form-label">Full Name</label>
                     <input type="text" class="form-control" id="updateFullNameCust" name="full_name">
                  </div>
                  <div class="mb-3">
                     <label for="updateUsername" class="form-label">Username</label>
                     <input type="text" class="form-control" id="updateUsernameCust" name="username">
                  </div>
                  <div class="mb-3">
                     <label for="updateEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="updateEmailCust" name="email">
                  </div>
                  <div class="mb-3">
                     <label for="updateAddress" class="form-label">Address</label>
                     <input type="text" class="form-control" id="updateAddressCust" name="address">
                  </div>
                  <div class="mb-3">
                     <label for="updatePassword" class="form-label">Password</label>
                     <input type="password" class="form-control" id="updatePasswordCust" name="password">
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" id="updateUserIdCust" name="user_id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
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

   <!-- Modal Update Data Wishlist -->
   <div class="modal" id="updateWishData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="updateDataLabel">Update Data Wishlist</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updateForm" action="<?= BASEURL ?>/?url=Game/updateWish/Dashboard/index" method="post">
                  <div class="mb-3">
                     <label for="updateCustId" class="form-label">Customer ID</label>
                     <input type="text" class="form-control" id="updateCustId" name="custId">
                  </div>
                  <div class="mb-3">
                     <label for="updateGameId" class="form-label">Game ID</label>
                     <input type="text" class="form-control" id="updateWishGameId" name="gameId">
                  </div>
                  <input type="hidden" id="updateWishId" name="id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>


   <!-- Modal Add Data Developer -->
   <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Developer</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="<?= BASEURL ?>/?url=User/addDev/Dashboard/index" method="post">
                  <div class="mb-3">
                     <label for="company_name" class="form-label">Company Name</label>
                     <input type="text" class="form-control" id="company_name" name="company_name">
                  </div>
                  <div class="mb-3">
                     <label for="username" class="form-label">Username</label>
                     <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Company Email</label>
                     <input type="email" class="form-control" id="email" name="email">
                     <div id="emailHelp" class="form-text">Max 50 characters long.</div>
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" class="form-control" id="password" name="password">
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" class="form-control" id="role" name="role" value="developer">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Modal Add Customer Data -->
   <div class="modal" id="addCustomerData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCustomerDataLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="addCustomerDataLabel">Add Customer Data</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="addCustomerForm" action="<?= BASEURL ?>/?url=User/addCust/Dashboard/index2" method="post">
                  <div class="mb-3">
                     <label for="addFullName" class="form-label">Full Name</label>
                     <input type="text" class="form-control" id="addFullName" name="full_name">
                  </div>
                  <div class="mb-3">
                     <label for="addUsername" class="form-label">Username</label>
                     <input type="text" class="form-control" id="addUsername" name="username">
                  </div>
                  <div class="mb-3">
                     <label for="addEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="addEmail" name="email">
                  </div>
                  <div class="mb-3">
                     <label for="addAddress" class="form-label">Address</label>
                     <input type="text" class="form-control" id="addAddress" name="address">
                  </div>

                  <div class="mb-3">
                     <label for="updatePassword" class="form-label">Password</label>
                     <input type="password" class="form-control" id="updatePassword" name="password">
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" name="role" value="customer">
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

      const rowsCust = $('#customerTable tr');
      const paginationCust = $('#paginationCustomers');
      const deleteButtonCust = $('#deleteSelectedCustomers');

      for (let i = 1; i <= pageCount; i++) {
         paginationCust.append(`<li class="page-item"><a class="page-link" href="#">${i}</a></li>`);
      }

      rowsCust.hide();
      rowsCust.slice(0, rowsPerPage).show();
      paginationCust.find('li:first').addClass('active');

      paginationCust.find('li').on('click', function(e) {
         e.preventDefault();
         const pageIndex = $(this).index();
         paginationCust.find('li').removeClass('active');
         $(this).addClass('active');
         const start = pageIndex * rowsPerPage;
         const end = start + rowsPerPage;
         rowsCust.hide().slice(start, end).show();
      });

      // const rowsWishs = $('#wishTable tr');
      // const paginationWishs = $('#paginationWishs');
      // const deleteButtonWishs = $('#deleteSelectedWishs');

      // for (let i = 1; i <= pageCount; i++) {
      //    paginationWishs.append(`<li class="page-item"><a class="page-link" href="#">${i}</a></li>`);
      // }

      // rowsWishs.hide();
      // rowsWishs.slice(0, rowsPerPage).show();
      // paginationWishs.find('li:first').addClass('active');

      // paginationWishs.find('li').on('click', function(e) {
      //    e.preventDefault();
      //    const pageIndex = $(this).index();
      //    paginationWishs.find('li').removeClass('active');
      //    $(this).addClass('active');
      //    const start = pageIndex * rowsPerPage;
      //    const end = start + rowsPerPage;
      //    rowsWishs.hide().slice(start, end).show();
      // });

      function toggleDeleteButton(selector, button) {
         if ($(selector + ':checked').length > 0) {
            button.removeClass('disabled');
         } else {
            button.addClass('disabled');
         }
      }

      $('#selectAll').on('click', function() {
         $('input[name="deleteIds[]"]').prop('checked', this.checked);
         toggleDeleteButton('input[name="deleteIds[]"]', $('#deleteSelected'));
      });

      $('#selectAllCustomers').on('click', function() {
         $('input[name="deleteIdsCust[]"]').prop('checked', this.checked);
         toggleDeleteButton('input[name="deleteIdsCust[]"]', $('#deleteSelectedCustomers'));
      });
      $('#selectAllWishs').on('click', function() {
         $('input[name="deleteIdsWish[]"]').prop('checked', this.checked);
         toggleDeleteButton('input[name="deleteIdsWish[]"]', $('#deleteSelectedWishs'));
      });

      $('input[name="deleteIds[]"]').on('click', function() {
         const allChecked = $('input[name="deleteIds[]"]').length === $('input[name="deleteIds[]"]:checked')
            .length;
         $('#selectAll').prop('checked', allChecked);
         toggleDeleteButton('input[name="deleteIds[]"]', $('#deleteSelected'));
      });

      $('input[name="deleteIdsCust[]"]').on('click', function() {
         const allChecked = $('input[name="deleteIdsCust[]"]').length === $(
            'input[name="deleteIdsCust[]"]:checked').length;
         $('#selectAllCustomers').prop('checked', allChecked);
         toggleDeleteButton('input[name="deleteIdsCust[]"]', $('#deleteSelectedCustomers'));
      });
      $('input[name="deleteIdsWish[]"]').on('click', function() {
         const allChecked = $('input[name="deleteIdsWish[]"]').length === $(
            'input[name="deleteIdsWish[]"]:checked').length;
         $('#selectAllWishs').prop('checked', allChecked);
         toggleDeleteButton('input[name="deleteIdsWish[]"]', $('#deleteSelectedWishs'));
      });


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
      $('.updateCustomer').on('click', function() {
         const id = $(this).data('id');
         const full_name = $(this).data('full_name');
         const username = $(this).data('username');
         const email = $(this).data('email');
         const address = $(this).data('address');
         const password = $(this).data('password');

         $('#updateUserIdCust').val(id);
         $('#updateUsernameCust').val(username);
         $('#updateEmailCust').val(email);
         $('#updateAddressCust').val(address);
         $('#updateFullNameCust').val(full_name);
         $('#updatePasswordCust').val(password);
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
         $('#paginationUserBar .nav-link').on('click', function(e) {
            e.preventDefault();
            $('#paginationUserBar .nav-link').removeClass('active');
            $(this).addClass('active');

            const sectionToShow = $(this).data('section');
            $('.user-section').removeClass('active');
            $('#' + sectionToShow).addClass('active');
         });
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