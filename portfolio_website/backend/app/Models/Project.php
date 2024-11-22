<?php
class Project {
    private $conn;
    private $table_name = "projects";

    public $id;
    public $title;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
    
        // Bind parameter
        $stmt->bindParam(":id", $this->id);
    
        $stmt->execute();
    
        // Ambil data proyek
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $this->title = $row['title'];
            $this->description = $row['description'];
            return $row;
        }
    
        return null; // Jika data tidak ditemukan
    }    

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, description=:description";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
    
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }
}
?>
