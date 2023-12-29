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
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
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

    public function product_category()
    {
        show($_POST);

        $product_category = [
            'category_name' => $_POST['name']
        ];

        $data['errors'] = [];

        $product_category = new ProductCategory;

        $result = $product_category->validate($_POST);

        show(1);

        if ($result) {
            $db = new Database;

            show(2);

            $product_category = [
                'category_name' => $_POST['category_name']
            ];

            show($product_category);

            $db->query("INSERT INTO product_category (category_name) VALUES (:category_name)", $product_category);

            show(3);

            message("Product category added successfully!");
            redirect('admin/products/categories');
        } else {
            show("kes");
            // show($worker->errors);
            $data['errors'] = array_merge($product_category->errors);
            // show($data['errors']);
            show($data['errors']);

            //how to keep popup open and show errors

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form1'; // replace 'form1' with your form identifier
            redirect('admin/products/categories');
        }
    }

    public function product()
    {


        $data['errors'] = [];

        $db = new Database;

        $product_inventory = new ProductInventory;
        $product_measurement = new ProductMeasurement;
        $product = new Product;

        $_POST['quantity'] = 0;

        $result = $product->validate($_POST);
        // $result2 = $product_inventory->validate($_POST);
        $result2 = $product_measurement->validate($_POST);

        show($_POST);

        if ($result && $result2) {


            $product_inventory = [
                'quantity' => $_POST['quantity']
            ];

            // show(2);
            $db->query("INSERT INTO product_inventory (quantity) VALUES (:quantity)", $product_inventory);
            $product_inventory_id = $db->query("SELECT product_inventory_id FROM product_inventory WHERE product_inventory_id = (SELECT MAX(product_inventory_id) FROM product_inventory)")[0]->product_inventory_id;

            show(1);
            // show($product_inventory_id);

            $product_measurement = [
                'length' => $_POST['length'],
                'width' => $_POST['width'],
                'height' => $_POST['height'],
                'weight' => $_POST['weight']
            ];
            $db->query("INSERT INTO product_measurement (length, width, height, weight) VALUES (:length, :width, :height, :weight)", $product_measurement);
            $product_measurement_id = $db->query("SELECT product_measurement_id FROM product_measurement WHERE product_measurement_id = (SELECT MAX(product_measurement_id) FROM product_measurement)")[0]->product_measurement_id;

            show(2);
            // show($product_measurement_id);

            $product = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'product_category_id' => $_POST['product_category_id'],
                'product_inventory_id' => $product_inventory_id,
                'product_measurement_id' => $product_measurement_id
            ];

            show($product);

            $db->query("INSERT INTO product (name, description, price, product_category_id, product_inventory_id, product_measurement_id) VALUES (:name, :description, :price, :product_category_id, :product_inventory_id, :product_measurement_id)", $product);

            $product_id = $db->query("SELECT product_id FROM product WHERE product_id = (SELECT MAX(product_id) FROM product)")[0]->product_id;

            show(3);

            message("Product added successfully!");
            redirect('admin/products/' . $product_id);
        } else {
            show(3);
            $data['errors'] = array_merge($product->errors, $product_measurement->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST;

            redirect('admin/products/add');
        }
    }

    public function product_image()
    {
        show($_POST);
        show($_FILES);

        $folder = "uploads/images/";
        $a = 2;
        if (!file_exists($folder)) {
            $a  = 1;
            mkdir($folder, 0777, true);

            file_put_contents($folder . "index.php", "<?php //silence");
            file_put_contents("uploads/index.php", "<?php //silence");
            //display folder contains

        }
        
        $files = scandir($folder);
        show($files);



        show($a);

        $errors = [];

        $db = new Database;

        $product_image = new ProductImage;


        $allowed = ['image/jpeg', 'image/png'];

        if (!empty($_FILES['image']['name'])) {

            if ($_FILES['image']['error'] == 0) {

                if (in_array($_FILES['image']['type'], $allowed)) {
                    //everything good
                    $destination = $folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);



                    $_POST['image_url'] = $destination;
                } else {
                    $product_image->$errors['image'] = "Image type not allowed";
                }
            } else {
                $product_image->errors['image'] = "Could not upload image";
            }
        }

        if (empty($product_image->errors)) {
            $product_image_arr = [
                'image_url' => $_POST['image_url'],
                'product_id' => $_POST['product_id']
            ];
            show($product_image_arr);

            $db->query("INSERT INTO product_image (image_url, product_id) VALUES (:image_url, :product_id)", $product_image_arr);

            message("Product image added successfully!");
            redirect('admin/products/' . $_POST['product_id']);
        }
        else
        {
            show($product_image->errors);
            $_SESSION['errors'] = $product_image->errors;
            $_SESSION['form_data'] = $_POST;

            redirect('admin/products/' . $_POST['product_id']);
        }
    }
}
