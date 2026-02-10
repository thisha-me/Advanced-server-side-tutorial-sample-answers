<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DinosaurModel extends CI_Model {

    private $periods = array(
        'Triassic' => array(
            'time' => '250–200 million years ago',
            'dinosaurs' => array(
                'Plesiosaurs',
                'Early Archosaurs',
                'Ichthyosaurs'
            )
        ),
        'Jurassic' => array(
            'time' => '200–145 million years ago',
            'dinosaurs' => array(
                'Stegosaurus',
                'Allosaurus',
                'Brachiosaurus'
            )
        ),
        'Cretaceous' => array(
            'time' => '145–66 million years ago',
            'dinosaurs' => array(
                'Tyrannosaurus Rex',
                'Triceratops',
                'Velociraptor'
            )
        )
    );

    // Return list of period names
    public function get_periods()
    {
        return array_keys($this->periods);
    }

    // Return info for one period
    public function get_period_info($period)
    {
        if (array_key_exists($period, $this->periods)) {
            return $this->periods[$period];
        }
        return NULL;
    }
}
