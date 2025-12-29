<?php

namespace App\Models;

use Core\Model;

class Category extends Model {
    protected string $table = 'categories';

    public function save(array $data): bool {
        if (isset($data['id'])) {
            $this->db->query("UPDATE categories SET name = :name WHERE id = :id");
            $this->db->bind(':id', $data['id']);
        } else {
            $this->db->query("INSERT INTO categories (name) VALUES (:name)");
        }
        $this->db->bind(':name', $data['name']);
        
        return $this->db->execute();
    }
}
