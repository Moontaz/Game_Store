<?php

class HomeController extends Controller
{
   public function index()
   {

      $data['judul'] = 'Home/index';
      $data['Games'] = $this->model('Game_model')->getAllGame();
      $data['reviews'] = $this->model('Game_model')->getOverallReviews();
      $data['devs'] = $this->model('User_model')->getAllDev();
      // $data['Cust'] = $this->model('User_model')->getCustbyUserId();
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('template/header', $data);
      $this->view('template/header-second', $data);
      $this->view('home/index', $data);
      $this->view('template/footer');
   }
   public function index_dev()
   {
      $user_id = $_SESSION['id'];
      $data['judul'] = 'Developer Menu';
      $data['Dev'] = $this->model('User_model')->getDevbyUserId($_SESSION['id']);
      $data['Games'] = $this->model('Game_model')->getGamebyDevId($_SESSION['dev_id']);
      $data['users'] = $this->model('User_model')->getAllUser();
      $data['custs'] = $this->model('User_model')->getAllCust();
      $data['wishs'] = $this->model('Game_model')->getAllWishs();
      $data['reviews'] = $this->model('Game_model')->getAllreviews();
      $data['downloads'] = $this->model('Game_model')->getAllDownloads();
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('template/header', $data);
      $this->view('home/index_dev', $data);
      $this->view('template/footer');
   }
   public function game($idgame, $rating_label, $user_count)
   {
      // Ambil data game
      $game = $this->model('Game_model')->getGamebyId($idgame);
      $game['company_name'] = $this->model('User_model')->getDevCompanybyId($game['developer_id']);
      $game['dev_username'] = $this->model('User_model')->getDevUsernamebyId($game['developer_id']);

      // Ambil wishlist customer
      $_SESSION['wishsCust'] = $this->model('Game_model')->getWishsbyCustId($_SESSION['cust_id']);
      if (isset($_SESSION['wishsCust']['isset']) && $_SESSION['wishsCust']['isset'] === true) {
         if (isset($_SESSION['wishsCust']['games'])) {
            unset($_SESSION['wishsCust']['games']);
         }
      }

      // Ambil order customer
      $data['orders'] = $this->model('User_model')->getOrdersIdbyCustId($_SESSION['cust_id']);
      $data['orders'] = $this->model('Game_model')->getGameIdbyOrdersId($data['orders']);
      // Cek apakah customer memiliki review untuk game ini
      if (!empty($data['orders']) && in_array($idgame, $data['orders'])) {
         $data['review'] = $this->model('Game_model')->getReviewbyCustIdnGameId($_SESSION['cust_id'], $idgame);
      } else {
         $data['review'] = null;
      }
      // var_dump($data['orders']);
      $data['can_review'] = !empty($data['orders']) && in_array($idgame, $data['orders']);

      $data['judul'] = $game['title'];
      $data['game'] = $game;
      $data['rating_label'] = $rating_label;
      $data['user_count'] = $user_count;

      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }

      $this->view('template/header', $data);
      $this->view('template/header-second', $data);
      $this->view('home/game', $data);
      $this->view('template/footer');
   }


   public function wishlist()
   {

      $data['judul'] = $_SESSION['user'] . "'s Wishlist";
      $data['Games'] = $this->model('Game_model')->getAllGame();
      $data['reviews'] = $this->model('Game_model')->getOverallReviews();
      $_SESSION['wishsCust'] = $this->model('Game_model')->getWishsbyCustId($_SESSION['cust_id']);
      // if ($_SESSION['wishsCust']['isset'] === true) {
      //       unset($_SESSION['wishsCust']['games']);
      // }
      // var_dump($_SESSION['wishsCust']);
      // $data['Cust'] = $this->model('User_model')->getCustbyUserId();
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('template/header', $data);
      $this->view('template/header-second', $data);
      $this->view('home/wishlist', $data);
      $this->view('template/footer');
   }
   public function cart()
   {

      $data['judul'] = "Shopping Cart";
      // var_dump($_SESSION['cart']);
      if (!empty($_SESSION['cart'])) {
         $data['Games'] = $this->model('Game_model')->getGamesbyIds($_SESSION['cart']);
         $data['reviews'] = $this->model('Game_model')->getOverallReviews();
         // var_dump($data['reviews']);
      } else {
         header('Location: ' . BASEURL . '?url=home/index');
      }
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('template/header', $data);
      $this->view('template/header-second', $data);
      $this->view('home/cart', $data);
      $this->view('template/footer');
   }
   public function my_game()
   {

      $data['judul'] = "My Game";
      // var_dump($_SESSION['cart']);
      $data['orders'] = $this->model('User_model')->getOrdersIdbyCustId($_SESSION['cust_id']);
      if (!empty($data['orders'])) {
         // var_dump($data['orders']);
         // echo 'AAAAA';
         $data['gameIds'] = $this->model('Game_model')->getGameIdbyOrdersId($data['orders']);
         // var_dump($data['gameIds']);
         // echo 'AAAAA';
         $data['myGames'] = $this->model('Game_model')->getGamesbyGameIds($data['gameIds']);
         // var_dump($data['myGames']);
         $data['reviews'] = $this->model('Game_model')->getOverallReviews();
      }
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('template/header', $data);
      $this->view('template/header-second', $data);
      $this->view('home/my_game', $data);
      $this->view('template/footer');
   }

   public function search()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         // if (isset($_SESSION['keyword'])) {
         $keyword = $_GET['keyword'];
         // unset($_SESSION['keyword']);
         $devs = $this->model('User_model')->getAllDev();
         // var_dump($keyword);
         // var_dump($devs);
         $results = $this->model('Game_model')->searchFuzzy($keyword, $devs);
         // var_dump($keyword);
         $data['judul'] = 'Search Results';
         $data['results'] = $results;

         $this->view('template/header', $data);
         $this->view('template/header-second', $data);
         $this->view('home/search', $data);
         $this->view('template/footer');
      } else {
         var_dump($_SERVER['REQUEST_METHOD']);
         // header('location: ' . BASEURL . "?url=home/index");
      }
   }
}
