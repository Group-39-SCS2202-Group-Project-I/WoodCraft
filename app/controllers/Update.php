<?php

class Update extends Controller
{

    public function index()
    {
        $data['title'] = "UpdateAPI";
    }

    public function workers($id)
    {


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
        } else {
            show(5);
            $data['errors'] = array_merge($worker->errors, $address->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('admin/workers');
        }
    }

    public function staff($id)
    {

        //fetch worker as json /fetch/workers/id
        $db = new Database();
        $data['staff'] = $db->query("SELECT * FROM staff WHERE staff_id = $id");

        show($data['staff'][0]);
        $address_id = $data['staff'][0]->address_id;
        $user_id = $data['staff'][0]->user_id;
        $email = $db->query("SELECT email FROM user WHERE user_id = $user_id")[0]->email;
        $_POST['email'] = $email;

        show($_POST);
        $data['errors'] = [];

        $staff = new Staff;
        $address = new Address;
        // $user = new User;

        $result = $staff->validate($_POST);
        $result2 = $address->validate($_POST);
        // $result3 = $user->validate($_POST);

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



            show(4);

            $staff_arr = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile_number' => $_POST['mobile_number'],
                'address_id' => $address_id,
                'user_id' => $user_id
            ];


            $db->query("UPDATE staff SET first_name = :first_name, last_name = :last_name, mobile_number = :mobile_number, address_id = :address_id, user_id = :user_id WHERE staff_id = $id", $staff_arr);
            show(5);
            message("Staff updated successfully!");
            redirect('admin/staff');
        } else {
            show(6);
            $data['errors'] = array_merge($staff->errors, $address->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('admin/staff');
        }
    }

    public function product_category($id)
    {

        $data['errors'] = [];

        $product_category = new ProductCategory;

        $result = $product_category->validate($_POST);

        show(1);

        if ($result) {
            $db = new Database;

            show(2);

            $product_category_arr = [
                'category_name' => $_POST['category_name'],
            ];

            $db->query("UPDATE product_category SET category_name = :category_name WHERE product_category_id = $id", $product_category_arr);
            show(3);
            message("Product category updated successfully!");
            redirect('admin/products/categories');
        } else {
            show(4);
            $data['errors'] = array_merge($product_category->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('admin/products/categories');
        }
    }

    public function product($id)
    {
        $data['errors'] = [];

        $db = new Database;

        $product_inventory = new ProductInventory;
        $product_measurement = new ProductMeasurement;
        $product = new Product;

        $product_id = $id;
        $product_measurement_id = $db->query("SELECT product_measurement_id FROM product WHERE product_id = $product_id")[0]->product_measurement_id;

        show($product_measurement_id);

        $result = $product->validate($_POST);
        // $result2 = $product_inventory->validate($_POST);
        $result2 = $product_measurement->validate($_POST);

        show($_POST);
        //         Array
        // (
        //     [name] => Chair
        //     [description] => paadadadda
        //     [product_category_id] => 2
        //     [price] => 131313.00
        //     [height] => 12.00
        //     [width] => 32.00
        //     [length] => 32.00
        //     [weight] => 12.00
        // )

        if ($result && $result2) {
            $product_arr = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'product_category_id' => $_POST['product_category_id'],
                'price' => $_POST['price'],
            ];

            $product_measurement_arr = [
                'height' => $_POST['height'],
                'width' => $_POST['width'],
                'length' => $_POST['length'],
                'weight' => $_POST['weight'],
            ];

            // update product

            $db->query("UPDATE product SET name = :name, description = :description, product_category_id = :product_category_id, price = :price WHERE product_id = $product_id", $product_arr);
            show("product updated");

            // update product measurement
            $db->query("UPDATE product_measurement SET height = :height, width = :width, length = :length, weight = :weight WHERE product_measurement_id = $product_measurement_id", $product_measurement_arr);
            show("product measurement updated");

            message("Product updated successfully!");
            redirect('admin/products/' . $product_id);
        } else {
            show(4);
            $data['errors'] = array_merge($product->errors, $product_measurement->errors);
            show($data['errors']);

            $_POST['product_id'] = $product_id;

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('admin/products/update/' . $product_id);
        }
    }

    public function material($id)
    {
        $data['errors'] = [];

        $material = new Material;

        $result = $material->validate($_POST);

        show(1);

        if ($result) {
            $db = new Database;

            show(2);

            $material_arr = [
                'material_name' => $_POST['name'],
                'material_description' => $_POST['description'],
            ];

            $db->query("UPDATE material SET material_name = :material_name, material_description = :material_description WHERE material_id = $id", $material_arr);
            show(3);
            message("Material updated successfully!");
            redirect('admin/materials');
        } else {
            show(4);
            $data['errors'] = array_merge($material->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('admin/materials');
        }
    }

    public function product_material($id)
    {

        show($_POST);
        $data['errors'] = [];

        $product_material = new ProductMaterial;

        $result = $product_material->validate($_POST);

        show(1);

        if ($result) {
            $db = new Database;

            show(2);

            $product_material_arr = [
                'product_id' => $_POST['product_id'],
                'material_id' => $_POST['material_id'],
                'quantity_needed' => $_POST['quantity_needed'],
            ];

            $db->query("UPDATE product_material SET product_id = :product_id, material_id = :material_id, quantity_needed = :quantity_needed WHERE product_material_id = $id", $product_material_arr);

            show(3);
            message("Product material updated successfully!");
            redirect('pm/product_materials/' . $_POST['product_id']);
        } else {
            show(4);
            $data['errors'] = array_merge($product_material->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('pm/product_materials/' . $_POST['product_id']);
        }
    }


    public function approve_mat($id)
    {
        show($id);
        //update production status to processing
        $db = new Database;
        $db->query("UPDATE production SET status = 'processing' WHERE production_id = $id");
        message("Materials approved for PXN-" . str_pad($id, 3, '0', STR_PAD_LEFT) . " successfully!");
        redirect('sk/material_requests');
    }

    public function supplier($id)
    {
        $data['errors'] = [];

        $supplier = new Supplier;
        $address = new Address;

        $result = $supplier->validate($_POST);
        $result2 = $address->validate($_POST);

        show(1);

        if ($result && $result2) {
            show(1);
            $db = new Database;

            show(2);

            $address_arr = [
                'address_line_1' => $_POST['address_line_1'],
                'address_line_2' => $_POST['address_line_2'],
                'city' => $_POST['city'],
                'zip_code' => $_POST['zip_code']
            ];


            $address_id = $db->query("SELECT address_id FROM supplier_details WHERE supplier_id = $id")[0]->address_id;

            show($address_id);

            $db->query("UPDATE address SET address_line_1 = :address_line_1, address_line_2 = :address_line_2, city = :city, zip_code = :zip_code WHERE address_id = $address_id", $address_arr);

            show(3);

            $supplier_arr = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone'],
                'brn' => $_POST['brn'],
                'address_id' => $address_id
            ];

            $db->query("UPDATE supplier_details SET name = :name, email = :email, telephone = :telephone, brn = :brn, address_id = :address_id WHERE supplier_id = $id", $supplier_arr);

            show(4);

            message("Supplier updated successfully!");
            redirect('sk/suppliers');
        } else {
            show(5);

            $data['errors'] = array_merge($supplier->errors, $address->errors);
            show($data['errors']);

            $_SESSION['errors'] = $data['errors'];
            $_SESSION['form_data'] = $_POST; // assuming the form data is in $_POST
            $_SESSION['form_id'] = 'form2'; // replace 'form2' with your form identifier
            redirect('sk/suppliers');
        }
    }

    public function add_fin_pxn($id)
    {
        show($id);

        // change finished production added to A
        $db = new Database;
        $db->query("UPDATE finished_production SET added = 'A' WHERE finished_production_id = $id");

        // get production id
        $production_id = $db->query("SELECT production_id FROM finished_production WHERE finished_production_id = $id")[0]->production_id;
        show($production_id);

        // get no_of_products from production

        $no_of_products = $db->query("SELECT quantity FROM production WHERE production_id = $production_id")[0]->quantity;
        show($no_of_products);

        // get product id
        $product_id = $db->query("SELECT product_id FROM production WHERE production_id = $production_id")[0]->product_id;
        show($product_id);

        // get product inventory id
        $product_inventory_id = $db->query("SELECT product_inventory_id FROM product WHERE product_id = $product_id")[0]->product_inventory_id;
        show($product_inventory_id);

        // get quantity
        $q = $db->query("SELECT quantity FROM product_inventory WHERE product_inventory_id = $product_inventory_id")[0]->quantity;
        show($q);

        $q = $q + $no_of_products;
        //set quantity product inventory
        $db->query("UPDATE product_inventory SET quantity = $q WHERE product_inventory_id = $product_inventory_id");

        message("Product added to stock successfully!");
        redirect('sk/finished_productions');
    }


}
