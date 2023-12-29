<?php

class Delete extends Controller
{

    public function index()
    {
        $data['title'] = "DeleteApi";
    }

    public function customers($id)
    {
        $db = new Database();

        $customer = $db->query("SELECT * FROM customer WHERE customer_id = $id");
        $address_id = $customer[0]->address_id;
        $user_id = $customer[0]->user_id;
        $db->query("DELETE FROM customer WHERE customer_id = $id");
        $db->query("DELETE FROM user WHERE user_id = $user_id");
        $db->query("DELETE FROM address WHERE address_id = $address_id");

        message("Customer deleted successfully!");
        redirect('admin/customers');
    }

    public function workers($id)
    {
        $db = new Database();

        $worker = $db->query("SELECT * FROM worker WHERE worker_id = $id");
        $address_id = $worker[0]->address_id;
        $db->query("DELETE FROM worker WHERE worker_id = $id");
        $db->query("DELETE FROM address WHERE address_id = $address_id");
        message("Worker deleted successfully!");
        redirect('admin/workers');
    }

    public function staff($id)
    {
        $db = new Database();

        $staff = $db->query("SELECT * FROM staff WHERE staff_id = $id");
        $address_id = $staff[0]->address_id;
        $user_id = $staff[0]->user_id;
        $db->query("DELETE FROM staff WHERE staff_id = $id");
        $db->query("DELETE FROM user WHERE user_id = $user_id");
        $db->query("DELETE FROM address WHERE address_id = $address_id");

        message("Staff deleted successfully!");
        redirect('admin/staff');
    }

    public function product_categories($id)
    {
        $db = new Database();

        $db->query("DELETE FROM product_category WHERE product_category_id = $id");

        message("Product category deleted successfully!");
        redirect('admin/products/categories');
    }

    public function product_images($id)
    {
        $db = new Database();

        $product_id = $db->query("SELECT product_id FROM product_image WHERE product_image_id = $id")[0]->product_id;

        $db->query("DELETE FROM product_image WHERE product_image_id = $id");

        message("Product image deleted successfully!");
        redirect('admin/products/' . $product_id);
    }

    public function products($id)
    {
        $db = new Database();

        $product_measurement = $db->query("SELECT * FROM product_measurement WHERE product_id = $id");
        $product_measurement_id = $product_measurement[0]->product_measurement_id;

        $product_inventory = $db->query("SELECT * FROM product_inventory WHERE product_id = $id");
        $product_inventory_id = $product_inventory[0]->product_inventory_id;

        //get all product images
        $product_images = $db->query("SELECT * FROM product_image WHERE product_id = $id");

        //delete all product images
        foreach ($product_images as $product_image) {
            $product_image_id = $product_image->product_image_id;
            $db->query("DELETE FROM product_image WHERE product_image_id = $product_image_id");
        }

        $db->query("DELETE FROM product_inventory WHERE product_inventory_id = $product_inventory_id");

        $db->query("DELETE FROM product_measurement WHERE product_measurement_id = $product_measurement_id");

        $db->query("DELETE FROM product WHERE product_id = $id");

        message("Product deleted successfully!");
        redirect('admin/products');
    }

}