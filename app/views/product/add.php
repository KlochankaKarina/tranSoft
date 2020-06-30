<?php 
Helper::isAdmin();
   if(CUSTOMER_ROLE==1):
?>
<html>
<head>
 <title>Запись в БД через форму на php</title>
</head>
<body>
 <form method="POST" action="<?php echo route::getBP().'/product/add'; ?>">
 
 <p><input name="sku" type="text" placeholder="sku"/></p>
  <p><input name="name" type="text" placeholder="name"/></p>
   <p><input name="price" type="number" placeholder="price"/></p>
   <p><input name="qty" type="text" placeholder="qty"/></p>
   <p><input name="description" type="text" placeholder="description"/></p>
  <p><input type="submit" value="Отправить"/></p>
 </form>
</body>
</html>
<?php else: echo '<p style="font-size:22px; background-color:red;padding:10px 10px;">Ви не адміністратор</p>';
     endif; ?>