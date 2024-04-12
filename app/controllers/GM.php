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

    public function orders()
    {
        if (!Auth::logged_in()) {
            message('Please login to view the GM section');
            redirect('login');
        }

        if (!Auth::is_gm()) {
            $this->view('404');
        } else {
            $data['title'] = "GM Orders";

            $this->view('gm/orders', $data);
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
}
