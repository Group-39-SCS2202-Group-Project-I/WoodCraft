<?php

class Orders extends Controller{
    public function index($order_id = '')
	{
		if (!Auth::logged_in()) {
			message('Please login!!');
			redirect('login');
		}

		$user_id = Auth::getID();
    	$orders = $this->getOrders($user_id);
		// show($orders);

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
				$order_details = $this->getOrderDetails($order_id);
				// show($order_details);
				$order_items = $this->getOrderItems($order_id);
				// show($order_items);

				// Calculate total subtotal for the order
				$totalSubtotal = array_sum(array_column($order_items, 'subtotal'));

				$data['order_details'] = $order_details;
				$data['order_items'] = $order_items;
				$data['total_subtotal'] = $totalSubtotal;
				// show($totalSubtotal);
				$this->view('customers/orders-manage', $data);
		}
	}

	private function getOrders($user_id)
	{
		$query = "SELECT od.order_details_id, od.status, od.created_at, 
						oi.quantity, 
						p.name as product_name, 
						pi.image_url as product_image_url
				FROM order_details od
				LEFT JOIN order_item oi ON od.order_details_id = oi.order_details_id
				LEFT JOIN product p ON oi.product_id = p.product_id
				LEFT JOIN product_image pi ON p.product_id = pi.product_id
				WHERE od.user_id = :user_id
				GROUP BY od.order_details_id, p.product_id
				ORDER BY od.created_at DESC";

		$params = array(':user_id' => $user_id);
		$db = new Database;
		$result = $db->query($query, $params, PDO::FETCH_ASSOC);

		return $result;
	}

	private function getOrderDetails($order_id){
		$query = "SELECT od.order_details_id, od.created_at, od.total, od.updated_at, od.status, od.delivery_cost,
						a.address_line_1, a.address_line_2, a.city,
						c.first_name, c.last_name, c.telephone
					FROM order_details od
					LEFT JOIN customer c ON od.user_id = c.user_id
					LEFT JOIN address a ON c.address_id = a.address_id
					WHERE od.order_details_id = :order_id
					GROUP BY od.order_details_id";

		$params = array(':order_id' => $order_id);
		$db = new Database;
		$result = $db->query($query, $params, PDO::FETCH_ASSOC);

		return $result;
	}

	private function getOrderItems($order_id){
		$query = "SELECT oi.quantity, p.name AS product_name, p.price, 
						pi.image_url as product_image_url 
					FROM order_item oi
					LEFT JOIN product p ON oi.product_id = p.product_id
					LEFT JOIN product_image pi ON p.product_id = pi.product_id
					WHERE oi.order_details_id = :order_id
					GROUP BY p.product_id";

		$params = array(':order_id' => $order_id);
		$db = new Database;
		$result = $db->query($query, $params, PDO::FETCH_ASSOC);

		// Calculate subtotal for each order item
		foreach ($result as &$item) {
			$item['subtotal'] = $item['quantity'] * $item['price'];
		}

		return $result;
	}
}