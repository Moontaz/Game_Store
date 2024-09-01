<!-- Footer -->
<footer class="footer py-3">
   <div class="container d-none d-sm-flex flex-column">
      <div class="row">
         <div class="col-md-12 text-center text-md-left logo">
            <img src="/mnt/data/image.png" alt="Valve Logo">
            <p class="mt-2 footer-text">© 2024 Valve Corporation. All rights reserved. All trademarks are property of
               their
               respective owners in the US and other countries. VAT included in all prices where applicable.
               <a href="#">Privacy Policy</a> | <a href="#">Legal</a> | <a href="#">Steam Subscriber Agreement</a> |
               <a href="#">Refunds</a> | <a href="#">Cookies</a>
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16">
               <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.2 2.2 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.22 2.22 0 0 1-1.312-1.568L.33 10.333Z" />
               <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.7 1.7 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027m2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048" />
            </svg>
         </div>
         <div class="col-md-4 text-center">
            <ul class="list-unstyled">

            </ul>
         </div>
         <div class="col-md-4 text-center text-md-right social-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
         </div>
      </div>
      <div class="row mt-3">
         <div class="col text-center">
            <a class="mx-3" href="#">About Valve</a> |
            <a class="mx-3" href="#">Jobs</a> |
            <a class="mx-3" href="#">Steamworks</a> |
            <a class="mx-3" href="#">Steam Distribution</a> |
            <a class="mx-3" href="#">Support</a> |
            <a class="mx-3" href="#">Gift Cards</a> |
            <a class="mx-3" href="#">Steam</a> |
            <a class="mx-3" href="#">@steam</a>
         </div>
      </div>
   </div>
</footer>

<style>
   * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
   }

   body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background-color: #f4f4f4;
      color: #333;
   }

   .footer {
      background-color: #f8f9fa;
      /* Light background color */
      padding: 40px 0;
      border-top: 1px solid #e0e0e0;
      color: #000000;
      /* Text color */
   }

   .footer-text {
      font-size: 0.7rem;
   }

   .footer a {
      color: <?= SECONDARY_COLOR ?>;
      text-decoration: none;
   }

   .footer a:hover {
      color: <?= PRIMARY_COLOR ?>;
      /* text-decoration: underline; */
   }

   .footer .social-icons a {
      margin-right: 15px;
      font-size: 20px;
      /* Increase icon size */
   }

   .footer .logo img {
      height: 60px;
      /* Increase logo size */
   }

   .footer .list-unstyled {
      padding-left: 0;
      list-style: none;
   }

   .footer .list-unstyled li {
      margin-bottom: 10px;
   }

   .footer .social-icons {
      display: flex;
      justify-content: center;
      gap: 20px;
   }

   .footer .social-icons a {
      color: #000000;
      transition: color 0.3s ease;
   }

   .footer .social-icons a:hover {
      color: #007bff;
      /* Change icon color on hover */
   }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>