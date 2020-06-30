<?php
class Cart extends Model
{
public static function addProduct($id){
	$id=intval($id);
	$productsInCart=array();
if(isset($_SESSION['products'])){
	$productsInCart=$_SESSION['products'];
}
if(array_key_exists($id, $productsInCart)){
$productsInCart[$id]++;
}else{
$productsInCart[$id]=1;
}
$_SESSION['products']=$productsInCart;

}

public static function countItem(){
if(isset($_SESSION['products'])){
$count=0;
foreach ($_SESSION['products'] as $id => $quantity) {
$count=$count+$quantity;
}
return $count;
}else{
return 0;
}
}

public static function deleteProduct(){
if($_POST['delete']){
unset($_SESSION['products']); 
Helper::redirect('/product/list');
}
}
}
?>