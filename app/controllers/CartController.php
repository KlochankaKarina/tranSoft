<?php
	class CartController extends Controller
	{

	public function AddAction(){
	$model = $this->getModel('Cart');
    $this->setTitle("Додавання в кошик");   
    $model->addProduct($id);
	$referrer=$_SERVER['HTTP_REFERER'];
	header("Location: $referrer");
	}

	public function DeleteAction(){
	$model = $this->getModel('Cart');
    $this->setTitle("Очищення кошика");
    $model->deleteProduct();
	$this->setView();
    $this->renderLayout();
	}
	}