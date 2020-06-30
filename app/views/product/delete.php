<?php
$product =  $this->registry['product'];
Helper::isAdmin();
   if(CUSTOMER_ROLE==1):
?>

    <div class="product">
        <form method="POST" action="<?php echo route::getBP().'/product/delete'; ?>">
          <p><input type="hidden"name="id" value="<?php echo $product['id']; ?>"/></p>
        <p> sku: <span><?php echo $product['sku']?></span></p>
       
        <p> name: <span><?php echo $product['name']?></span></p>
         <p> price: <?php echo $product['price']?></p>
        <p> qty: <span><?php echo $product['qty']?></span></p>
         <p> description: <span><?php echo htmlspecialchars_decode($product['description']); ?></span></p>
   
        <p><input type="submit"name="delete" value="Видалити"/></p>
        </form>
    </div>
    <?php else: echo '<p style="font-size:22px; background-color:red;padding:10px 10px;">Ви не адміністратор</p>';
     endif; ?>