<?php

/**
 * Class Product
 */
class Customer extends Model
{

    /**
     * Product constructor.
     */
     function __construct()
    {
        $this->table_name = "customer";
        $this->id_column = "customer_id";
    }
    public function registrationItem($values)
    {  	
	$db=new DB();
	if(!empty($values)){
       $new_password=$_POST['new_password'];
		$values['last_name']=strip_tags($values['last_name']);
	$values['first_name']=strip_tags($values['first_name']);
	$values['telephone']=strip_tags($values['telephone']);
	$values['city']=strip_tags($values['city']);
	if(preg_match('/^[a-z0-9_\-\.]+@[a-z\.]+[a-z]{2,4}$/iu', $values['email'])){
       if($values['password']==$new_password){
		if(preg_match('/^[a-z0-9_\-\.\@\!\#\&]|[0-9]{8,12}$/iu', $values['password'])){
            $values['password']=md5($values['password']);
        $db->query("insert into $this->table_name (last_name,first_name,telephone,email,city,password) values (:last_name, :first_name, :telephone, :email, :city, :password)",$values);
        Helper::redirect('/customer/list');
      }else{
        echo '<p style="font-size:22px;background-color:red;padding:10px 10px;">Невірний пароль</p>';
    }
    }else{
        echo '<p style="font-size:22px;background-color:red;padding:10px 10px;">Не співпадають паролі</p>';
    }
    }else{
        echo '<p style="font-size:22px;background-color:red;padding:10px 10px;">Невірний email</p>';
    }
    }
    }

    }