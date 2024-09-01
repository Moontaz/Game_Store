<!-- Flash message display -->
<?php if (isset($_SESSION['flash'])) : ?>
<div class="alert alert-<?= $_SESSION['flash']['type']; ?> alert-dismissible fade show" role="alert">
   <?= $_SESSION['flash']['message']; ?>
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="form-container">
   <div class="form-card shadow mx-5">
      <img class="d-none d-md-block image-form" src="<?= BASEURL ?>/img/register.png" alt="Group Image">
      <div class="form-content d-flex flex-column justify-content-between">
         <h1 class="text-start text-dark fs-4" style="font-weight: 600;font-family: 'Poppins', sans-serif;">Create
            an
            Account</h1>
         <!-- <form action="<?= BASEURL ?>?url=User/register/Home/login" method="POST" class=""> -->
         <form id="registerForm" class="d-flex flex-column justify-content-between"
            action="<?= BASEURL ?>/?url=auth/register" method="post">
            <div class="col-12">
               <div class="input-group mb-2">
                  <span class="input-group-text col-3" id="inputGroup-sizing-default">Username</span>
                  <input type="text" class="form-control" id="username" name="username">
               </div>
               <div class="input-group mb-2">
                  <span class="input-group-text col-3" id="inputGroup-sizing-default">Email</span>
                  <input type="text" class="form-control" id="email" name="email">
               </div>
               <div class="input-group mb-2">
                  <span class="input-group-text col-3" id="inputGroup-sizing-default">Password</span>
                  <input type="password" class="form-control" id="password" name="password">
               </div>

               <div class="input-group mb-2">
                  <label class="input-group-text col-3" for="inputGroupSelect01">Role</label>
                  <select class="form-select" id="role" name="role">
                     <option value="customer" selected>Customer</option>
                     <option value="developer">Developer</option>
                     <option value="admin">Admin</option>
                  </select>
               </div>

               <div class="input-group mb-2" id="full_name_group">
                  <span class="input-group-text col-3" id="inputGroup-sizing-default">Full Name</span>
                  <input type="text" class="form-control col-9" id="full_name" name="full_name">
               </div>

               <div class="input-group mb-2" id="address_group">
                  <span class="input-group-text col-3" id="inputGroup-sizing-default">Country</span>
                  <select class="form-select col-9" id="country" name="country">
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
               </div>
               <div class="input-group mb-2" id="address_group">
                  <span class="input-group-text col-3" id="inputGroup-sizing-default">Province</span>
                  <select class="form-select col-9" id="province" name="address_id">
                     <option value="">Select Province</option>
                  </select>
               </div>


               <div class="input-group mb-2" id="company_name_group">
                  <span class="input-group-text col-5" id="inputGroup-sizing-default">Company Name</span>
                  <input type="text" class="form-control col-9" id="company_name" name="company_name">
               </div>
            </div>

            <div class="button-group mb-3 " id="register-button">
               <div class="button-group mb-3 col" id="button-group">
                  <button type="submit" class="btn btn-warning col-12"
                     onclick="return confirm('Are you sure you want to register?')">Register</button>
                  <div class="text-dark register-text ms-2">
                     By registering, you agree to Gaore's <a class="text-primary" href="#" target="_blank">Terms of
                        Service</a> and <a class="text-primary" href="#" target="_blank">Privacy
                        Policy</a>.</div>
               </div>
               <a class="text-primary" href="<?= BASEURL ?>/?url=auth/login">Already have an account?</a>
            </div>
         </form>
      </div>
   </div>
</div>

<style>
.form-container {
   position: relative;
   display: flex;
   justify-content: center;
   align-items: center;
   height: 100vh;
   overflow: hidden;
}

.form-container::before {
   content: "";
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: url('<?= BASEURL ?>/img/bg-signup.jpg') no-repeat center center;
   background-size: cover;
   opacity: 0.4;
   /* Adjust the opacity as needed */
   z-index: -1;
   /* Ensure the pseudo-element is behind the content */
}

#registerForm {
   height: 435px;
   width: 100%;
}

.form-card {
   display: flex;
   border-radius: 10px;
   overflow: hidden;
   max-width: 850px;
   width: 100%;
   background-color: #f8f9fa;
   color: white;
}

.form-card img {
   width: 50%;
   margin-left: -1px;
}

.form-content {
   padding: 20px;
   flex: 1;
}

.btn-custom {
   background-color: #ffc107;
   border-color: #ffc107;
}

.register-text {
   font-size: 0.72rem;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
   const roleSelect = document.getElementById('role');
   const fullNameGroup = document.getElementById('full_name_group');
   const addressGroup = document.getElementById('address_group');
   const companyNameGroup = document.getElementById('company_name_group');

   function updateForm() {
      const selectedRole = roleSelect.value;
      if (selectedRole === 'admin') {
         fullNameGroup.style.display = 'none';
         addressGroup.style.display = 'none';
         companyNameGroup.style.display = 'none';
      } else if (selectedRole === 'customer') {
         fullNameGroup.style.display = 'flex';
         addressGroup.style.display = 'flex';
         companyNameGroup.style.display = 'none';
      } else if (selectedRole === 'developer') {
         fullNameGroup.style.display = 'none';
         addressGroup.style.display = 'none';
         companyNameGroup.style.display = 'flex';
      }
   }

   // Initialize form display
   updateForm();

   // Listen for changes on the role select element
   roleSelect.addEventListener('change', updateForm);
});

$(document).ready(function() {
   var provinces = <?= json_encode($data['address']); ?>;

   $('#country').change(function() {
      var country = $(this).val();
      var options = '<option value="">Select Province</option>';
      const province = document.getElementById('province');

      $.each(provinces, function(index, value) {
         if (value['country'] === country) {
            options += '<option value="' + value['id'] + '">' + value['province'] + '</option>';
         }
      });

      $('#province').html(options);
   });
});
</script>
</script>