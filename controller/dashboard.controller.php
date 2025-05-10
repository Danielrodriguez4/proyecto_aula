<?php
//require_once 'model/dashboard.php';

class DashboardController{

   /* private $model;

 /*   public function __CONSTRUCT(){
        $this->model = new Dashboard();
    }*/

    public function Index(){
       
        require_once 'view/header.php';
        require_once 'view/dashboard/dashboard.php';
        require_once 'view/footer.php';
    }

}