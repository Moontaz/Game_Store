<div class="container mt-5 " style="max-width: 1000px;" id="user_bar">
   <div class="container my-5">
      <ul class="nav nav-tabs" id="paginationBar">
         <li class="nav-item">
            <a class="nav-link " href="<?= BASEURL ?>/?url=Dashboard/index">Users</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="<?= BASEURL ?>/?url=Dashboard/index2">Games</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="<?= BASEURL ?>/?url=Dashboard/index3">Activity</a>
         </li>
         <li class="nav-item">
            <a class="nav-link active" href="<?= BASEURL ?>/?url=Dashboard/index4">Address</a>
         </li>
      </ul>
   </div>
</div>
<div class="container mt-5" style="max-width: 1000px;" id="user_bar">
   <div class="container my-5">
      <div class="container bg-light shadow p-3 rounded-1" style="max-width: 600px;" id="">
         <form id="addOrderForm" action="<?= BASEURL ?>/?url=User/addAddress" method="post">
            <div class="mb-3">
               <label for="addOrderCustomerId" class="form-label">Country</label>
               <input type="text" class="form-control" id="addCountry" name="country">
            </div>
            <div class="mb-3">
               <label for="addOrderTotal" class="form-label">Province</label>
               <input type="text" class="form-control" id="addProvince" name="province">
            </div>
            <input type="hidden" id="addOrderId" name="id">
            <div class="d-flex flex-column">
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
      <div class="section user-section active" id="address">
         <div class="container table-container mt-5 d-flex flex-column justify-content-between shadow"
            style="max-width: 1000px;">
            <table class="table table-hover table-bordered">
               <thead>
                  <tr class="text-center">
                     <th scope="col">#</th>
                     <th scope="col">ID</th>
                     <th scope="col">Country</th>
                     <th scope="col">Province</th>
                     <th scope="col">Actions</th>
                  </tr>
               </thead>
               <tbody id="addressTable">
                  <?php
                  $no = 1;
                  foreach ($data['address'] as $address) :
                  ?>
                  <tr>
                     <th class="text-center" scope="row"><?= $no; ?></th>
                     <?php $no += 1; ?>
                     <td><?= $address['id']; ?></td>
                     <td><?= $address['country']; ?></td>
                     <td><?= $address['province']; ?></td>
                     <td>
                        <button type="button" class="btn btn-warning btn-sm m-auto updateOrder" data-bs-toggle="modal"
                           data-bs-target="#updateOrderModal" data-id="<?= $address['id']; ?>"
                           data-country="<?= $address['country']; ?>" data-province="<?= $address['province']; ?>">
                           Change
                        </button>
                        <a href="<?= BASEURL ?>/?url=user/deleteAddress/<?= $address['id']; ?>/Dashboard/index4"
                           onclick="return confirm('Are you sure you want to delete this?')"
                           class="btn btn-danger btn-sm" aria-label="Delete">Delete</a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="modal-container">
   <!-- Modal Update Order -->
   <div class="modal" id="updateOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="updateOrderLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="updateOrderLabel">Update Address</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updateOrderForm" action="<?= BASEURL ?>/?url=User/updateAddress/Dashboard/index4"
                  method="post">
                  <div class="mb-3">
                     <label for="updateCountry" class="form-label">Country</label>
                     <input type="text" class="form-control" id="updateCountry" name="country">
                  </div>
                  <div class="mb-3">
                     <label for="updateProvince" class="form-label">Province</label>
                     <input type="text" class="form-control" id="updateProvince" name="province">
                  </div>
                  <input type="hidden" id="updateId" name="id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Modal Update Item -->
   <div class="modal" id="updateItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="updateItemLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="updateItemLabel">Update Item</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="updateItemForm" action="<?= BASEURL ?>/?url=User/updateItem/Dashboard/index3" method="post">
                  <div class="mb-3">
                     <label for="updateItemOrderId" class="form-label">Order ID</label>
                     <input type="text" class="form-control" id="updateItemOrderId" name="order_id">
                  </div>
                  <div class="mb-3">
                     <label for="updateItemGameId" class="form-label">Game ID</label>
                     <input type="text" class="form-control" id="updateItemGameId" name="game_id">
                  </div>
                  <div class="mb-3">
                     <label for="updateItemGameTitle" class="form-label">Game Title</label>
                     <input type="text" class="form-control" id="updateItemGameTitle" name="game_title" disabled>
                  </div>
                  <input type="hidden" id="updateItemId" name="id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Modal Add Order -->
   <div class="modal" id="addOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="addOrderLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="addOrderLabel">Add Order</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="addOrderForm" action="<?= BASEURL ?>/?url=User/addOrder/Dashboard/index3" method="post">
                  <div class="mb-3">
                     <label for="addOrderCustomerId" class="form-label">Customer ID</label>
                     <input type="text" class="form-control" id="addOrderCustomerId" name="customer_id">
                  </div>
                  <div class="mb-3">
                     <label for="addOrderTotal" class="form-label">Total</label>
                     <input type="text" class="form-control" id="addOrderTotal" name="total">
                  </div>
                  <input type="hidden" id="addOrderId" name="id">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Modal Add Item -->
   <div class="modal" id="addItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="addItemLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="addItemLabel">Add Item</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="addItemForm" action="<?= BASEURL ?>/?url=User/addItem/Dashboard/index3" method="post">
                  <div class="mb-3">
                     <label for="addItemOrderId" class="form-label">Order ID</label>
                     <input type="text" class="form-control" id="addItemOrderId" name="order_id">
                  </div>
                  <div class="mb-3">
                     <label for="addItemGameId" class="form-label">Game ID</label>
                     <input type="text" class="form-control" id="addItemGameId" name="game_id">
                  </div>
                  <div class="mb-3">
                     <label for="addItemGameTitle" class="form-label">Game Title</label>
                     <input type="text" class="form-control" id="addItemGameTitle" name="game_title" disabled>
                  </div>
                  <input type="hidden" id="addItemId" name="id">
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
   const ordersRows = $('#ordersTable tr');
   const ordersRowsCount = ordersRows.length;
   const pageCount = Math.ceil(ordersRowsCount / rowsPerPage);
   const pagination = $('#pagination');
   const deleteOrderButton = $('#deleteSelectedOrders');

   for (let i = 1; i <= pageCount; i++) {
      pagination.append(`<li class="page-item"><a class="page-link btn-sm" href="#">${i}</a></li>`);
   }

   ordersRows.hide();
   ordersRows.slice(0, rowsPerPage).show();
   pagination.find('li:first').addClass('active');

   pagination.find('li').on('click', function(e) {
      e.preventDefault();
      const pageIndex = $(this).index();
      pagination.find('li').removeClass('active');
      $(this).addClass('active');
      const start = pageIndex * rowsPerPage;
      const end = start + rowsPerPage;
      ordersRows.hide().slice(start, end).show();
   });

   const itemsRows = $('#itemsTable tr');
   const itemsPagination = $('#paginationItems');
   const deleteItemsButton = $('#deleteSelectedItems');

   for (let i = 1; i <= pageCount; i++) {
      itemsPagination.append(`<li class="page-item"><a class="page-link" href="#">${i}</a></li>`);
   }

   itemsRows.hide();
   itemsRows.slice(0, rowsPerPage).show();
   itemsPagination.find('li:first').addClass('active');

   itemsPagination.find('li').on('click', function(e) {
      e.preventDefault();
      const pageIndex = $(this).index();
      itemsPagination.find('li').removeClass('active');
      $(this).addClass('active');
      const start = pageIndex * rowsPerPage;
      const end = start + rowsPerPage;
      itemsRows.hide().slice(start, end).show();
   });

   $('.updateOrder').on('click', function() {
      const id = $(this).data('id');
      const country = $(this).data('country');
      const province = $(this).data('province');

      $('#updateId').val(id);
      $('#updateCountry').val(country);
      $('#updateProvince').val(province);
   });

   $('.updateItem').on('click', function() {
      const id = $(this).data('id');
      const order_id = $(this).data('order_id');
      const game_id = $(this).data('game_id');
      const game_title = $(this).data('game_title');

      $('#updateItemId').val(id);
      $('#updateItemOrderId').val(order_id);
      $('#updateItemGameId').val(game_id);
      $('#updateItemGameTitle').val(game_title);
   });

   $('#paginationUserBar .nav-link').on('click', function(e) {
      e.preventDefault();
      $('#paginationUserBar .nav-link').removeClass('active');
      $(this).addClass('active');

      const sectionToShow = $(this).data('section');
      $('.user-section').removeClass('active');
      $('#' + sectionToShow).addClass('active');
   });
});
</script>