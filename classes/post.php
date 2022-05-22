<?php
    include_once(__DIR__ . "/db.php");

    class Post {
      
        private $title;
        private $description;
        private $userId;
        private $image;
        private $createdAt;

        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
            if(empty($title)){
                throw new Exception("Title cannot be empty.");
            }
            $this->title = $title;

            return $this;
        }

        public function getDescription()
        {
                return $this->description;
        }

        public function setDescription($description)
        {
            if(empty($description)){
                throw new Exception("Description cannot be empty.");
            }
            $this->description = $description;

            return $this;
        }

        public function getUserId()
        {
                return $this->userId;
        }

        public function setUserId($userId)
        {
            $this->userId = $userId;

            return $this;
        }

        public static function getAll()
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM posts");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public static function getById($id)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }

        public static function getByUserId($userId)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = :user_id");
            $stmt->bindValue(":user_id", $userId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public static function deleteById($id)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("DELETE FROM posts WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        }

        public function getImage()
        {
            return $this->image;
        }

        public function setImage($image)
        {
            $this->image = $image;
            return $this;
        }

        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;

            return $this;
        }


        public function save()
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("INSERT INTO posts (title, description, user_id, image, created_at) VALUES (:title, :description, :user_id, :image, :created_at)");
            $stmt->bindValue(":title", $this->title);
            $stmt->bindValue(":description", $this->description);
            $stmt->bindValue(":user_id", $this->userId);
            $stmt->bindValue(":image", $this->image);
            $stmt->bindValue(":created_at", $this->createdAt);
            $stmt->execute();
        }


    }