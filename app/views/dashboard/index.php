<div class="container mt-5 " style="max-width: 1000px;" id="user_bar">
   <div class="container my-5">
      <ul class="nav nav-tabs" id="paginationBar">
         <li class="nav-item">
            <a class="nav-link active" href="<?= BASEURL ?>/?url=Dashboard/index">Users</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="<?= BASEURL ?>/?url=Dashboard/index2">Games</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="<?= BASEURL ?>/?url=Dashboard/index3">Activity</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="<?= BASEURL ?>/?url=Dashboard/index4">Address</a>
         </li>
      </ul>
   </div>
</div>
<div class="container mt-5 " style="max-width: 1000px;" id="user_bar">
   <div class="container my-5">
      <ul class="nav nav-tabs" id="paginationUserBar">
         <li class="nav-item">
            <a class="nav-link active" href="#" data-section="users">Users</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#" data-section="developers">Developers</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#" data-section="customers">Customers</a>
         </li>
      </ul>

      <div class="section user-section active" id="users">
         <form id="multiDeleteForm" action="<?= BASEURL ?>/?url=User/deleteDev/Dashboard/index" method="post">
            <div class="container table-container  mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
               <table class="table table-hover table-bordered">
                  <thead>
                     <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                     </tr>
                  </thead>

                  <tbody id="userTable">
                     <?php
                     $no = 1;
                     foreach ($data['users'] as $user) :
                     ?>
                        <tr>
                           <th class="text-center" scope="row"><?= $no; ?></th>
                           <?php $no += 1; ?>
                           <td><?= $user['id']; ?></td>
                           <td><?= $user['username']; ?></td>
                           <td><?= $user['email']; ?></td>
                           <td><?= $user['password']; ?></td>
                           <td><?= $user['role']; ?></td>
                           <td><?= $user['created_at']; ?></td>
                           <td>
                              <a href="<?= BASEURL ?>?url=user/deleteUser/<?= $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                           </td>
                        </tr>
                     <?php
                     endforeach;
                     ?>
                  </tbody>
               </table>

               <!-- Pagination -->
               <nav class="d-flex justify-content-between">
                  <div class="container">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary btn-sm m-auto" data-bs-toggle="modal" data-bs-target="#addDevModal" disabled>
                        Add Data
                     </button>
                     <button type="submit" class="btn btn-danger btn-sm m-auto disabled" id="deleteSelected">
                        Delete
                     </button>
                  </div>
                  <ul class="pagination justify-content-center" id="paginationUsers">
                     <!-- Pagination items will be dynamically generated here -->
                  </ul>
               </nav>
            </div>
         </form>
         <div class="container" style="height:1px;">
         </div>
      </div>


      <div class="section user-section active" id="developers">
         <form id="multiDeleteForm" action="<?= BASEURL ?>/?url=User/deleteDev/Dashboard/index" method="post">
            <div class="container table-container  mt-5 d-flex flex-column justify-content-between shadow" style="max-width: 1000px;">
               <table class="table table-hover table-bordered">
                  <thead>
                     <tr class="text-center">
                        <th scope="col"><input type="checkbox" id="selectAll"></th>
                        <th scope="col">#</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Dev ID</th>
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
                                    <td><?= $users['id']; ?></td>
                                    <td><?= $devs['id']; ?></td>
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
                     <button type="button" class="btn btn-primary btn-sm m-auto" data-bs-toggle="modal" data-bs-target="#addDevModal">
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
                        <th scope="col">User ID</th>
                        <th scope="col">Cust ID</th>
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
                                 foreach ($data['address'] as $address) :
                                    if ($address['id'] == $custs['id_address']) {
                     ?>
                                       <tr>
                                          <td class="text-center"><input type="checkbox" name="deleteIdsCust[]" value="<?= $users['id']; ?>">
                                          </td>
                                          <th class="text-center" scope="row"><?= $no; ?></th>
                                          <?php $no += 1; ?>
                                          <td><?= $users['id']; ?></td>
                                          <td><?= $custs['id']; ?></td>
                                          <td><?= $users['username']; ?></td>
                                          <td><?= $custs['full_name']; ?></td>
                                          <td><?= $users['email']; ?></td>
                                          <td><?= $address['country']; ?>, <?= $address['province']; ?></td>
                                          <td>
                                             <button type="button" class="btn btn-primary btn-sm" aria-label="Details">Details</button>
                                             <button type="button" class="btn btn-warning btn-sm m-auto updateCustomer" data-bs-toggle="modal" data-bs-target="#updateCustomerData" data-id="<?= $users['id']; ?>" data-username="<?= $users['username']; ?>" data-email="<?= $users['email']; ?>" data-full_name="<?= $custs['full_name']; ?>" data-country="<?= $address['country']; ?>" data-province="<?= $address['id']; ?>" data-password="<?= $users['password']; ?>">
                                                Change
                                             </button>
                                          </td>
                                       </tr>
                     <?php
                                       break;
                                    }
                                 endforeach;
                                 break;
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
                     <input type="text" class="form-control" id="updateCompanyName" name="company_name" required>
                  </div>
                  <div class="mb-3">
                     <label for="updateUsername" class="form-label">Username</label>
                     <input type="text" class="form-control" id="updateUsername" name="username" required>
                  </div>
                  <div class="mb-3">
                     <label for="updateEmail" class="form-label">Company Email</label>
                     <input type="email" class="form-control" id="updateEmail" name="email" required>
                     <div id="emailHelp" class="form-text">Max 50 characters long.</div>
                  </div>
                  <div class="mb-3">
                     <label for="updatePassword" class="form-label">Password</label>
                     <input type="password" class="form-control" id="updatePassword" name="password" required>
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" class="form-control" id="updateRole" name="role" value="developer" required>
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
                     <input type="text" class="form-control" id="updateFullNameCust" name="full_name" required>
                  </div>
                  <div class="mb-3">
                     <label for="updateUsername" class="form-label">Username</label>
                     <input type="text" class="form-control" id="updateUsernameCust" name="username" required>
                  </div>
                  <div class="mb-3">
                     <label for="updateEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="updateEmailCust" name="email" required>
                  </div>
                  <div class="mb-3">
                     <label for="addAddress" class="form-label">Address</label>
                     <div class="input-group mb-2" id="address_group">
                        <select class="form-select col-9" id="updateCountryCust" name="country" required>
                           <option value="">Select Country</option>
                           <?php
                           $displayedCountries = [];
                           foreach ($data['address'] as $address) :
                              if (!in_array($address['country'], $displayedCountries)) :
                                 $displayedCountries[] = $address['country'];
                           ?>
                                 <option value="<?= $address['country'] ?>"><?= $address['country'] ?></option>
                           <?php
                              endif;
                           endforeach;
                           ?>
                        </select>
                        <select class="form-select col-9" id="updateProvinceCust" name="address_id" required>
                           <option value="">Select Province</option>
                        </select>
                     </div>

                     <div class="mb-3">
                        <label for="updatePassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="updatePasswordCust" name="password" required>
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
   </div>


   <!-- Modal Add Data Developer -->
   <div class="modal" id="addDevModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                     <input type="text" class="form-control" id="company_name" name="company_name" required>
                  </div>
                  <div class="mb-3">
                     <label for="username" class="form-label">Username</label>
                     <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Company Email</label>
                     <input type="email" class="form-control" id="email" name="email" required>
                     <div id="emailHelp" class="form-text">Max 50 characters long.</div>
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" class="form-control" id="password" name="password" required>
                     <div id="passHelp" class="form-text">Must be 8-20 characters long.</div>
                  </div>
                  <input type="hidden" class="form-control" id="role" name="role" value="developer" required>
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
               <form id="addCustomerForm" action="<?= BASEURL ?>/?url=User/addCust" method="post">
                  <div class="mb-3">
                     <label for="addFullName" class="form-label">Full Name</label>
                     <input type="text" class="form-control" id="addFullName" name="full_name" required>
                  </div>
                  <div class="mb-3">
                     <label for="addUsername" class="form-label">Username</label>
                     <input type="text" class="form-control" id="addUsername" name="username" required>
                  </div>
                  <div class="mb-3">
                     <label for="addEmail" class="form-label">Email</label>
                     <input type="email" class="form-control" id="addEmail" name="email" required>
                  </div>
                  <div class="mb-3">
                     <label for="addAddress" class="form-label">Address</label>
                     <div class="input-group mb-2" id="address_group">
                        <select class="form-select col-9" id="country2" name="country" required>
                           <option value="">Select Country</option>
                           <?php
                           $displayedCountries = [];
                           foreach ($data['address'] as $address) :
                              if (!in_array($address['country'], $displayedCountries)) :
                                 $displayedCountries[] = $address['country'];
                           ?>
                                 <option value="<?= $address['country'] ?>"><?= $address['country'] ?></option>
                           <?php
                              endif;
                           endforeach;
                           ?>
                        </select>
                        <select class="form-select col-9" id="province2" name="address_id" required>
                           <option value="">Select Province</option>
                        </select>
                     </div>

                     <div class="mb-3">
                        <label for="updatePassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="updatePassword" name="password" required>
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
      // Pagination for Users Table
      function setupPagination(tableId, paginationId, rowsPerPage) {
         const rows = $(`#${tableId} tr`);
         const rowsCount = rows.length;
         const pageCount = Math.ceil(rowsCount / rowsPerPage);
         const pagination = $(`#${paginationId}`);

         function showPage(page) {
            rows.hide();
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            rows.slice(start, end).show();
         }

         showPage(1);

         for (let i = 1; i <= pageCount; i++) {
            pagination.append(`<li class="page-item"><a class="page-link btn-sm" href="#">${i}</a></li>`);
         }

         pagination.find('li:first').addClass('active');

         pagination.on('click', 'li', function(e) {
            e.preventDefault();
            const pageIndex = $(this).index() + 1;
            pagination.find('li').removeClass('active');
            $(this).addClass('active');
            showPage(pageIndex);
         });
      }

      setupPagination('developerTable', 'pagination', 5);
      setupPagination('customerTable', 'paginationCustomers', 5);
      setupPagination('userTable', 'paginationUsers', 5);

      // Toggle Delete Button State
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

      // Update Developer Modal
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

      // Update Customer Modal
      $('.updateCustomer').on('click', function() {
         const id = $(this).data('id');
         const full_name = $(this).data('full_name');
         const username = $(this).data('username');
         const email = $(this).data('email');
         const country = $(this).data('country');
         const province = $(this).data('province');
         const password = $(this).data('password');

         $('#updateUserIdCust').val(id);
         $('#updateUsernameCust').val(username);
         $('#updateEmailCust').val(email);
         $('#updateCountryCust').val(country);
         $('#updateFullNameCust').val(full_name);
         $('#updatePasswordCust').val(password);

         populateProvinces(country);

         $('#updateProvinceCust').val(province);
      });

      // Populate Provinces based on Country
      function populateProvinces(country) {
         var options = '<option value="">Select Province</option>';

         $.each(provinces, function(index, value) {
            if (value['country'] === country) {
               options += '<option value="' + value['id'] + '">' + value['province'] + '</option>';
            }
         });

         $('#updateProvinceCust').html(options);
      }

      $('#updateCountryCust').change(function() {
         var country = $(this).val();
         populateProvinces(country);
      });

      $('#paginationUserBar .nav-link').on('click', function(e) {
         e.preventDefault();
         $('#paginationUserBar .nav-link').removeClass('active');
         $(this).addClass('active');

         const sectionToShow = $(this).data('section');
         $('.user-section').removeClass('active');
         $('#' + sectionToShow).addClass('active');
      });

      var provinces = <?= json_encode($data['address']); ?>;

      $('#country2').change(function() {
         var country = $(this).val();
         var options = '<option value="">Select Province</option>';

         $.each(provinces, function(index, value) {
            if (value['country'] === country) {
               options += '<option value="' + value['id'] + '">' + value['province'] + '</option>';
            }
         });

         $('#province2').html(options);
      });
   });
</script>