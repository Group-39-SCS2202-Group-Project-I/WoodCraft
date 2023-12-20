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
        $address = [
            'address_line_1' => $_POST['address_line_1'],
            'address_line_2' => $_POST['address_line_1'],
            'city' => $_POST['city'],
            'zip_code' => $_POST['zip_code']
        ];

        $worker = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'mobile_number' => $_POST['mobile_number'],
        ];

        $data['errors'] = [];

        $worker = new Worker;
        $address = new Address;

        $result = $worker->validate($_POST);
        $result2 = $address->validate($_POST);

        show(1);

        if ($result && $result2) {
            $db = new Database;

            show(2);

            $address = [
                'address_line_1' => $_POST['address_line_1'],
                'address_line_2' => $_POST['address_line_2'],
                'city' => $_POST['city'],
                'zip_code' => $_POST['zip_code']
            ];

            $db->query("INSERT INTO address (address_line_1, address_line_2, city, zip_code) VALUES (:address_line_1, :address_line_2, :city, :zip_code)", $address);
            $address_id = $db->query("SELECT address_id FROM address WHERE address_id = (SELECT MAX(address_id) FROM address)")[0]->address_id;

            // show($address_id);

            show(3);
            // $worker['address_id'] = $address_id;

            $worker = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile_number' => $_POST['mobile_number'],
                'address_id' => $address_id
            ];

            show($worker);
            // show ($address);


            $db->query("INSERT INTO worker (first_name, last_name, mobile_number, address_id) VALUES (:first_name, :last_name, :mobile_number, :address_id)", $worker);
            show(4);

            message("Worker added successfully!");
            redirect('admin/workers');
        } else {
            // show("kes");
            // show($worker->errors);
            $data['errors'] = array_merge($worker->errors, $address->errors);
            // show($data['errors']);

            //how to keep popup open and show errors

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form1'; // replace 'form1' with your form identifier
            redirect('admin/workers');


            // $this->view('admin/workers', $data);
        }
    }

    public function staff()
    {
        show($_POST);

        // add confirmation password
        $_POST['confirm_password'] = $_POST['password'];

        $address = [
            'address_line_1' => $_POST['address_line_1'],
            'address_line_2' => $_POST['address_line_1'],
            'city' => $_POST['city'],
            'zip_code' => $_POST['zip_code']
        ];

        $staff = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'mobile_number' => $_POST['mobile_number'],
        ];

        $user = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'confirm_password' => $_POST['confirm_password'],
            'role' => $_POST['role']
        ];

        show($address);
        show($staff);
        show($user);

        $data['errors'] = [];

        $staff = new Staff;
        $address = new Address;
        $user = new User;

        $result = $staff->validate($_POST);
        $result2 = $address->validate($_POST);
        $result3 = $user->validate($_POST);

        show(1);

        if ($result && $result2 && $result3) {
            $db = new Database;

            show(2);

            $address = [
                'address_line_1' => $_POST['address_line_1'],
                'address_line_2' => $_POST['address_line_2'],
                'city' => $_POST['city'],
                'zip_code' => $_POST['zip_code']
            ];

            $db->query("INSERT INTO address (address_line_1, address_line_2, city, zip_code) VALUES (:address_line_1, :address_line_2, :city, :zip_code)", $address);
            $address_id = $db->query("SELECT address_id FROM address WHERE address_id = (SELECT MAX(address_id) FROM address)")[0]->address_id;

            show($address_id);

            show(3);
            $user = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            ];

            $db->query("INSERT INTO user (email, password, role) VALUES (:email, :password, :role)", $user);
            // $user_id = $db->query("SELECT user_id FROM user WHERE email = :email", $user)[0]->email;
            $user_id = $db->query("SELECT user_id FROM user WHERE user_id = (SELECT MAX(user_id) FROM user)")[0]->user_id;

            show($user_id);

            show(4);

            $staff = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile_number' => $_POST['mobile_number'],
                'address_id' => $address_id,
                'user_id' => $user_id
            ];

            $db->query("INSERT INTO staff (first_name, last_name, mobile_number, address_id, user_id) VALUES (:first_name, :last_name, :mobile_number, :address_id, :user_id)", $staff);
            show(5);

            message("Staff member added successfully!");
            redirect('admin/staff');
        } else {
            show("kes");
            // show($worker->errors);
            $data['errors'] = array_merge($staff->errors, $address->errors, $user->errors);
            // show($data['errors']);
            show($data['errors']);

            //how to keep popup open and show errors

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form1'; // replace 'form1' with your form identifier
            redirect('admin/staff');
        }
    }
}
