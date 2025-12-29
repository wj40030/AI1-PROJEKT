<?php

namespace App\Models;

use Core\Model;

class Rating extends Model {
    protected string $table = 'ratings';

    public function addRating(array $data): bool {
        $this->db->query("INSERT INTO ratings (movie_id, rating, comment) VALUES (:movie_id, :rating, :comment)");
        $this->db->bind(':movie_id', $data['movie_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comment', $data['comment']);
        return $this->db->execute();
    }

    public function getApprovedByMovie(int $movieId): array {
        $this->db->query("SELECT * FROM ratings WHERE movie_id = :movie_id AND is_approved = 1 ORDER BY created_at DESC");
        $this->db->bind(':movie_id', $movieId);
        return $this->db->resultSet();
    }

    public function getUnapproved(): array {
        $this->db->query("SELECT r.*, m.title as movie_title FROM ratings r JOIN movies m ON r.movie_id = m.id WHERE r.is_approved = 0");
        return $this->db->resultSet();
    }

    public function approve(int $id): bool {
        $this->db->query("UPDATE ratings SET is_approved = 1 WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
