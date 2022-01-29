<?php
namespace Tod\Controllers;

class Login
{
  protected $username;
  protected $password;
  public function __construct()
  {

  }
  public function index()
  {
    callView('Main.php','signIn.php');
  }
  public function signIn()
  {
    global $con;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT *
            FROM users
            WHERE username ='$username'";
    $query = $con->prepare($sql);
    $query->execute();
    $log = $query->fetchColumn(); // kato num_rows
    $query->execute();
    $user = $query->fetch(\PDO::FETCH_ASSOC);
    if($log && password_verify($_POST['password'],$user['password'])){//if log in is successful start session with users id
      $_SESSION['user'] = [
          'id_user' => $user['id_user'],
          'role' => $user['role'],
          'username' => $user['username'],
          'email' => $user['email']
        ];
      $linkTo = go('Main','index');
      header("location: $linkTo");//go back to home page
    } else{
      $linkTo = go('Login','index');
      header("location: $linkTo");//go back to home page
    }
  }
  public function logOut()
  {
    session_destroy();
    $linkTo = go('Main','index');
    header("location: $linkTo");//go back to home page
  }
}
