<html>
<head>
 <title></title>
</head>
<body>
 <form method="POST" action="<?php echo route::getBP().'/customer/login'; ?>">
 <p><input name="email" type="text" placeholder="email"/></p>
  <p><input name="password" type="password" placeholder="password"/></p>
  <p><input type="submit" value="Отправить"/></p>
 </form>
</body>
</html>