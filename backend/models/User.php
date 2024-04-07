<?php
    class User{
        public $id;
        public $name;
        public $address;
        public $email;
        public $password;
        public $photo;
    
        public function __construct($id, $name, $address, $email, $password, $photo) {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->email = $email;
            $this->password = $password;
            $this->photo = $photo;
        }

        public function parseName($indexName = 1){
            $nameParsed = explode(" ",$this->name)[$indexName];
            return $nameParsed;
        }

    }
?>