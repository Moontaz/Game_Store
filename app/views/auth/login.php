<!-- Flash message display -->
<?php if (isset($_SESSION['flash'])) : ?>
   <div class="alert alert-<?= $_SESSION['flash']['type']; ?> alert-dismissible fade show" role="alert" style="position:absolute;width:95vw; left:2.5vw;">
      <?= $_SESSION['flash']['message']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   <?php
   unset($_SESSION['flash']);
   ?>
<?php endif; ?>

<div class="form-container">
   <div class="form-card shadow mx-5">
      <img class="d-none d-md-block image-form" src="<?= BASEURL ?>/img/register.png" alt="Group Image">
      <div class="form-content d-flex flex-column my-auto mx-0">
         <div class="d-flex flex-column align-items-center">
            <h4 class="text-start mb-1 text-dark">Welcome back!</h4>
            <h6 class="text-start mb-4 text-dark">We're so excited to see you again.</h6>
         </div>
         <!-- <form action="<?= BASEURL ?>?url=User/register/Home/login" method="POST" class=""> -->
         <form id="registerForm" class="" action="<?= BASEURL ?>/?url=auth/login" method="post">

            <div class="input-group mb-3">
               <span class="input-group-text col-3" id="inputGroup-sizing-default">Username</span>
               <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="input-group mb-3">
               <span class="input-group-text col-3" id="inputGroup-sizing-default">Password</span>
               <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="button-group mb-3 col" id="register-button">
               <button type="submit" class="btn btn-warning col-12">Log in</button>
            </div>
            <span class="text-dark login-text">Need an account? <a class="text-primary" href="<?= BASEURL ?>/?url=auth/register">Register</a></span>
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
      height: max-content;
   }

   .btn-custom {
      background-color: #ffc107;
      border-color: #ffc107;
   }

   .login-text {
      font-size: 0.9rem;
   }

   /* Link Styles */
   a {
      text-decoration: none;
      color: inherit;
   }

   a:hover {
      text-decoration: underline;
      /* Optionally add underline on hover */
   }
</style>

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
</script>
</script>