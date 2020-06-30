<?php

/**
 * Class Helper
 */
class Helper
{
    /**
     * @param $name
     * @return mixed
     */
    public static function getModel($name)
    {
        $model = new $name();
        return $model;
    }

    /**
     * @return mixed
     */
    public static function getMenu()
    {
        return self::getModel('menu')->initCollection()
               ->sort(array('sort_order'=>'ASC'))->getCollection()->select();
    }

    /**
     * @param $path
     * @param $name
     * @param array $params
     * @return string
     */
    public static function simpleLink($path, $name, $params = [])
    {
    	
        if (!empty($params)) {
            $firts_key = array_keys($params)[0];
            foreach($params as $key=>$value) {
                $path .= ($key === $firts_key ? '?' : '&');
                $path .= "$key=$value";
            }
        }
        return '<a href="' . route::getBP() . $path .'">' .$name . '</a>';
   
    }
 public static function redirect($path)
    {
        $server_host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        $url = $server_host . route::getBP() . $path;

        header("refresh:1;$url");
        echo '<p style="font-size:22px;background-color:#90EB99;padding:10px 10px;">Ваша дія виконана успішно</p>';
    }
   public static function maxPrice(){
    $db = new DB();
        $sql = "SELECT price FROM products WHERE price=(SELECT MAX(price) FROM products)";
       $result=$db->query($sql);
        foreach($result as $res){
        foreach ($res as $key => $value) {
        echo $value;
        }
        }
     }

    public static function isAdmin()
   {
    if($_SESSION['id']){
    $db = new DB();
        $sql = 'SELECT admin_role FROM customer WHERE customer_id='.$_SESSION['id'].' LIMIT 1';
       $result=$db->query($sql);
        foreach($result as $res){
        foreach ($res as $key => $value) {
        define('CUSTOMER_ROLE', $value);
        }
        }
    }elseif(!$_SESSION['id']){
    define('CUSTOMER_ROLE', '0');
      }
   }
      public static function getCustomer()
   {
        if (!empty($_SESSION['id'])) {
        return self::getModel('customer')->initCollection()
            ->filter(array('customer_id'=>$_SESSION['id']))
            ->getCollection()
            ->selectFirst();
        } else {
            return null;
        }

    }
}