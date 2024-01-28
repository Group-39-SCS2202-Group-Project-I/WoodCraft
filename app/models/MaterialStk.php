<!-- stock_no	material_order_id	material_id	quantity	price_per_unit	created_at	 -->
<?php


class MaterialStk extends Model
{
    public $errors = [];
    protected $table = "material_stk";

    protected $allowedColumns = [
        "stock_no",
        "material_order_id",
        "material_id",
        "quantity",
        "price_per_unit",
        "created_at"
    ];
}