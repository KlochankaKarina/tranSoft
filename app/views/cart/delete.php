<form method="POST" action="<?php echo route::getBP().'/cart/delete'; ?>">
  <h3 style="background-color: #89ECBF; width:30%">Товарів у вашому кошику - <?php $model = $this->getModel('Cart'); $a=$model->countItem(); echo $t; ?></h3>
  <?php if($a != 0): ?>
<p><input type="submit"name="delete" value="Очистити корзину"/></p>
<?php endif; ?>
</form>
   