
<?php 
 class Cart extends Model
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
        $result = $this->select($this->table, 'id = :cid', [':cid' => $this->getId()]);
        return $result;
    }
   
 
   }
