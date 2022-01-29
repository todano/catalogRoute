<form action = '<?= go('login', 'signIn')?>' method = 'POST'>
  <div>
    <h4>Username:</h4>
    <input type="text" name="username" >
  </div>
  <div>
    <h4>Password:</h4>
      <input type="password" name="password" >
  </div>
  <input type = 'submit' value = 'send'>
</form>
