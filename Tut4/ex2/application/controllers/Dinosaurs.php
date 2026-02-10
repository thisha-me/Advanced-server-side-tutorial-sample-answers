<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * @property DinosaurModel $DinosaurModel
 * @property CI_Input $input
 */
class Dinosaurs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DinosaurModel');
        $this->load->helper('url');
    }

    // Show list of periods
    public function periods()
    {
        $data['periods'] = $this->DinosaurModel->get_periods();
        $this->load->view('periods_view', $data);
    }

    // Show info for a specific period (URL segment)
    public function getinfo($period = NULL)
    {
        if ($period === NULL) {
            show_404();
        }

        $info = $this->DinosaurModel->get_period_info($period);

        if ($info === NULL) {
            show_404();
        }

        $data['period'] = $period;
        $data['info']   = $info;

        $this->load->view('period_info_view', $data);
    }
}
