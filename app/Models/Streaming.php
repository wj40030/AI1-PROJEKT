<?php

namespace App\Models;

use Core\Model;

class Streaming extends Model {
    protected string $table = 'streamings';

    public function save(array $data): bool {
        if (isset($data['id'])) {
            $this->db->query("UPDATE streamings SET name = :name, url = :url WHERE id = :id");
            $this->db->bind(':id', $data['id']);
        } else {
            $this->db->query("INSERT INTO streamings (name, url) VALUES (:name, :url)");
        }
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':url', $data['url']);
        
        return $this->db->execute();
    }
}
