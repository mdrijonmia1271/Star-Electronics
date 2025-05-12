<?php

class Overtime extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('action');
        $this->data['employee'] = $this->allEmployee();
    }

    public function index()
    {
        $this->data['meta_title']   = 'Overtime';
        $this->data['active']       = 'data-target="overtime_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = null;


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/overtime/nav', $this->data);
        $this->load->view('components/overtime/add', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function store()
    {
        if (isset($_POST['save'])) {

            //converting time formate from am/pm to 24 hour formate
            $start_time = date('Y-m-d H:i:s', strtotime($_POST['start_time']));
            $end_time   = date('Y-m-d H:i:s', strtotime($_POST['end_time']));

            $data = [
                "date"        => input_data('date'),
                "emp_id"      => input_data('emp_id'),
                "start_time"  => $start_time,
                "end_time"    => $end_time,
                "hourly_rate" => input_data('hourly_rate')
            ];

            $options = [
                "title" => "Success",
                "emit"  => "Data Successfully Saved",
                "btn"   => true
            ];

            save_data('overtime', $data);

            $this->session->set_flashdata('confirmation', message('success', $options));
            redirect('overtime/overtime', 'refresh');
        }
    }

    public function all()
    {
        $this->data['meta_title'] = 'View All';
        $this->data['active']     = 'data-target="overtime_menu"';
        $this->data['subMenu']    = 'data-target="all"';

        $where = ['overtime.trash' => 0];
        if (isset($_POST['show'])) {

            foreach ($_POST['search'] as $key => $val) {
                if (!empty($val)) {
                    $where["overtime.$key"] = $val;
                }
            }

            foreach ($_POST['date'] as $key => $val) {

                if (!empty($val) && $key == 'from') {
                    $where['overtime.date >='] = $val;
                }

                if (!empty($val) && $key == 'to') {
                    $where['overtime.date <='] = $val;
                }
            }

        } else {
            $where['YEAR(overtime.date)'] = date('Y');
            $where['MONTH(overtime.date)'] = date('m');
        }


        $this->data['result'] = get_join('overtime', 'employee', 'overtime.emp_id=employee.emp_id', $where, ['overtime.*', 'employee.name']);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/overtime/nav', $this->data);
        $this->load->view('components/overtime/all', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    // delete over time data
    public function delete($id = null)
    {
        $options = array(
            'title' => 'delete',
            'emit'  => 'Information Successfully Deleted!',
            'btn'   => true
        );

        // delete data
        save_data('overtime', ['trash' => 1], ['id' => $id]);

        $this->session->set_flashdata('confirmation', message('success', $options));

        redirect('overtime/overtime/all', 'refresh');
    }

    // get all employee
    private function allEmployee()
    {
        $result = get_result("employee", ['status' => 'active'], ['emp_id', 'name'], "", "id", "asc");
        return $result;
    }
}