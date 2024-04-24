<?php

class Orders extends Controller{
    public function index($order_id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		$user_id = Auth::getID();
		
		$orderModel = new Customer();
    	$orders = $orderModel->getOrders($user_id);

		// Group orders by order_details_id
		$groupedOrders = [];
		foreach ($orders as $order) {
			$orderDetailsId = $order['order_details_id'];
			if (!isset($groupedOrders[$orderDetailsId])) {
				$groupedOrders[$orderDetailsId] = [];
			}
			$groupedOrders[$orderDetailsId][] = $order;
		}

		$data['title'] = "orders";
		$data['groupedOrders'] = $groupedOrders;
		// $customer = [];
		$customer = null; 

		if ($order_id == '') {
			$url = ROOT . "/fetch/customers/" . $order_id;
			$response = file_get_contents($url);
			$customer = json_decode($response, true);

			// $data = $customer;
			$data = array_merge($data, $customer ?? []);
        	$data['orders'] = $orders;
			$this->view('customers/orders', $data);
		}
		else{
				$order_details = $orderModel->getOrderDetails($order_id);
				$order_items = $orderModel->getOrderItems($order_id);

				// Calculate total subtotal for the order
				$totalSubtotal = array_sum(array_column($order_items, 'subtotal'));

				$data['order_details'] = $order_details;
				$data['order_items'] = $order_items;
				$data['total_subtotal'] = $totalSubtotal;
				
				$this->view('customers/orders-manage', $data);
		}
	}

	public function bulkOrders()
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		$user_id = Auth::getID();
		
		$orderModel = new Customer();
		$orders = $orderModel->getBulkOrders($user_id);

		$data['title'] = "Bulk Orders";
		$data['orders'] = $orders;

		$this->view('customers/bulk-orders', $data);
	}



	// public function bulkOrders()
	// {
	// 	if (!Auth::logged_in()) {
	// 		message('Please login!!');
	// 		redirect('login');
	// 	}

	// 	$user_id = Auth::getID();
		
	// 	$orderModel = new Customer();
    // 	$orders = $orderModel->getBulkOrders($user_id);
	// 	show($orders);

	// // 	// Group orders by order_details_id
	// // 	$groupedOrders = [];
	// // 	foreach ($orders as $order) {
	// // 		$orderDetailsId = $order['order_details_id'];
	// // 		if (!isset($groupedOrders[$orderDetailsId])) {
	// // 			$groupedOrders[$orderDetailsId] = [];
	// // 		}
	// // 		$groupedOrders[$orderDetailsId][] = $order;
	// // 	}

	// 	$data['title'] = "orders";
	// // 	$data['groupedOrders'] = $groupedOrders;
	// // 	// $customer = [];
	// // 	$customer = null; 

	// // 	if ($order_id == '') {
	// // 		$url = ROOT . "/fetch/customers/" . $order_id;
	// // 		$response = file_get_contents($url);
	// // 		$customer = json_decode($response, true);

	// // 		// $data = $customer;
	// // 		$data = array_merge($data, $customer ?? []);
    // //     	$data['orders'] = $orders;
	// // 		$this->view('customers/orders', $data);
	// // 	}
	// // 	else{
	// // 			$order_details = $orderModel->getOrderDetails($order_id);
	// // 			$order_items = $orderModel->getOrderItems($order_id);

	// // 			// Calculate total subtotal for the order
	// // 			$totalSubtotal = array_sum(array_column($order_items, 'subtotal'));

	// // 			$data['order_details'] = $order_details;
	// // 			$data['order_items'] = $order_items;
	// // 			$data['total_subtotal'] = $totalSubtotal;
				
	// // 			$this->view('customers/orders-manage', $data);
	// // 	}

	// $this->view('customers/bulk-orders', $data);
	// }
}