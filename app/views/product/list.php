<?php
var_dump($_COOKIE);
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sortfirst'>
    
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'price_ASC' ? 'selected' : '';?> value="price_ASC">від дешевших до дорожчих</option>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'price_DESC' ? 'selected' : '';?> value="price_DESC">від дорожчих до дешевших</option>
</select>
<select name='sortsecond'>
  <option <?php echo filter_input(INPUT_POST, 'sortsecond') === 'qty_ASC' ? 'selected' : '';?>  value="qty_ASC">по зростанню кількості</option>
  <option <?php echo filter_input(INPUT_POST, 'sortsecond') === 'qty_DESC' ? 'selected' : '';?>  value="qty_DESC">по спаданню кількості</option>
</select>
<p></p>
<p style="display:inline">Ціна від: <input name="vid" type="text" placeholder="0"/></p>
  <p style="display:inline">Ціна до: <input name="do" type="text" placeholder="<?php Helper::maxPrice(); ?>"/></p>
  <p></p>
<input type="submit" name="submit" value="Submit">
</form>



<div class="product"><p>
        <?php   Helper::isAdmin(); if (CUSTOMER_ROLE==1) { echo Helper::simpleLink('/product/add', 'Додати товар'); } ?>
</p></div>

<?php

$products =  $this->registry['products'];

foreach($products as $product)  :


?>

    <div class="product">
        <p class="sku">Код: <?php echo $product['sku']?></p>
        <h4><?php echo $product['name']?><h4>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн</p>
        <p> Кількість: <?php echo $product['qty']?></p>
         <p> Опис: <?php echo htmlspecialchars_decode($product['description']); ?></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p>
            <?php Helper::isAdmin(); if (CUSTOMER_ROLE==1) { echo Helper::simpleLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); } ?>
        </p>
        <p>
            <?php  Helper::isAdmin(); if (CUSTOMER_ROLE==1) { echo Helper::simpleLink('/product/delete', 'Видалити', array('id'=>$product['id'])); } ?>
        </p>
        <p>
            <?php echo Helper::simpleLink('/cart/add', 'В корзину', array('id'=>$product['id'])); ?>
        </p>
    </div>
<?php endforeach; ?>


