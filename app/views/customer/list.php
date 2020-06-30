<?php

$customer =  $this->registry['customer'];

foreach($customer as $cst)  :
?>

    <div class="cst">
        <p class="customer_id">Порядковий номер: <?php echo $cst['customer_id']?></p>
       
        <p> Фамілія: <span class="last_name"><?php echo $cst['last_name']?></span></p>
        <p> Імя: <?php echo $cst['first_name']?></p>
        <p> Teлефон: <span class="telephone"><?php echo $cst['telephone']?></span></p>
        <p> Email: <span class="email"><?php echo $cst['email']?></span></p>
        <p> Місто: <span class="city"><?php echo $cst['city']?></span></p>
    </div>
<?php echo "<br>"; echo "<br>"; endforeach; ?>

