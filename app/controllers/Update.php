<?php

class Update extends Controller
{

    public function index()
    {
        $data['title'] = "UpdateAPI";
    }

    public function workers($id)
    {
        show($_POST);
        //fetch worker as json /fetch/workers/id
        $db = new Database();
        $data['worker'] = $db->query("SELECT * FROM worker WHERE worker_id = $id");

        show($data['worker'][0]);
        $address_id = $data['worker'][0]->address_id;

        $data['errors'] = [];

        $worker = new Worker;
        $address = new Address;

        $result = $worker->validate($_POST);
        $result2 = $address->validate($_POST);

        show(1);
        if ($result && $result2) {
            $db = new Database;

            show(2);

            $address_arr = [
                'address_line_1' => $_POST['address_line_1'],
                'address_line_2' => $_POST['address_line_2'],
                'city' => $_POST['city'],
                'zip_code' => $_POST['zip_code']
            ];

            $db->query("UPDATE address SET address_line_1 = :address_line_1, address_line_2 = :address_line_2, city = :city, zip_code = :zip_code WHERE address_id = $address_id", $address_arr);

            show(3);
            // $worker['address_id'] = $address_id;

            $worker = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile_number' => $_POST['mobile_number'],
                'address_id' => $address_id
            ];

            $db->query("UPDATE worker SET first_name = :first_name, last_name = :last_name, mobile_number = :mobile_number, address_id = :address_id WHERE worker_id = $id", $worker);

            show(4);

            message("Worker updated successfully!");
            redirect('admin/workers');


        }
        else
        {
            show(5);
            $data['errors'] = array_merge($worker->errors, $address->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('admin/workers');

        }
    }
}
