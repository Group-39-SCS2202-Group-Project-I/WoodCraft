<?php

class Add extends Controller
{

    public function index()
    {
        $data['title'] = "AddAPI";
    }

    public function workers()
    {
        // show($_POST);

        $db = new Database();

        $address = [
            'address_line_1' => $_POST['address_line_1'],
            'address_line_2' => $_POST['address_line_1'],
            'city' => $_POST['city'],
            'zip_code' => $_POST['zip_code']
        ];

        $db->query("INSERT INTO address (address_line_1, address_line_2, city, zip_code) VALUES (:address_line_1, :address_line_2, :city, :zip_code)", $address);
        $address_id = $db->query("SELECT address_id FROM address WHERE address_id = (SELECT MAX(address_id) FROM address)")[0]->address_id;

        // show($address_id);

        $worker = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'mobile_number' => $_POST['mobile_number'],
            'address_id' => $address_id
        ];

        // show ($worker);
        // show ($address);

        
        $db->query("INSERT INTO worker (first_name, last_name, mobile_number, address_id) VALUES (:first_name, :last_name, :mobile_number, :address_id)", $worker);

    
        redirect('admin/workers');


        

    }


}