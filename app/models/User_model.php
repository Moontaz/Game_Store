<?php

class User_model
{
   private $table = 'users';
   private $dev_table = 'developers';
   private $cust_table = 'customers';
   private $db;

   public function __construct()
   {
      $this->db = new Database;
   }

   public function getAllUser()
   {
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
   public function getAllDev()
   {
      $this->table = 'developers';
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
   public function getAllCust()
   {
      $this->table = 'customers';
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
   public function getAllOrders()
   {
      $this->table = 'orders';
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
   public function getAllAddress()
   {
      $this->table = 'address';
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
   public function getUserById()
   {
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSingle();
   }

   public function register($data)
   {
      if ($data['role'] == 'customer') {
         $this->addCust($data);
      } elseif ($data['role'] == 'developer') {
         $this->addDev($data);
      } else {
         // Insert into users table
         $query1 = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";
         $this->db->query($query1);
         $this->db->bind('username', $data['username']);
         $this->db->bind('password', $data['password']);
         $this->db->bind('email', $data['email']);
         $this->db->bind('role', $data['role']);
         $this->db->execute();
      }
      // var_dump($data['username']);
      return true;
   }
   //Function for Developer
   public function addDev($data)
   {

      // Insert into users table
      $query1 = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";
      $this->db->query($query1);
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);
      $this->db->bind('email', $data['email']);
      $this->db->bind('role', $data['role']);
      $this->db->execute();

      // Get the user_id of the newly inserted user
      $queryGetId = "SELECT id FROM users WHERE username = :username";
      $this->db->query($queryGetId);
      $this->db->bind('username', $data['username']);
      $userIdResult = $this->db->resultSingle();
      $userId = $userIdResult['id'];

      // Insert into developer table
      $query2 = "INSERT INTO developers (user_id, company_name) VALUES (:user_id, :company_name)";
      $this->db->query($query2);
      $this->db->bind('user_id', $userId);
      $this->db->bind('company_name', $data['company_name']);
      $this->db->execute();

      return true;
   }
   public function updateDev($data)
   {
      $query1 = "UPDATE developers SET company_name = :company_name WHERE user_id = :user_id";

      $this->db->query($query1);
      $this->db->bind('company_name', $data['company_name']);
      $this->db->bind('user_id', $data['id']);
      $this->db->execute();

      // Query untuk update data users
      $query2 = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :user_id";

      $this->db->query($query2);
      $this->db->bind('user_id', $data['id']);
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);
      $this->db->bind('email', $data['email']);
      $this->db->execute();

      return true;
   }
   public function deleteDev($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the reviews table
      $queryReviews = "DELETE FROM reviews WHERE game_id IN 
                        (SELECT id FROM games WHERE developer_id IN 
                           (SELECT id FROM developers WHERE user_id IN ($ids)))";
      $this->db->query($queryReviews);
      $this->db->execute();

      $queryWish = "DELETE FROM wishlists WHERE game_id IN 
                     (SELECT id FROM games WHERE developer_id IN 
                        (SELECT id FROM developers WHERE user_id IN ($ids)))";
      $this->db->query($queryWish);
      $this->db->execute();

      // Delete game data from the games table
      $queryGames = "DELETE FROM games WHERE developer_id IN 
      (SELECT id FROM developers WHERE user_id IN ($ids))";

      $this->db->query($queryGames);
      $this->db->execute();

      // Delete from the developers table
      $queryDevs = "DELETE FROM developers WHERE user_id IN ($ids)";
      $this->db->query($queryDevs);
      $this->db->execute();

      // Delete from the users table
      $queryUsers = "DELETE FROM users WHERE id IN ($ids)";
      $this->db->query($queryUsers);
      $this->db->execute();

      // return true;
      return true;
   }
   public function getDevCompanybyId($id)
   {
      $query = ('SELECT company_name FROM ' . $this->dev_table . ' WHERE id=:id');
      // var_dump($query);
      // var_dump($idGame);
      // exit;
      $this->db->query($query);
      $this->db->bind('id', $id);
      $dev = $this->db->resultSingle();
      return $dev['company_name'];
   }
   public function getDevUsernamebyId($id)
   {
      $query = ('SELECT user_id FROM ' . $this->dev_table . ' WHERE id=:id');
      $this->db->query($query);
      $this->db->bind('id', $id);
      $temp = $this->db->resultSingle();
      // var_dump($temp);
      $query2 = ('SELECT username FROM ' . $this->table . ' WHERE id=:user_id');
      // var_dump($query);
      // var_dump($idGame);
      // exit;
      $this->db->query($query2);
      $this->db->bind('user_id', $temp['user_id']);
      $dev = $this->db->resultSingle();
      // var_dump($dev['username']);
      return $dev['username'];
   }
   public function getDevbyUserId($user_id)
   {
      $query = ('SELECT * FROM ' . $this->dev_table . ' WHERE user_id=:user_id');
      $this->db->query($query);
      $this->db->bind('user_id', $user_id);
      return $this->db->resultSingle();
   }
   public function getCustbyUserId($user_id)
   {
      $query = ('SELECT * FROM ' . $this->cust_table . ' WHERE user_id=:user_id');
      $this->db->query($query);
      $this->db->bind('user_id', $user_id);
      return $this->db->resultSingle();
   }
   public function getCustIdbyUserId($user_id)
   {
      $query = ('SELECT id FROM ' . $this->cust_table . ' WHERE user_id=:user_id');
      $this->db->query($query);
      $this->db->bind('user_id', $user_id);
      $cust = $this->db->resultSingle();
      return $cust['id'];
   }
   public function getDevIdbyUserId($user_id)
   {
      $query = ('SELECT id FROM ' . $this->dev_table . ' WHERE user_id=:user_id');
      $this->db->query($query);
      $this->db->bind('user_id', $user_id);
      $dev = $this->db->resultSingle();
      return $dev['id'];
   }
   //Function for Customer
   public function addCust($data)
   {

      // Insert into users table
      $query1 = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";
      $this->db->query($query1);
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);
      $this->db->bind('email', $data['email']);
      $this->db->bind('role', $data['role']);
      $this->db->execute();

      // Get the user_id of the newly inserted user
      $queryGetId = "SELECT id FROM users WHERE username = :username";
      $this->db->query($queryGetId);
      $this->db->bind('username', $data['username']);
      $userIdResult = $this->db->resultSingle();
      $userId = $userIdResult['id'];

      // Insert into customers table
      $query2 = "INSERT INTO customers (user_id, full_name, id_address) VALUES (:user_id, :full_name, :id_address)";
      $this->db->query($query2);
      $this->db->bind('user_id', $userId);
      $this->db->bind('full_name', $data['full_name']);
      $this->db->bind('id_address', $data['address_id']);
      $this->db->execute();

      return true;
   }
   public function updateCust($data)
   {
      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';
      // exit;

      // Query untuk update data customers
      $query1 = "UPDATE customers SET full_name = :full_name, address = :address WHERE user_id = :user_id";

      $this->db->query($query1);
      $this->db->bind('full_name', $data['full_name']);
      $this->db->bind('address', $data['address']);
      $this->db->bind('user_id', $data['user_id']);
      $this->db->execute();

      // Query untuk update data users
      $query2 = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :user_id";

      $this->db->query($query2);
      $this->db->bind('user_id', $data['user_id']);
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);
      $this->db->bind('email', $data['email']);
      $this->db->execute();

      return true;
   }

   public function deleteCust($ids)
   {
      $ids = implode(',', array_map('intval', $ids)); // Sanitize the ids

      // Delete from the reviews table
      $query1 = "DELETE FROM reviews WHERE customer_id IN 
                  (SELECT id FROM customers WHERE user_id IN ($ids));";
      $this->db->query($query1);
      $this->db->execute();

      $queryWish = "DELETE FROM wishlists WHERE customer_id IN 
                  (SELECT id FROM customers WHERE user_id IN ($ids));";
      $this->db->query($queryWish);
      $this->db->execute();

      // Delete from the customers table
      $query2 = "DELETE FROM customers WHERE user_id IN ($ids)";
      $this->db->query($query2);
      $this->db->execute();

      // Delete from the users table
      $query3 = "DELETE FROM users WHERE id IN ($ids)";
      $this->db->query($query3);
      $this->db->execute();

      // return true;
      return true;
   }

   public function addOrders($cust_id, $total, $gameCart)
   {
      // Insert into orders table
      $queryOrders = "INSERT INTO orders (customer_id, total) VALUES (:cust_id, :total)";
      $this->db->query($queryOrders);
      $this->db->bind('cust_id', $cust_id);
      $this->db->bind('total', $total);
      $this->db->execute();

      $order_id = $this->db->lastInsertId();
      $queryOrderDetails = "INSERT INTO order_items (order_id, game_id) VALUES ";

      $values = [];
      foreach ($gameCart as $game_id) {
         $values[] = "($order_id, $game_id)";
      }

      $queryOrderDetails .= implode(", ", $values);

      $this->db->query($queryOrderDetails);
      $this->db->execute();
   }
   public function addOrdersFree($cust_id, $total, $game_id)
   {
      // Insert into orders table
      $queryOrders = "INSERT INTO orders (customer_id, total) VALUES (:cust_id, :total)";
      $this->db->query($queryOrders);
      $this->db->bind('cust_id', $cust_id);
      $this->db->bind('total', $total);
      $this->db->execute();

      $order_id = $this->db->lastInsertId();
      $queryOrderDetails = "INSERT INTO order_items (order_id, game_id) VALUES (:order_id,:game_id)";

      $this->db->query($queryOrderDetails);
      $this->db->bind('order_id', $order_id);
      $this->db->bind('game_id', $game_id);
      $this->db->execute();
   }

   public function updateOrder($data)
   {
      $query = "UPDATE orders SET customer_id = :customer_id, total = :total WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('customer_id', $data['customer_id']);
      $this->db->bind('total', $data['total']);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
      return true;
   }

   public function deleteOrder($order_id)
   {
      // Delete from the orders table
      $query1 = "DELETE FROM orders WHERE id = :id";
      $this->db->query($query1);
      $this->db->bind('id', $order_id);
      $this->db->execute();

      return true;
   }
   public function addAddress($data)
   {
      // Delete from the address table
      $query1 = "INSERT INTO address (country, province) VALUES (:country, :province)";
      $this->db->query($query1);
      $this->db->bind('country', $data['country']);
      $this->db->bind('province', $data['province']);
      $this->db->execute();

      return true;
   }
   public function deleteAddress($id)
   {
      // Delete from the address table
      $query1 = "DELETE FROM address WHERE id = :id";
      $this->db->query($query1);
      $this->db->bind('id', $id);
      $this->db->execute();

      return true;
   }
   public function updateAddress($data)
   {
      // Query untuk update data users
      $query = "UPDATE address SET country = :country, province = :province WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('country', $data['country']);
      $this->db->bind('province', $data['province']);
      $this->db->bind('id', $data['id']);
      $this->db->execute();

      return true;
   }
   public function getOrdersIdbyCustId($cust_id)
   {
      $query = ('SELECT id FROM orders WHERE customer_id = :cust_id');
      $this->db->query($query);
      $this->db->bind('cust_id', $cust_id);
      $ordersTemp = $this->db->resultSet();
      $orders = [];
      if (!empty($ordersTemp)) {
         foreach ($ordersTemp as $temp) {
            array_push($orders, $temp['id']);
         }
      }
      // var_dump($orders);
      return $orders;
   }

   public function deleteUser($id)
   {
      // Delete from the user table
      $query1 = "DELETE FROM users WHERE id = :id";
      $this->db->query($query1);
      $this->db->bind('id', $id);
      $this->db->execute();

      return true;
   }
}
