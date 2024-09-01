<?php

class Game_model
{
   private $table = 'games';
   private $wish_table = 'wishlists';
   private $review_table = 'reviews';
   private $download_table = 'downloads';
   private $order_items_table = 'order_items';
   private $db;

   public function __construct()
   {
      $this->db = new Database;
   }

   public function getAllGame()
   {
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
   public function getAllOrderItems()
   {
      $this->db->query('SELECT * FROM ' . $this->order_items_table);
      return $this->db->resultSet();
   }
   public function getGamebyDevId($dev_id)
   {
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE developer_id=:dev_id');
      $this->db->bind('dev_id', $dev_id);
      return $this->db->resultSet();
   }
   public function getAllWishs()
   {
      $this->db->query('SELECT * FROM ' . $this->wish_table);
      return $this->db->resultSet();
   }
   public function getAllDownloads()
   {
      $this->db->query('SELECT * FROM ' . $this->download_table);
      return $this->db->resultSet();
   }

   public function addDownload($customer_id, $game_id)
   {
      // Cek apakah entri sudah ada interval 1 menit terakhir
      $checkQuery = "SELECT COUNT(*) as count FROM downloads WHERE customer_id = :cust_id AND game_id = :game_id AND download_date >= NOW() - INTERVAL 1 MINUTE";
      $this->db->query($checkQuery);
      $this->db->bind('cust_id', $customer_id);
      $this->db->bind('game_id', $game_id);
      $this->db->execute();
      $row = $this->db->resultSingle();

      // Jika entri tidak ada, tambahkan ke tabel downloads
      if ($row['count'] == 0) {
         $query = "INSERT INTO downloads (customer_id, game_id) VALUES (:cust_id, :game_id)";
         $this->db->query($query);
         $this->db->bind('cust_id', $customer_id);
         $this->db->bind('game_id', $game_id);
         $this->db->execute();
      } else {
         return false; // atau pesan lain yang sesuai
      }

      return true;
   }

   public function updateDownload($data)
   {
      // Query untuk update data users
      $query = "UPDATE downloads SET customer_id = :customer_id, game_id = :game_id WHERE id = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->bind('customer_id', $data['customer_id']);
      $this->db->bind('game_id', $data['game_id']);
      // $this->db->bind('download_date', $data['download_date']);
      $this->db->execute();

      return true;
   }

   public function deleteDownload($id)
   {
      $query = "DELETE FROM downloads WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();

      return true;
   }

   public function getWishsbyCustId($cust_id)
   {
      $this->db->query('SELECT * FROM ' . $this->wish_table . ' WHERE customer_id=:cust_id');
      $this->db->bind('cust_id', $cust_id);
      $data = $this->db->resultSet();

      if (!$data) { // Check if $data is null or empty
         // echo 'KOSONGGGGG';
         $data['isset'] = false;
         return $data;
      }

      $game_ids = array_map(function ($item) {
         return $item['game_id'];
      }, $data);

      $ids = implode(',', array_map('intval', $game_ids)); // Sanitize the ids

      $this->db->query("SELECT * FROM " . $this->table . " WHERE id IN ($ids);");
      $data['games'] = $this->db->resultSet();

      $data['isset'] = true;
      return $data;
   }

   public function getAllReviews()
   {
      $this->db->query('SELECT * FROM ' . $this->review_table);
      return $this->db->resultSet();
   }

   public function getOverallReviews()
   {
      $this->db->query('
        SELECT 
            game_id, 
            COUNT(customer_id) as user_count, 
            AVG(CAST(rating AS UNSIGNED)) as average_rating,
            CASE 
                WHEN AVG(CAST(rating AS UNSIGNED)) > 4 THEN "Overwhelming Positive"
                WHEN AVG(CAST(rating AS UNSIGNED)) > 3 THEN "Very Positive"
                WHEN AVG(CAST(rating AS UNSIGNED)) > 2 THEN "Mixed"
                ELSE "Bad"
            END as rating_label
        FROM reviews 
        GROUP BY game_id
    ');

      return $this->db->resultSet();
   }

   public function getGameById($idGame)
   {
      $query = ('SELECT * FROM ' . $this->table . ' WHERE id=:id');
      // var_dump($query);
      // var_dump($idGame);
      // exit;
      $this->db->query($query);
      $this->db->bind('id', $idGame);
      return $this->db->resultSingle();
   }

   public function getGamesbyIds($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the wishlists table
      $query1 = "SELECT * FROM games WHERE id IN ($ids)";
      $this->db->query($query1);
      return $this->db->resultSet();
   }

   //Function for Game
   public function addGame($data)
   {
      // Prepare the SQL query
      $this->db->query('INSERT INTO games (developer_id, title, short_desc, description, price, release_date, file_path) 
                        VALUES (:developer_id, :title, :short_desc, :description, :price, :release_date, :file_path)');

      // Bind values
      $this->db->bind(':developer_id', $data['developer_id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':short_desc', $data['short_desc']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':release_date', $data['release_date']);
      $this->db->bind(':file_path', $data['file_path']);

      // Execute the query
      $this->db->execute();
      return true;
      // if ($this->db->execute()) {
      //    return true;
      // } else {
      //    return false;
      // }
   }
   public function updateGame($data)
   {
      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';
      // exit;

      // Query untuk update data users
      $query = "UPDATE games SET title = :title, description = :description, price = :price, release_date = :release_date, file_path = :file_path WHERE id = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->bind('title', $data['title']);
      $this->db->bind('release_date', $data['release_date']);
      $this->db->bind('file_path', $data['file_path']);
      $this->db->bind('price', $data['price']);
      $this->db->bind('description', $data['description']);
      $this->db->execute();

      return true;
   }

   public function deleteGames($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the reviews table
      $queryReviews = "DELETE FROM reviews WHERE game_id IN 
                        (SELECT id FROM games WHERE id IN ($ids));";
      $this->db->query($queryReviews);
      $this->db->execute();

      $queryWish = "DELETE FROM wishlists WHERE game_id IN 
                     (SELECT id FROM games WHERE id IN ($ids));";
      $this->db->query($queryWish);
      $this->db->execute();

      // Delete from the games table
      $query1 = "DELETE FROM games WHERE id IN ($ids)";
      $this->db->query($query1);
      $this->db->execute();

      // Delete from the users table
      // $query2 = "DELETE FROM users WHERE id IN ($ids)";
      // $this->db->query($query2);
      // $this->db->execute();

      // return $this->db->rowCount();
      return true;
   }

   public function deleteWishs($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the wishlists table
      $query1 = "DELETE FROM wishlists WHERE id IN ($ids)";
      $this->db->query($query1);
      $this->db->execute();
      return true;
   }
   public function addWish($cust_id, $game_id)
   {
      // Add from the wishlists table
      // var_dump($cust_id);
      // var_dump($game_id);
      $query1 = "INSERT INTO wishlists (customer_id, game_id) VALUES (:customer_id, :game_id)";
      $this->db->query($query1);
      $this->db->bind('customer_id', $cust_id);
      $this->db->bind('game_id', $game_id);
      $this->db->execute();

      return true;
   }
   public function removeWish($cust_id, $game_id)
   {
      // Add from the wishlists table
      // var_dump($cust_id);
      // var_dump($game_id);
      $query1 = "DELETE FROM wishlists WHERE customer_id = :customer_id AND game_id = :game_id";
      $this->db->query($query1);
      $this->db->bind('customer_id', $cust_id);
      $this->db->bind('game_id', $game_id);
      $this->db->execute();

      return true;
   }
   public function updateWish($data)
   {
      // Query untuk update data users
      $query = "UPDATE wishlists SET customer_id = :customer_id, game_id = :game_id WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('customer_id', $data['custId']);
      $this->db->bind('game_id', $data['gameId']);
      $this->db->bind('id', $data['id']);
      $this->db->execute();

      return true;
   }

   public function addCart($cart, $game_id)
   {
      if (!in_array($game_id, $cart)) {
         array_push($cart, $game_id);
      }
      return $cart;
   }
   public function removeCart($cart, $game_id)
   {
      foreach ($cart as $key => $game) {
         if ($game == $game_id) {
            unset($cart[$key]);
         }
      }
      $cart = array_values($cart);
      // var_dump($cart);

      return $cart;
   }

   public function addReview($data)
   {
      $query1 = "INSERT INTO reviews (customer_id, game_id, rating) VALUES (:customer_id, :game_id, :rating)";
      $this->db->query($query1);
      $this->db->bind('customer_id', $data['customer_id']);
      $this->db->bind('game_id', $data['game_id']);
      $this->db->bind('rating', $data['rating']);
      $this->db->execute();

      return true;
   }
   public function updateReview($data)
   {
      $query1 = "UPDATE reviews SET customer_id=:customer_id, game_id=:game_id, rating  = :rating WHERE id=:id";
      $this->db->query($query1);
      $this->db->bind('customer_id', $data['customer_id']);
      $this->db->bind('game_id', $data['game_id']);
      $this->db->bind('rating', $data['rating']);
      $this->db->bind('id', $data['review_id']);
      $this->db->execute();

      return true;
   }

   public function deleteReview($reviewId)
   {
      // Prepare and execute the delete query
      $query = "DELETE FROM reviews WHERE id = $reviewId";

      $this->db->query($query);
      $this->db->execute();
      return true;
   }
   public function getGameIdbyOrdersId($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the wishlists table
      $query = "SELECT game_id FROM order_items WHERE order_id IN ($ids)";
      $this->db->query($query);
      $temp = $this->db->resultSet();
      $gameIds = [];
      if (!empty($temp)) {
         foreach ($temp as $array) {
            array_push($gameIds, $array['game_id']);
         }
      }
      return $gameIds;
   }
   public function getGamesbyGameIds($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the wishlists table
      $query = "SELECT * FROM games WHERE id IN ($ids)";
      $this->db->query($query);
      return $this->db->resultSet();
   }

   public function updateItem($data)
   {
      $query = "UPDATE order_items SET order_id = :order_id, game_id = :game_id WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('order_id', $data['order_id']);
      $this->db->bind('game_id', $data['game_id']);
      $this->db->bind('id', $data['id']);

      $this->db->execute();

      return true;
   }
   public function deleteItem($item_id)
   {
      // Delete from the order_items table
      $query1 = "DELETE FROM order_items WHERE id = :id";
      $this->db->query($query1);
      $this->db->bind('id', $item_id);
      $this->db->execute();

      return true;
   }
   public function getReviewbyCustIdnGameId($cust_id, $game_id)
   {
      // Delete from the order_items table
      $query1 = "SELECT * FROM reviews WHERE customer_id = :cust_id AND game_id=:game_id";
      $this->db->query($query1);
      $this->db->bind('cust_id', $cust_id);
      $this->db->bind('game_id', $game_id);

      return $this->db->resultSingle();
   }



   // Fungsi untuk melakukan pencarian fuzzy
   public function searchFuzzy($keyword, $developers)
   {
      $games = $this->getAllGame();
      // $developers = $this->model('User_model')->getAllDevelopers();

      $results = [];
      foreach ($games as $game) {
         $distance = levenshtein($keyword, $game['title']);
         if ($distance <= 3) { // Atur threshold sesuai kebutuhan
            $results[] = [
               'type' => 'game',
               'name' => $game['title'],
               'data' => $game,
               'distance' => $distance
            ];
         }
      }

      foreach ($developers as $developer) {
         $distance = levenshtein($keyword, $developer['company_name']);
         if ($distance <= 5) { // Atur threshold sesuai kebutuhan
            $results[] = [
               'type' => 'developer',
               'name' => $developer['company_name'],
               'data' => $developer,
               'distance' => $distance
            ];
         }
      }

      // Urutkan hasil berdasarkan jarak terdekat
      usort($results, function ($a, $b) {
         return $a['distance'] - $b['distance'];
      });

      return $results;
   }

   public function getErrorInfo()
   {
      return $this->db->errorInfo();
   }
}
