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
  public function sign()
  {
    callView('Main.php','signUp.php');
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
  public function signUp()
  {
    global $con;
    $errors = [];
    if(isset($_POST)){
      $username = !empty($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
      $name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
      $lastname = !empty($_POST['lastname']) ? htmlspecialchars(trim($_POST['lastname'])) : '';
      $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
      $phone = !empty($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
      $password = !empty($_POST['password']) ? $_POST['password'] : '';
      $repassword = !empty($_POST['repassword']) ? $_POST['repassword'] : '';

    // ======== validation of input data ===========================
    // =============== name =============================
      if(!mb_strlen($name)){
        $errors['name'] = 'Please input a name.';
      } else if(mb_strlen($name) > 32){
        $errors['name'] = 'Maximum lenght of the name should be 32 symbols.';
      }
      if(!mb_strlen($lastname)) {
          $errors['lastname'] = 'Please input a lastname.';
      } else if(mb_strlen($lastname) > 32){
          $errors['lastname'] = 'Maximum lenght of the lastname should be 32 symbols.';
      }
      // =============== email ==========================
      if(!mb_strlen($email)) {
          $errors['email'] = 'Input email address.';
      } else if(mb_strlen($email) > 64){
          $errors['email'] = 'Maximum lenght of the email address is 64 symbols.';
      } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = 'Your email address is incorrect.';
      } else {
          $sql = "SELECT *
                  FROM `users`
                  WHERE `email` = '{$email}'
          ";

          $query = $con->prepare($sql);
          $query->execute();
          $checkMail = $query->fetchColumn();

          if($checkMail) {
              $errors['email'] = 'There is a user with this email already.';
          }
      }
      // ======== phone ========================
      if(!mb_strlen($phone)){
        $errors['phone'] = 'Please input phone number';
      } else if(mb_strlen($phone) < 7 || mb_strlen($phone) > 13){
        $errors['phone'] = 'Phone number should be between 7 and 13 digits.';
      }
      // =========== password =================
      if(!mb_strlen($password)){
        $errors['password'] = 'Please input your password.';
      }else if(mb_strlen($password) < 8 || mb_strlen($password) > 64){
        $errors['password'] = 'Password lenght should be between 8 and 64 symbols.';
      }

      if(!mb_strlen($repassword)) {
          $errors['repassword'] = 'Input your password again.';
      } else if($password !== $repassword){
          $errors['repassword'] = 'Password doesn\'t match.';
      }
      // === if there are no errors, register profile into database
      if(!count($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        try{
          $sql = "INSERT INTO `users` (
                    `id_user`,
                    `role`,
                    `username`,
                    `password`,
                    `email`,
                    `name`,
                    `last_name`,
                    `phone`
                  ) VALUES (
                    NULL,
                    'user',
                    '{$username}',
                    '{$password}',
                    '{$email}',
                    '{$name}',
                    '{$lastname}',
                    '{$phone}'
                )";
          $query = $con->prepare($sql);
          $query->execute($params);
        } catch (PDOException $e){
          echo 'Faild to register';
          echo $sql . "<br>" . $e->getMessage();
          die;
        }
        $linkTo = go('Login','index');
        header("location: $linkTo");//go back to home page
      } else {
          return $errors;
      }
    }
  }
}
