<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function index()
    {
        $data = array(
            'name'   => 'Tharushi Perera',
            'course' => 'BSc in Information Technology',
            'photo'  => 'https://via.placeholder.com/150'
        );

        $this->load->view('student_details', $data);
    }
} 

