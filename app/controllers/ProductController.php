<?php

/**
 * Class ProductController
 */
class ProductController extends Controller
{

    /**
     *
     */
    public function IndexAction()
    {
        $this->ListAction();

    }

    /**
     *
     */
    public function ListAction()
    {
        $this->setTitle("Товари");
        $this->registry['products'] = $this->getModel('Product')->initCollection()
               ->sort($this->getSortParams())->getCollection()->select();

        $this->setView();
        $this->renderLayout();
    }


    /**
     *
     */
    public function ByidAction()
    {
        $this->setTitle("Карточка товара");
        $this->registry['product'] = $this->getModel('Product')->initCollection()
               ->filter(['id',$this->getId()])->getCollection()->selectFirst();
        $this->setView();
        $this->renderLayout();
    }

    /**
     *
     */
    public function EditAction()
    {
        $model = $this->getModel('Product');
        $this->registry['saved'] = 0;
        $this->setTitle("Редагування товару");
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            $values = $model->getPostValues();
            $this->registry['saved'] = 1;
            $model->saveItem($id,$values);
        }
        $this->registry['product'] = $model->getItem($this->getId());
        $this->setView();
        $this->renderLayout();
    }

public function DeleteAction()
    {
        $model = $this->getModel('Product');
        $this->registry['deleted'] = 0;
        $this->setTitle("Видалення товару");
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            
             $values = $model->getPostValues();
            $this->registry['deleted'] = 1;
            $model->deleteItem($id);
        }
        $this->registry['product'] = $model->getItem($this->getId());
        $this->setView();
        $this->renderLayout();
    }
    /**
     *
     */
    public function AddAction()
    {

        $model = $this->getModel('Product');
        $this->setTitle("Додавання товару");
        if ($values = $model->getPostValues()) {
            $model->addItem($values);
        }
        $this->setView();
        $this->renderLayout();
    }

    /**
     * @return array
     */
    public function getSortParams()
    {
        $params = [];
        if(filter_input(INPUT_SERVER, 'REQUEST_METHOD')==='POST'){
        	
        $sortfirst = filter_input(INPUT_POST, 'sortfirst');
        if ($sortfirst === "price_DESC") {
            $params['price'] = 'DESC';
        } else {
            $params['price'] = 'ASC';
        }
        $sortsecond = filter_input(INPUT_POST, 'sortsecond');
        if ($sortsecond === "qty_DESC") {
            $params['qty'] = 'DESC';
        } else {
            $params['qty'] = 'ASC';
        }
        $params['vid'] = filter_input(INPUT_POST, 'vid');
        $params['do'] = filter_input(INPUT_POST, 'do');
		}
    
        setcookie("testCookie", serialize($params));
        $coc=unserialize($_COOKIE['testCookie']);
        if($_SERVER['REQUEST_METHOD']=='GET'){
        return $coc;
        }
        return $params;
    }

  
    /**
     * @return array
     */
     public function UnloadAction()
    {
        $products = $this->getModel('Product')
            ->initCollection()
            ->getCollection()->select();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

        foreach ($products as $product) {
            $xmlProduct = $xml->addChild('product');
            $xmlProduct->addChild('id',$product['id']);
            $xmlProduct->addChild('sku',$product['sku']);
            $xmlProduct->addChild('name',$product['name']);
            $xmlProduct->addChild('price',$product['price']);
            $xmlProduct->addChild('qty',$product['qty']);
            $xmlProduct->addChild('description',$product['description']);
        }
        //$xml->asXML('public/products.xml');
        //echo Helper::redirectDownload('/public/products.xml');

        $dom = new DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->saveXML();

        $file = fopen('public/products.xml','w');
        fwrite($file, $dom->saveXML());
        fclose($file);
        
    
        $this->setView();
        $this->renderLayout();
       
 
    }
    public function getSortParams_old()
    {
        /*
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else 
        { 
            $sort = "name";
        }
         * 
         */
        $sort = filter_input(INPUT_GET, 'sort');
        if (!isset($sort)) {
            $sort = "name";
        }
        /*
        if (isset($_GET['order']) && $_GET['order'] == 1) {
            $order = "ASC";
        } else {
            $order = "DESC";
        }
         * 
         */
        if (filter_input(INPUT_GET, 'order') == 1) {
            $order = "DESC";
        } else {
            $order = "ASC";
        }
        
        return array($sort, $order);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        /*
        if (isset($_GET['id'])) {
         
            return $_GET['id'];
        } else {
            return NULL;
        }
        */
        return filter_input(INPUT_GET, 'id');
    }
    
    
}