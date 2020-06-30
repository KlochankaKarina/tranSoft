<?php

/**
 * Class Model
 */
class Model
{

    /**
     * @var
     */
    protected $table_name;
    /**
     * @var
     */
    protected $registry = array();
    protected $id_column;
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var
     */
    protected $collection;
    /**
     * @var
     */
    protected $sql;
    /**
     * @var array
     */
    protected $params = [];
    protected $vid;
    protected $do;
 
    /**
     * @return $this
     */
    public function initCollection()
    {
        $columns = implode(',',$this->getColumns());
        $this->sql = "select $columns from " . $this->table_name ;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);
        foreach($results as $result) {
            array_push($this->columns,$result['Field']);
        }
        return $this->columns;
    }


    /**
     * @param $params
     * @return $this
     */
    public function sort($params)
    {
        $db = new DB();
        $vid=$params['vid'];
        $do=$params['do'];
          $sql = "SELECT * FROM $this->table_name";

 if(($params['price'] == 'ASC') && ($params['qty'] == 'ASC')) {
 $this->sql .= " where price > '$vid' and price < '$do' ORDER BY price ASC, qty ASC";
 }else if(($params['price'] == 'DESC') && ($params['qty'] == 'ASC')) {
 $this->sql .= " where price>'$vid' and price <'$do' ORDER BY price DESC, qty ASC";
}else if(($params['price'] == 'ASC') && ($params['qty'] == 'DESC')) {
 $this->sql .= " where price>'$vid' and price <'$do' ORDER BY price ASC, qty DESC";
}else if(($params['price'] == 'DESC') && ($params['qty'] == 'DESC')) {
 $this->sql .= " where price>'$vid' and price <'$do' ORDER BY price DESC, qty DESC";
 }   
 return $this;
    }


    /**
     * @param $params
     */
    public function filter($params)
    {
      if(!empty($params)){
        return $this;
      }
      $i=0;
      foreach($params as $key=>$value){
        $this->sql .= $i==0?" WHERE":" AND";
        $this->sql .= " $key=?";
        $this->params[$key]=$value;
        $i++;
      }
     return $this;
    }

    /**
     * @return $this
     */
    public function getCollection()
    {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);
        return $this;
    }

    /**
     * @return mixed
     */
    public function select()
    {
        return $this->collection;
    }

    /**
     * @return null
     */
    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        $params = array($id);
        return $db->query($sql, $params)[0];
    }



    /**
     * @return array
     */
    public function getPostValues()
    {
        $values = [];
        
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            /*
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
             * 
             */
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = $column_value;
            }

        }
        return $values;
    }

    }