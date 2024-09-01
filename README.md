# Game Store Platform

This project is a dynamic game store platform, similar to Steam, developed using PHP, MongoDB, Bootstrap, and MySQL. It features user roles (admin, developer, and customer), CRUD operations for all tables, dynamic form elements, multi-insert, multi-delete functionalities, a shopping cart, file upload/download, and a bookmark feature.

## Features
- **User Roles:** Admin, Developer, and Customer with respective access controls.
- **CRUD Operations:** Full CRUD functionalities for all entities (games, developers, customers, orders, reviews, etc.).
- **Dynamic Forms:** Includes dynamic comboboxes and elements that adjust based on user input.
- **File Upload/Download:** Developers can upload games, and customers can download purchased games.
- **Shopping Cart:** Customers can add games to their cart and purchase multiple items at once.
- **Multi-Insert/Multi-Delete:** Allows batch operations for efficient data management.
- **Bookmark Feature:** Customers can bookmark games for later viewing or purchasing.

## Table of Contents
- [Installation](#installation)
- [Database Structure](#database-structure)
- [User Roles](#user-roles)
- [Entities](#entities)
- [Features](#features)
- [Screenshots](#screenshots)
- [License](#license)

## Installation
To run the project locally, follow these steps:

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/gamestore.git
    ```

2. Install dependencies:
    - PHP >= 7.4
    - MongoDB PHP Extension
    - MySQL >= 8.0
    - Composer for PHP packages
    - Bootstrap (included in the `public/` directory)

3. Set up the database:
    - Import the `game_store.sql` file to your MySQL server.
    - Update the `.env` file with your database and other configuration details.

4. Start the server:
    ```bash
    php -S localhost:8000
    ```

## Database Structure
The database consists of 10 tables and multiple relations to handle the game store's operations.

### Tables:
- **Users:** Stores user credentials and roles (admin, developer, customer).
- **Customers:** Stores customer details and their address.
- **Developers:** Stores developer information and their associated games.
- **Games:** Stores game details such as title, description, price, release date, and file paths.
- **Orders:** Tracks customer purchases and their total cost.
- **Order_Items:** Holds individual games purchased in each order.
- **Reviews:** Allows customers to rate and review games.
- **Downloads:** Tracks which customer downloaded which game.
- **Address:** Stores addresses associated with customers.
- **Bookmarks:** Holds games bookmarked by customers for future purchases.

### Relations:
- **Customers ↔ Users:** Each customer is associated with a user account.
- **Games ↔ Developers:** Each game belongs to a developer.
- **Orders ↔ Customers:** Each order is tied to a customer.
- **Order_Items ↔ Games:** Stores which games were purchased in each order.
- **Reviews ↔ Games ↔ Customers:** Allows customers to leave reviews and ratings for games.

## User Roles
### Admin:
- Full access to all functionalities.
- Can manage users, developers, and games.
- Can view and modify orders, reviews, and ratings.

### Developer:
- Can upload and manage their own games.
- Can view reviews and ratings on their games.

### Customer:
- Can browse and purchase games.
- Can review, rate, and bookmark games.
- Can manage their own account and view their order history.

## Entities
### Users
| Column   | Type           | Description                    |
|----------|----------------|--------------------------------|
| id       | int            | Primary Key                    |
| username | varchar(50)    | Unique username                |
| password | varchar(255)   | Password (hashed)              |
| email    | varchar(100)   | User email                     |
| role     | enum(admin,developer,customer) | User role      |

### Games
| Column       | Type           | Description                    |
|--------------|----------------|--------------------------------|
| id           | int            | Primary Key                    |
| developer_id | int            | Foreign Key referencing developers(id) |
| title        | varchar(100)   | Game title                     |
| description  | text           | Detailed game description      |
| price        | decimal        | Game price                     |
| release_date | date           | Game release date              |
| file_path    | varchar(255)   | Path to the uploaded game file |

### Orders
| Column     | Type           | Description                    |
|------------|----------------|--------------------------------|
| id         | int            | Primary Key                    |
| customer_id| int            | Foreign Key referencing customers(id) |
| order_date | timestamp      | Timestamp of the order         |
| total      | decimal(10,2)  | Total price of the order       |

## Features
### Dynamic Forms and Comboboxes
The platform includes dynamic forms that adapt based on user interactions, allowing for flexible input, such as game selection based on developer, or address updates for customers.

### Shopping Cart
Customers can add multiple games to their cart, view the total cost, and proceed to checkout.

### File Upload and Download
Developers can upload game files, and customers can download purchased games directly from their account page.

### Reviews and Ratings
Customers can leave a review and rating for each game they purchase, helping other users make informed decisions.

### Multi-Insert/Multi-Delete
Batch operations allow for inserting or deleting multiple records (games, orders, etc.) at once, improving efficiency in data management.

## Screenshots
Screenshots of the application will be added here soon.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
