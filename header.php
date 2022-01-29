<!--  printing name of movies     --------------->
<html>
 <head>
   <title>Филмов каталог</title>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Каталог филми</title>
   <link rel="stylesheet" href="src/css/style.css">
 </head>
 <body>
     <div class="header">
         <ul>
             <li>
                 <a href="index.php">Начало</a>
             </li>
             <li>
                 <a href="contacts.php">Контакти</a>
             </li>
         </ul>
         <?php if(empty($_SESSION['id'])):?>
             <div class="login-btn">
                   <a href='/login/index/'><button>Вход</button></a>
                   <a href="register.php">Регистрация</a>
             </div>
         <?php else :?>
             <div class="login-btn">
               <a href='/login/logOut/'><button>Изход</button></a>
               <a href='addMovie.php'><button>Добави филм</button></a>
             </div>
         <?php endif;?>
     </div>
  </head>
</html>
