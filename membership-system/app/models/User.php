<?php
class User
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function register($name, $email, $password)
  {
    // 檢查電子郵件是否已經存在
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      throw new Exception("Email already exists");
    }

    $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stmt->execute();

    return true;
  }

  public function login($email, $password)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      return $user['id'];
    }

    return false;
  }

  public function getUserById($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function updateUser($id, $name, $email, $password)
  {
    $stmt = $this->db->prepare("UPDATE users SET name = :name, password = :password WHERE id = :id");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return true;
  }

  public function getAllUsers()
  {
    try {
      $stmt = $this->db->query("SELECT id, name, email FROM users");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Fetch all users failed: " . $e->getMessage() . "<br>";
      return [];
    }
  }

  public function deleteUser($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Delete user failed: " . $e->getMessage() . "<br>";
      return false;
    }
  }
}
