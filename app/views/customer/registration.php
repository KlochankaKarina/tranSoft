<html>
<head>
 <title>Реєстрація</title>
</head>
<body>
 <form method="POST" action="<?php echo route::getBP().'/customer/registration'; ?>">
 	<p><input name="last_name" type="text" placeholder="фамілія"/></p>
 	<p><input name="first_name" type="text" placeholder="імя"/></p>
 	<p><input name="telephone" type="text" placeholder="телефон"/></p>
 <p><input name="email" type="text" placeholder="email"/></p>
 <p><input name="city" type="text" placeholder="місто"/></p>
  <p><input name="password" type="password" placeholder="password"/></p>
  <p><input name="new_password" type="text" placeholder="повторіть пароль"/></p>
  <p><input type="submit" name="register" value="Зараєструватися"/></p>
 </form>
</body>
</html>