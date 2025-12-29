<?php

namespace App\Models;

use Core\Model;

class Movie extends Model {
    protected string $table = 'movies';

    public function search(array $filters = []): array {
        $sql = "SELECT m.*, 
                GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') as categories,
                GROUP_CONCAT(DISTINCT s.name SEPARATOR ', ') as streamings
                FROM movies m
                LEFT JOIN movie_categories mc ON m.id = mc.movie_id
                LEFT JOIN categories c ON mc.category_id = c.id
                LEFT JOIN movie_streamings ms ON m.id = ms.movie_id
                LEFT JOIN streamings s ON ms.streaming_id = s.id";

        $where = [];
        $params = [];

        if (!empty($filters['title'])) {
            $where[] = "m.title LIKE :title";
            $params[':title'] = '%' . $filters['title'] . '%';
        }

        if (!empty($filters['category'])) {
            $where[] = "c.id = :category";
            $params[':category'] = $filters['category'];
        }

        if (!empty($filters['streaming'])) {
            $where[] = "s.id = :streaming";
            $params[':streaming'] = $filters['streaming'];
        }

        if ($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " GROUP BY m.id";

        $this->db->query($sql);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }

        return $this->db->resultSet();
    }

    public function getDetails(int $id) {
        $this->db->query("SELECT m.*, 
                GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') as categories
                FROM movies m
                LEFT JOIN movie_categories mc ON m.id = mc.movie_id
                LEFT JOIN categories c ON mc.category_id = c.id
                WHERE m.id = :id
                GROUP BY m.id");
        $this->db->bind(':id', $id);
        $movie = $this->db->single();

        if ($movie) {
            $this->db->query("SELECT s.name, ms.seasons, s.url 
                            FROM movie_streamings ms 
                            JOIN streamings s ON ms.streaming_id = s.id 
                            WHERE ms.movie_id = :id");
            $this->db->bind(':id', $id);
            $movie->streamings = $this->db->resultSet();
        }

        return $movie;
    }

    public function save(array $data): bool {
        if (isset($data['id'])) {
            $this->db->query("UPDATE movies SET title = :title, description = :description, release_year = :release_year, is_series = :is_series WHERE id = :id");
            $this->db->bind(':id', $data['id']);
        } else {
            $this->db->query("INSERT INTO movies (title, description, release_year, is_series) VALUES (:title, :description, :release_year, :is_series)");
        }
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':release_year', $data['release_year']);
        $this->db->bind(':is_series', $data['is_series']);
        
        return $this->db->execute();
    }
}
