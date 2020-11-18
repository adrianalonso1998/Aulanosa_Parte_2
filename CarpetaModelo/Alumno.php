<?php
    class Alumno
    {
        private $id;
        private $nombre;
        private $apellidos;
        private $fecha_nacimiento;
        
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
        }
        public function getApellidos()
        {
            return $this->apellidos;
        }
        public function setFecha_nacimiento($fecha_nacimiento)
        {
            $this->fecha_nacimiento = $fecha_nacimiento;
        }
        public function getFecha_nacimiento()
        {
            return $this->fecha_nacimiento;
        }
        

        public function __construct($id,$nombre,$apellidos,$fecha_nacimiento)
        {
            $this->id=$id;
            $this->nombre=$nombre;
            $this->apellidos=$apellidos;
            $this->fecha_nacimiento=$fecha_nacimiento;
        }
        // function __toString(){
        //     $login=$this->getLogin();
        //     $password=$this->getPassword();
        //     $mensajeRet="Persona:[$login,$password]";
        //     return $mensajeRet;   
        // }
    }

    ?>