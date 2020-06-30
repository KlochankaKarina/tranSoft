<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php 

        $menu = Helper::getMenu();
        foreach($menu as $item)  :
    ?>
        <li>
            <?php 
            echo Helper::simpleLink($item['path'], $item['name']); 
?>
        </li>
    <?php endforeach; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo route::getBP().'/cart/delete/';  ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина<span id="cart_count">(<?php $model = $this->getModel('Cart'); $a=$model->countItem(); echo $a; ?>)</span></a></li>
        <?php Helper::isAdmin(); if (CUSTOMER_ROLE == 1): ?>
        <li><a href="<?php echo route::getBP().'/product/unload/';  ?>"><span class="glyphicon glyphicon-download-alt"></span> Експорт в Хml</a></li>
<?php endif; ?>
        <li><a href="<?php if($_SESSION['name']){ echo route::getBP().'/customer/cabinet/'; }else{ echo route::getBP().'/customer/registration'; } ?>"><span class="glyphicon glyphicon-user"></span> <?php
if($_SESSION['name']){    
     echo $_SESSION['name'];
 }else{
    echo " Зареєструватися";
 }
?></a></li>
        <li><a href="<?php if($_SESSION['name']){ echo route::getBP().'/customer/logout/'; }else{ echo route::getBP().'/customer/login/'; } ?>"><span class="glyphicon glyphicon-log-in"></span> <?php
if($_SESSION['name']){    
     echo " Вийти";
 }else{
    echo " Увійти";
 }
?></a></li>
    </ul>
  </div>
</nav>