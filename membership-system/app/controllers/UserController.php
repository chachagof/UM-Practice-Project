<?php
class UserController
{
  private $userModel;

  public function __construct($userModel)
  {
    $this->userModel = $userModel;
  }

  public function home()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }
    $user = $this->userModel->getUserById($_SESSION['user_id']);
    $userName = htmlspecialchars($user['name']); 
    $userEmail = htmlspecialchars($user['email']);
    require '../app/views/home.php';
  }

  public function members()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }
    $user = $this->userModel->getUserById($_SESSION['user_id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $this->userModel->updateUser($_SESSION['user_id'], $name, $email, $password);
      header('Location: /home');
    } else {
      require '../app/views/members.php';
    }
  }

  public function logout()
  {
    session_unset();
    session_destroy();
    header('Location: /login');
    exit();
  }

  public function userList()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }
    $users = $this->userModel->getAllUsers();
    require '../app/views/userList.php';
  }

  public function deleteUser()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }
    if (isset($_POST['user_id']) && $_POST['user_id'] == $_SESSION['user_id']) {
      $this->userModel->deleteUser($_SESSION['user_id']);
      session_unset();
      session_destroy();
      header('Location: /login');
      exit();
    } else {
      echo "Unauthorized action";
    }
  }
}
