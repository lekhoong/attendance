<?php
        class database{
            private $server;
            private $user;
            private $pwd;
            private $db;
            public  $conn;
            function __construct($server,$user,$pwd,$db){
                $this->dbconnect();
            } 
        function dbconnect(){
            $this->server = "localhost";
            $this->user   = "root";
            $this->pwd    = "";
            $this->db     = "assignment_data";

            $this->conn = new mysqli($this->server,$this->user,$this->pwd,$this->db);
            return $this->conn;
        }    

        //     function dbconnect(){
        //     $this->server = "server621.iseencloud.com";
        //     $this->user   = "jomjomco_shanglekhoong";
        //     $this->pwd    = "lek20021228";
        //     $this->db     = "jomjomco_shanglekhoong_attendance";

        //     $this->conn = new mysqli($this->server,$this->user,$this->pwd,$this->db);
        //     return $this->conn;
        // }   
        }
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
