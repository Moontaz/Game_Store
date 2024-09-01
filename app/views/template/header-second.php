<div class="header-container shadow sticky-top" style="z-index: 101; top:70px;">

   <div class="container  px-0" style="max-width:940px;">
      <nav class="header-container container d-flex flex-row justify-content-between px-0 mx-0">
         <ul class="nav nav-underline mb-lg-0 ">
            <li class="nav-item d-flex align-items-center">
               <a class="nav-link py-1 px-1 px-sm-4  responsive-text" aria-current="page"
                  href="<?= BASEURL ?>?url=home/index">Your
                  Store</a>
            </li>
            <li class="nav-item d-flex align-items-center">
               <a class="nav-link py-1 px-1 px-sm-4  responsive-text" href="#">Categories</a>
            </li>
            <li class="nav-item d-flex align-items-center">
               <a class="nav-link py-1 px-1 px-sm-4  responsive-text" href="<?= BASEURL ?>?url=home/my_game">My Game</a>
            </li>
         </ul>
         <form action="<?= BASEURL ?>" method="GET" class="d-flex col-4 col-sm-3 py-2 me-2 me-sm-0">
            <!-- <div class="form-group"> -->
            <input type="hidden" value="home/search" class="form-control" name="url">
            <input type="text" class="form-control" name="keyword" placeholder="Search">
         </form>
      </nav>
   </div>
</div>
<style>
.header-container {
   background-color: white;

   /* background: linear-gradient(to top, <?= PRIMARY_COLOR ?> 2%, rgba(255, 255, 255, 1) 70%); */
}

.header-container a {
   color: black;
   background-color: transparent;
   z-index: 1;
   position: relative;
   overflow: hidden;
}

.header-container a:hover {
   color: rgba(13, 110, 253, 1);
}

.header-container a::before {
   content: '';
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   /* Tambahkan width dan height agar elemen before terlihat */
   height: 100%;
   /* Menentukan posisi agar z-index berfungsi */
   background: linear-gradient(to top, rgba(194, 218, 254, 1) 0%, rgba(13, 110, 253, 0) 60%);
   opacity: 0;
   z-index: -1;
}

.header-container a:hover::before {
   opacity: 1;
}

.responsive-text {
   font-size: 0.8rem;
}

@media (min-width: 576px) {
   .responsive-text {
      font-size: 1rem;
   }
}
</style>