<!-- production_worker_id	production_id	worker_id	created_at	updated_at -->
<?php

class ProductionWorker extends Model
{
    public $errors = [];
    protected $table = "production_worker";

    protected $allowedColumns = [
        "production_id",
        "worker_id",
        "created_at",
        "updated_at"
    ];
}
