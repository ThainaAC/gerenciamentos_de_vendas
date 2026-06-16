<?php

class HomeController {
    public function index() {
        Auth::verificar();
        require "../app/views/home/index.php";
    }
}
