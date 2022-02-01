  <h2>Register to moviecatalog</h2>
    <form action = '<?= go('login', 'singUp')?>' method = 'POST'>
      <div>
        <h4>Username:</h4>
        <input type="text" name="username" placeholder="Въведете име" >
      </div>
      <div>
        <h4>Name:</h4>
        <input type="text" name="name" placeholder="Въведете име" >
      </div>
      <div>
        <h4>Lastname:</h4>
         <input type="text" name="lastname" placeholder="Въведете фамилия" >
      </div>
      <div>
       <h4>Email:</h4>
        <input type="email" name="email" placeholder="Въведете имейл адрес" >
     </div>
     <div>
       <h4>Phone number:</h4>
         <input type="text" name="phone" placeholder="Въведете телефонен номер" >
     </div>
     <div>
       <h4>Password:</h4>
         <input type="password" name="password" placeholder="Въведете парола" >
     </div>
     <div style="margin-bottom: 25px;">
       <h4>Confirm your password:</h4>
         <input type="password" name="repassword" placeholder="Повтори парола" >
     </div>
     <div>
       <input type="submit" name="register" value="Sign In">
     </div>
  </form>
