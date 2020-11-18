<?php
    class Usuario
    {
        private $id;
        private $login;
        private $password;
        private $alumno_id;

        public function setLogin($login)
        {
            $this->login = $login;
        }
        public function getLogin()
        {
            return $this->login;
        }
        public function setPassword($password)
        {
            $this->password = $password;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setAlumno_id($alumno_id)
        {
            $this->alumno_id = $alumno_id;
        }
        public function getAlumno_id()
        {
            return $this->alumno_id;
        }
        

        public function __construct($id,$login,$password,$alumno_id)
        {
            $this->login=$login;
            $this->password=$password;
            $this->id=$id;
            $this->alumno_id=$alumno_id;
        }
        function __toString(){
            $login=$this->getLogin();
            $password=$this->getPassword();
            $mensajeRet="Persona:[$login,$password]";
            return $mensajeRet;   
        }
    }

    ?>