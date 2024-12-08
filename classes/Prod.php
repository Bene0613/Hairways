<?php  
class Prod {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        return $this ->db->query("SELECT * FROM products");
    }

    public function getProductById($id) {
        $stmt = $this ->db->prepare("SELECT *  FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addProduct($name, $description, $price, $imageUrl, $categoryId) {
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, image_url, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param ('ssdsi', $name, $description, $price, $imageUrl, $categoryId);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param ('i', $id);
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $imageUrl, $categoryId) {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, category_id = ? WHERE id = ?");
        $stmt->bind_param ('ssdsii', $name, $description, $price, $imageUrl, $categoryId, $id);
        return $stmt->execute();
    }
}
?>