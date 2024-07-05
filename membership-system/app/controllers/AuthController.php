<?php
class AuthController
{
  private $userModel;

  public function __construct($userModel)
  {
    $this->userModel = $userModel;
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];
      $this->userModel->register($name, $email, $password, $confirmPassword);
      header('Location: /login');
    } else {
      require '../app/views/register.php';
    }
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];
      try {
        $userId = $this->userModel->login($email, $password);
        if ($userId) {
          $_SESSION['user_id'] = $userId;
          header('Location: /home');
        } else {
          echo "Invalid email or password";
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      require '../app/views/login.php';
    }
  }
}
