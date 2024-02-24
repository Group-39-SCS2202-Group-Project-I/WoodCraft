<?php

class Customer extends Controller {

    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }

        $data['title'] = "manage-account";

        $this->view('manage/manage-account', $data);
    }

    public function profile($id = null)
    {
        if (!Auth::logged_in()) {
            message('Please login to view your account');
            redirect('login');
        }

        $id = $id ?? Auth::getId();

        $user = new User();
        $data['row'] = $user->first(['id' => $id]);

        $addressModel = new Address();
        $customerData['address_id'] = $data['row']->address_id ?? null;

        if ($customerData['address_id']) {
            $data['address'] = $addressModel->first(['id' => $customerData['address_id']]);
        }

        if ($data['row']) {
            $data['title'] = "Manage Account";
            $data['errors'] = $user->errors;
        
            $this->view('manage/manage-account', $data);
        }
    }

}
