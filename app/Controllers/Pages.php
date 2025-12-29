<?php

namespace App\Controllers;

use Core\Controller;

class Pages extends Controller {
    private $exampleModel;

    public function __construct() {
        $this->exampleModel = $this->model('Example');
    }

    public function index(): void {
        $data = [
            'title' => 'Strona Główna',
            'description' => 'Projekt ai1',
            'db_test' => $this->exampleModel->getTestData()
        ];

        $this->view('pages/index', $data);
    }

    public function about(): void {
        $data = [
            'title' => 'O nas'
        ];
        $this->view('pages/about', $data);
    }
}
