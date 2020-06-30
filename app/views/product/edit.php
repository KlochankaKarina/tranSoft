<?php
$product =  $this->registry['product'];
Helper::isAdmin();
   if(CUSTOMER_ROLE==1):

?>

    <div class="product">
        <form method="POST" action="<?php echo route::getBP().'/product/edit'; ?>">
        	<p><input name="id" type="hidden" value="<?php echo $product['id']?>"></p>
 <p><input name="sku" type="text" value="<?php echo $product['sku']?>"></p>
 
        <p><input name="name" type="text" value="<?php echo $product['name']?>"></p>
        <p><input name="price" type="text" value="<?php echo $product['price']?>"></p>
        <p><input name="qty" type="text" value="<?php echo $product['qty']?>"></p>
        <p><input name="description" type="text" value='<?php echo htmlspecialchars_decode($product['description']); ?>'></p>
        <p><input type="submit"name="save" value="Сохранить"/></p>
        </form>
    </div>
<?php else: echo '<p style="font-size:22px; background-color:red;padding:10px 10px;">Ви не адміністратор</p>';
     endif; ?>
