<?php
    class Comment {
        private $theText;
        private $productId;
        private $clientId;

        /**
         * Get the value of text
         */ 
        public function getText()
        {
                return $this->theText;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */ 
        public function setText($text)
        {
                $this->theText = $text;

                return $this;
        }

        /**
         * Get the value of postId
         */ 
        public function getProductId()
        {
                return $this->productId;
        }

        /**
         * Set the value of postId
         *
         * @return  self
         */ 
        public function setProductId($productId)
        {
                $this->productId = $productId;

                return $this;
        }

        /**
         * Get the value of userId
         */ 
        public function getClientId()
        {
                return $this->clientId;
        }

        /**
         * Set the value of userId
         *
         * @return  self
         */ 
        public function setClientId($clientId)
        {
                $this->clientId = $clientId;

                return $this;
        }

        public function save() {
            include_once'./classes/database.php';
            $db = new Database("localhost", "root", "", "hairrways");
            $stmt = $db->prepare("INSERT INTO comments (text, product_id, client_id) VALUES(?,?,?,?)");
            
            $theText = $this->getText();
            $productId = $this->getProductId();
            $clientId = $this->getClientId();
            
            $stmt->bind_param ('si', $theText, $productId,$clientId); 

            $result = $statement->execute();
            return $result;
        }

        public static function getAll($productId) {
            $db = new Database("localhost", "root", "", "hairrways");
            $stmt = $db->prepare("SELECT * FROM comments WHERE product_id = ?");
            $stmt->bind_param ('i', $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $comments = [];
        
        while ($row = $result->fetch_assoc()) {
                $comments[] = $row;
            }
        
        return $comments;
        }
        
    }
    ?>