<?php

namespace App\Controllers;

use Core\Controller;

class Admin extends Controller {
    private $movieModel;
    private $categoryModel;
    private $streamingModel;
    private $ratingModel;

    public function __construct() {
        $this->movieModel = $this->model('Movie');
        $this->categoryModel = $this->model('Category');
        $this->streamingModel = $this->model('Streaming');
        $this->ratingModel = $this->model('Rating');
    }

    private function isLoggedIn(): bool {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    public function index(): void {
        if (!$this->isLoggedIn()) {
            $this->login();
            return;
        }

        $data = [
            'movies' => $this->movieModel->all(),
            'categories' => $this->categoryModel->all(),
            'streamings' => $this->streamingModel->all(),
            'unapproved_ratings' => $this->ratingModel->getUnapproved()
        ];

        $this->view('admin/dashboard', $data);
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Zakodowane na stałe dane logowania
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['admin_logged_in'] = true;
                header('Location: ' . URLROOT . '/admin');
                return;
            } else {
                $data['error'] = 'Błędne dane logowania';
            }
        }

        $this->view('admin/login', $data ?? []);
    }

    public function logout(): void {
        unset($_SESSION['admin_logged_in']);
        session_destroy();
        header('Location: ' . URLROOT . '/movies');
    }

    // Proste akcje moderacji
    public function approve_rating(int $id): void {
        if (!$this->isLoggedIn()) return;
        $this->ratingModel->approve($id);
        header('Location: ' . URLROOT . '/admin');
    }

    public function delete_rating(int $id): void {
        if (!$this->isLoggedIn()) return;
        $this->ratingModel->delete($id);
        header('Location: ' . URLROOT . '/admin');
    }

    // Zarządzanie filmami
    public function add_movie(): void {
        if (!$this->isLoggedIn()) return;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'release_year' => (int)$_POST['release_year'],
                'is_series' => isset($_POST['is_series']) ? 1 : 0,
                'categories' => $_POST['categories'] ?? [],
                'streamings' => $_POST['streamings'] ?? []
            ];
            $this->movieModel->save($movieData);
            header('Location: ' . URLROOT . '/admin');
        }
    }

    public function delete_movie(int $id): void {
        if (!$this->isLoggedIn()) return;
        $this->movieModel->delete($id);
        header('Location: ' . URLROOT . '/admin');
    }

    // Zarządzanie kategoriami
    public function add_category(): void {
        if (!$this->isLoggedIn()) return;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['name' => $_POST['name']];
            $this->categoryModel->save($data);
            header('Location: ' . URLROOT . '/admin');
        }
    }

    public function delete_category(int $id): void {
        if (!$this->isLoggedIn()) return;
        $this->categoryModel->delete($id);
        header('Location: ' . URLROOT . '/admin');
    }

    // Zarządzanie streamingami
    public function add_streaming(): void {
        if (!$this->isLoggedIn()) return;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'url' => $_POST['url']
            ];
            $this->streamingModel->save($data);
            header('Location: ' . URLROOT . '/admin');
        }
    }

    public function delete_streaming(int $id): void {
        if (!$this->isLoggedIn()) return;
        $this->streamingModel->delete($id);
        header('Location: ' . URLROOT . '/admin');
    }
}
