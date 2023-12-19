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

        message("Customer deleted successfully");
        redirect('admin/customers');
    }

}