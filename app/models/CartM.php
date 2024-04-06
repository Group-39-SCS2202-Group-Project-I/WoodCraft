
<?php 
 class CartM extends Model
 {
     public $error = [];
     public $table = 'cart';
    
     public $allowedColumns = [
         'id',
         'customer_id',
         'product_id',
         'quantity',
         'created_at',
         'updated_at',
     ];
      public $id;   
     public function setId($id){
        $this->id = $id;
     }

     public function getId(){
        return $this->id;
     }

     public function getitemsById() {
        $result = $this->select($this->table, 'customer_id = :customer_id', [':customer_id' => $this->getId()]);
        return $result;
    }
   
 
   }
