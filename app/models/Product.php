<?php

/**
 * Class Product
 */
class Product extends Model
{
 
    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }
 	public function addItem($values)
    {  	
	$db=new DB();
	$values['sku']=strip_tags($values['sku']);
	$values['name']=strip_tags($values['name']);
    $values['description']=htmlspecialchars($values['description']);
	if(filter_var($values['price'],FILTER_VALIDATE_FLOAT) && filter_var($values['qty'],FILTER_VALIDATE_FLOAT)){
        $db->query("insert into $this->table_name (sku,name,price,qty,description) values (:sku, :name, :price, :qty, :description)",$values);
        Helper::redirect('/product/list');
   	}else{
    	echo "price/qty is not float";
    }
	}

	public function deleteItem($id)
    {
   	$db = new DB();
   	$connection=$db->getConnection();
    $sql ="DELETE FROM $this->table_name WHERE $this->id_column = '$id'";
    $stmt=$connection->query($sql);
     Helper::redirect('/product/list');
    }
  
	function saveItem($id, $values)
    { 
    $db = new DB();
    $values['sku']=strip_tags($values['sku']);
    $values['name']=strip_tags($values['name']);
    $values['description']=htmlspecialchars($values['description']);
    if(filter_var($values['price'],FILTER_VALIDATE_FLOAT) && filter_var($values['qty'],FILTER_VALIDATE_FLOAT)){
          $db->query("update $this->table_name set sku= :sku, name= :name, price= :price, qty= :qty, description= :description WHERE $this->id_column = '$id'",$values);
     Helper::redirect('/product/list');
      }else{
        echo "price/qty is not float";
    }
    }

}