<?php
namespace App\Modules\ProductUnit\Controllers;
 use System\HMVC\HMVC;
 use App\Models\product_unit; 
 use System\Utils\JS;
 
 class Delete extends HMVC{
     public function index() {
        $std =  new product_unit();
        if($std->delete(ID)){
            echo JS::deleteComplate();
            echo JS::re($this->route->backToModule().'///' . $this->param(1));
        }else{
            echo JS::deleteFail();
            echo JS::back();
        }
    }

  
}
?>