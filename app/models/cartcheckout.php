
<?php 
class Cartcheckout extends Model
{
    public $error = [];
    public $table = 'cartcheckout';

    
    public $allowedColumns = [
        'id',
        'customer_id',
        'product_id',
        'quantity',
        'created_at',
        'updated_at',
        
    ];
   public function addItemToCheckout($itemId) {
    // Insert the item into the checkout table
    $query = "INSERT INTO $this->table (item_id) VALUES (:item_id)";
    $params = [':item_id' => $itemId];

    // Execute the query
    $success = $this->query($query, $params);

    // Check if the query was successful
    if ($success) {
        return true; // Item added to checkout successfully
    } else {
        return false; // Error occurred while adding item to checkout
    }
}

}
