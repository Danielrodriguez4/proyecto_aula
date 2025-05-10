<?php
require_once 'model/user.php';


class LogoutController{

    public function Index(){
        session_destroy();
        header('Location: /');
    }
}