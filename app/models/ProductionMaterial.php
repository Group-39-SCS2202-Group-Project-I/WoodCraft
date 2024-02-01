<!-- production_material_id	production_id	material_stk_id	quantity	created_at	updated_at	 -->
<?php


class MaterialStk extends Model
{
    public $errors = [];
    protected $table = "production_material";

    protected $allowedColumns = [
        "production_material_id",
        "production_id",
        "material_stk_id",
        "quantity",
        "created_at",
        "updated_at"
    ];
}