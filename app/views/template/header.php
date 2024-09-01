<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= $data['judul']; ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
   <nav class="navbar navbar-expand-lg py-0 shadow-lg sticky-top" style="z-index: 102;">
      <div class="container px-0 d-flex flex-row-reverse flex-sm-row" style="max-width: 940px;">
         <a class="navbar-brand ms-sm-0 py-0 me-4" href="#"><img class="d-block image-form rotate-90" src="<?= BASEURL ?>/img/logo.png" alt="Group Image" height="70"></a>
         <button class="navbar-toggler ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
               <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                  <li class="nav-item ">
                     <a class="nav-link py-1 fs-6" aria-current="page" href="#">STORE</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link py-1 fs-6" href="#">ABOUT</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link py-1 fs-6" href="#">COMMUNITY</a>
                  </li>
               </ul>

               <ul class="navbar-nav mb-2 mb-lg-0 shadow-sm rounded-sm">
                  <div class="input-group ">
                     <li class=" form-control py-1 my-1 rounded-sm ">
                        Hi, <span style="color: <?= PRIMARY_COLOR ?>;"><?= $_SESSION['user'] ?></span>
                     </li>
                     <a class="btn btn-sm btn-danger rounded-sm py-1 my-1 shadow-sm" href="<?= BASEURL ?>/?url=auth/logout" id="button-logout">Logout</a>
                  </div>
               </ul>
            </div>
         </div>

      </div>
   </nav>

   <style>
      body {
         font-family: Arial, sans-serif;
      }

      .navbar {
         background-color: white;
         /* background: linear-gradient(to top, <?= PRIMARY_COLOR ?> 2%, rgba(255, 255, 255, 1) 70%); */
      }

      .rotate-90 {
         transform: rotate(-90deg);
      }

      .rounded-sm {
         border-radius: 2px;
      }

      .rounded-sm-start {
         border-radius: 2px 0 0 2px;
      }
   </style>