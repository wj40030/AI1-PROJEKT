<?php

namespace Core;

class Controller {
    public function model(string $model) {
        require_once '../app/Models/' . $model . '.php';
        $fullModelName = 'App\\Models\\' . $model;
        
        // Wstrzykiwanie zależności bazy danych
        return new $fullModelName(new Database());
    }

    public function view(string $view, array $data = []): void {
        if (file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            die('Widok nie istnieje');
        }
    }
}
