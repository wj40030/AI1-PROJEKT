<?php

namespace App\Controllers;

use Core\Controller;

class Movies extends Controller {
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

    public function index(): void {
        $filters = [
            'title' => $_GET['title'] ?? '',
            'category' => $_GET['category'] ?? '',
            'streaming' => $_GET['streaming'] ?? ''
        ];

        $data = [
            'movies' => $this->movieModel->search($filters),
            'categories' => $this->categoryModel->all(),
            'streamings' => $this->streamingModel->all(),
            'filters' => $filters
        ];

        $this->view('movies/index', $data);
    }

    public function show(int $id): void {
        $movie = $this->movieModel->getDetails($id);
        if (!$movie) {
            die('Film nie znaleziony');
        }

        $data = [
            'movie' => $movie,
            'ratings' => $this->ratingModel->getApprovedByMovie($id)
        ];

        $this->view('movies/show', $data);
    }

    public function rate(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'movie_id' => (int)$_POST['movie_id'],
                'rating' => (int)$_POST['rating'],
                'comment' => htmlspecialchars($_POST['comment'])
            ];

            if ($this->ratingModel->addRating($data)) {
                header('Location: ' . SITENAME . '/movies/show/' . $data['movie_id'] . '?success=1');
            }
        }
    }
}
