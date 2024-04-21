<?php


class GM extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {
            $data['title'] = "GM Dashboard";

            $this->view('gm/dashboard', $data);
        }
    }

    public function dashboard()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {
            $data['title'] = "GM Dashboard";

            $this->view('gm/dashboard', $data);
        }
    }

    public function orders($x = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {
            $data['title'] = "GM Orders";

            if ($x == 'retail') {
                $this->view('gm/retail', $data);
            } else if ($x == 'bulk') {
                $this->view('gm/bulk', $data);
            } else {
                $this->view('gm/orders', $data);
            }
        }
    }

    public function productions($id = '', $start_date = '', $end_date = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {
            $data['id'] = $id;

            if ($id == '') {
                $data['title'] = "GM Productions";
                $this->view('gm/productions', $data);
            } else if ($id != 'report') {
                $data['title'] = "GM Productions";


                $id = $data['id'];
                $url = ROOT . "/fetch/production/$id";
                $response = file_get_contents($url);
                $production = json_decode($response);

                $data['production'] = $production;



                $url = ROOT . "/fetch/production_workers/$id";
                $response = file_get_contents($url);
                $workers = json_decode($response, true);

                $workers_count = count($workers);
                $data['workers_count'] = $workers_count;

                $no_car = 0;
                $no_sup = 0;
                $no_paint = 0;

                foreach ($workers as $worker) {
                    if ($worker['worker_role'] == 'carpenter') {
                        $no_car++;
                    } elseif ($worker['worker_role'] == 'supervisor') {
                        $no_sup++;
                    } elseif ($worker['worker_role'] == 'painter') {
                        $no_paint++;
                    }
                }

                $data['no_car'] = $no_car;
                $data['no_sup'] = $no_sup;
                $data['no_paint'] = $no_paint;

                $data['workers'] = $workers;


                $url = ROOT . "/fetch/production_material/$id";
                $response = file_get_contents($url);
                $materials = json_decode($response, true);

                $data['materials'] = $materials;


                $total_cost = 0;
                foreach ($materials as $material) {
                    $total_cost += $material['cost'];
                }

                $data['total_cost'] = $total_cost;

                $delivery = new Delivery();
                $data['delivery_info'] = $delivery->getDeliveryInfo();

                $this->view('gm/production', $data);
            } else {
                $data['title'] = "GM Productions";
                $data['start_date'] = $start_date;
                $data['end_date'] = $end_date;

                // 
                $url = ROOT . "/fetch/production";
                $response = file_get_contents($url);
                $productions = json_decode($response, true);
                // show($productions);

                $pending = [];
                $processing = [];
                $completed = [];

                foreach ($productions as $production) {
                    if ($production['status'] == 'pending') {
                        $pending[] = $production;
                    } elseif ($production['status'] == 'processing') {
                        $processing[] = $production;
                    } elseif ($production['status'] == 'completed') {
                        $completed[] = $production;
                    }
                }

                // show($pending);
                // show($processing);
                // show($completed);



                // $pen_count = 0;
                // $pro_count = 0;
                // $com_count = 0;

                if ($pending) {
                    $pen_count = count($pending);
                }
                if ($processing) {
                    $pro_count = count($processing);
                }
                if ($completed) {
                    $com_count = count($completed);
                }



                // show($completed);
                // $comjson = json_encode($completed);

                // filter $completed within the date range
                $filtered = [];
                if ($start_date != '' && $end_date != '') {
                    foreach ($completed as $com) {
                        $date = $com['updated_at'];
                        if ($date >= $start_date && $date <= $end_date) {
                            $filtered[] = $com;
                        }
                    }
                }

                $count = count($filtered);

                $data['pxn'] = $filtered;
                $data['count'] = $count;

                $delivery = new Delivery();
                $data['delivery_info'] = $delivery->getDeliveryInfo();


                $this->view('gm/rpt', $data);
            }
        }
    }

    public function workers($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {
            $data['id'] = $id;

            if ($id == '') {
                $data['title'] = "GM Workers";
                $this->view('gm/workers', $data);
            } else {
                $data['title'] = "GM Workers";
                $this->view('gm/worker', $data);
            }
        }
    }

    public function bulk_order_requests($id = '')
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {

            if ($id == '') {
                $url = ROOT . "/fetch/new_bulk_req";
                $response = file_get_contents($url);
                $bulk_reqs = json_decode($response, true);

                $data['new_bulk_requests'] = $bulk_reqs;

                $url2 = ROOT . "/fetch/bulk_req";
                $response2 = file_get_contents($url2);
                $bulk_reqs2 = json_decode($response2, true);

                $data['bulk_requests'] = $bulk_reqs2;

                $this->view('gm/bulk_req', $data);
            }
            else
            {
                $url = ROOT . "/fetch/bulk_req_by_id/$id";
                $response = file_get_contents($url);
                $bulk_req = json_decode($response, true);

                $data['bulk_req'] = $bulk_req;
                $this->view('gm/bulk_req_details', $data);
            }
        }
    }
}
