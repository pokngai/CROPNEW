<?php

namespace App\Modules\Plant\Controllers;

use System\HMVC\HMVC;
use App\Models\plant as pln;
use App\Models\typeplant as typepln;
use System\Security\ACL;

class Plant extends HMVC {

    protected $dbPlant;
    protected $dbTypePlan;
    protected $row;

    public function __construct() {
        //ACL::check("STAFF");
        parent::__construct();
    }

    public function index() {
        $this->dbPlant = new pln();
        $this->dbPlant->left("plant_id", "typeplant.type_name");

        $this->view();
    }

    public function Add() {
        if (SUBMIT) {
            $this->controller();
        } else {
            $this->dbTypePlan = new typepln();
            $this->dbTypePlan->select();
            
            $this->view("Add");
        }
    }

    public function Edit() {
        $this->db = new pln();
        if (SUBMIT) {
            $this->controller();
        } else {
            $this->dbTypePlan = new typepln();
            $this->dbTypePlan->select();
            
            $this->row = $this->db->get(ID);
            $this->view("Edit");
        }
    }

    public function Delete() {
        $this->controller();
    }

}
?>
