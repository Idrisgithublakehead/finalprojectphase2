<?php

require_once "Database.php";

class Crud {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connection;
    }

 
    public function createUser($fullName, $email, $password) {

        // check if email already exists
        $exists = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
        $exists->execute([$email]);

        if ($exists->rowCount() > 0) {
            return false; // email already used
        }

        
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        // insert new user
        $add = $this->conn->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );

        return $add->execute([$fullName, $email, $hashedPass]);
    }

 
    public function loginUser($email, $password) {

        $query = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // verify password
        if ($user && password_verify($password, $user["password"])) {
            return $user;
        }

        return false;
    }


 

    // Add a new product into the database
    public function createProduct($prodName, $stock, $details, $price, $imageName) {

        $stmt = $this->conn->prepare("
            INSERT INTO products (name, qty, description, price, image)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([$prodName, $stock, $details, $price, $imageName]);
    }

    // here we Fetch all products
    public function getProducts() {
        $result = $this->conn->query("SELECT * FROM products ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function getProduct($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a product
    public function updateProduct($id, $name, $qty, $desc, $price, $image) {

        $stmt = $this->conn->prepare("
            UPDATE products 
            SET name = ?, qty = ?, description = ?, price = ?, image = ?
            WHERE id = ?
        ");

        return $stmt->execute([$name, $qty, $desc, $price, $image, $id]);
    }

    // here we can Delete a product
    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }



    // this below is for a user toDelete a user from system
    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function getUsers() {
    $q = $this->conn->query("SELECT * FROM users ORDER BY id DESC");
    return $q->fetchAll(PDO::FETCH_ASSOC);
}

}

?>
