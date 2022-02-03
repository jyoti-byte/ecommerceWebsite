<?php
class Product{
    private $db;
    private $table = 'products';

    public $product_id;
    public $product_name;
    public $price;
    public $product_image;
    public $availability;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function read(){
        $query = 'SELECT * FROM '. $this->table .'';

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function single_read(){
        $query = 'SELECT * FROM '. $this->table .' WHERE product_id= ? LIMIT 1';

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $this->product_id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->product_name = $row['product_name'];
        $this->price = $row['price'];
        $this->product_image = $row['product_image'];
        $this->availability = $row['availability'];

    
    }
}
?>