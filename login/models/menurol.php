    <?php

    class menurol extends BaseDatos {
        private $idMenu;
        private $idRol;
        private $mensajeOperacion;

        public function __construct() {
            parent::__construct();
            $this->idMenu = "";
            $this->idRol = "";
            $this->mensajeOperacion = "";
        }

        // Métodos de establecimiento (Setters)
        public function setear($idMenu, $idRol) {
            $this->setIdMenu($idMenu);
            $this->setIdRol($idRol);
        }

        // Cargar datos desde la base de datos
        public function cargar() {
            $resp = false;
            $sql = "SELECT * FROM menurol WHERE idmenu = '" . $this->getIdMenu() . "' AND idrol = '" . $this->getIdRol() . "'";
            if ($this->Iniciar()) {
                $res = $this->Ejecutar($sql);
                if ($res > -1) {
                    if ($res > 0) {
                        $row = $this->Registro();
                        $this->setear($row['idmenu'], $row['idrol']);
                    }
                }
            } else {
                $this->setMensajeOperacion("menurol->cargar: " . $this->getError());
            }
            return $resp;
        }

        // Insertar un nuevo vínculo entre menú y rol
        public function insertar() {
            $resp = false;
            $sql = "INSERT INTO menurol (idmenu, idrol) VALUES ('" . $this->getIdMenu() . "', '" . $this->getIdRol() . "')";
            if ($this->Iniciar()) {
                if ($this->Ejecutar($sql)) {
                    $resp = true;
                } else {
                    $this->setMensajeOperacion("menurol->insertar: " . $this->getError());
                }
            } else {
                $this->setMensajeOperacion("menurol->insertar: " . $this->getError());
            }
            return $resp;
        }

        // Modificar los datos de un vínculo entre menú y rol
        public function modificar() {
            $resp = false;
            $sql = "UPDATE menurol SET idmenu = '" . $this->getIdMenu() . "', idrol = '" . $this->getIdRol() . "' 
                    WHERE idmenu = '" . $this->getIdMenu() . "' AND idrol = '" . $this->getIdRol() . "'";

            if ($this->Iniciar()) {
                if ($this->Ejecutar($sql)) {
                    $resp = true;
                } else {
                    $this->setMensajeOperacion("menurol->modificar: " . $this->getError());
                }
            } else {
                $this->setMensajeOperacion("menurol->modificar: " . $this->getError());
            }
            return $resp;
        }

        // Eliminar un vínculo entre menú y rol
        public function eliminar() {
            $resp = false;
            $sql = "DELETE FROM menurol WHERE idmenu = '" . $this->getIdMenu() . "' AND idrol = '" . $this->getIdRol() . "'";
            if ($this->Iniciar()) {
                if ($this->Ejecutar($sql)) {
                    $resp = true;
                } else {
                    $this->setMensajeOperacion("menurol->eliminar: " . $this->getError());
                }
            } else {
                $this->setMensajeOperacion("menurol->eliminar: " . $this->getError());
            }
            return $resp;
        }

        // Listar todos los vínculos entre menús y roles
        public function listar($parametro = "") {
            $arreglo = array();
            $sql = "SELECT * FROM menurol";
            if ($parametro != "") {
                $sql .= " WHERE " . $parametro;
            }
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $obj = new menurol();
                        $obj->setear($row['idmenu'], $row['idrol']);
                        array_push($arreglo, $obj);
                    }
                }
            } else {
                $this->setMensajeOperacion("menurol->listar: " . $this->getError());
            }
            return $arreglo;
        }

        // Métodos getter y setter
        public function getIdMenu() {
            return $this->idMenu;
        }

        public function setIdMenu($idMenu) {
            $this->idMenu = $idMenu;
        }

        public function getIdRol() {
            return $this->idRol;
        }

        public function setIdRol($idRol) {
            $this->idRol = $idRol;
        }

        public function getMensajeOperacion() {
            return $this->mensajeOperacion;
        }

        public function setMensajeOperacion($mensajeOperacion) {
            $this->mensajeOperacion = $mensajeOperacion;
        }
    }
    ?>
