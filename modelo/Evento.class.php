<?php

class Evento extends Conexion{

    public $estado;
    public $mensaje;

    function __construct(){
        parent::__construct();
    }

    //GET
    public function allEventos(){
        try{
            $data = array();

            if(parent::connect()){
                $sql = "SELECT * FROM eventos order by fecha_evento asc;";
                $result = $this->conection->query($sql);
                while($fila = $result->fetch_assoc()) {
                    $data[] = array(
                        "id_evento" => $fila["id_evento"],
                        "nombre" =>$fila["nombre"],
                        "descripcion" =>$fila["descripcion"],
                        "fecha_evento" =>$fila["fecha_evento"],
                        "img_evento" =>$fila["img_evento"]
                    );
                }
            }

            $this->estado = 1;
            $this->mensaje = "Datos procesados correctamente";

        }catch(Exception $e){
            $this->estado = 2;
            $this->mensaje = "Se generado error al procesar la solcitud";
        }finally{
            parent::desconect();
            return $data;
        }
    }

    //SHOW
    public function getEvento($idEvento){
            try{
                $data = array();

                if(parent::connect()){
                    $sql = "SELECT * FROM eventos WHERE id_evento = ? ";
                    $stmt = $this->conection->prepare($sql);
                    $stmt->bind_param('i', $idEvento);
                    $stmt->execute();

                    $result = $stmt->get_result();
                    while($fila = $result->fetch_assoc()) {
                        $data[] = array(
                            "id_evento" => $fila["id_evento"],
                            "nombre" =>$fila["nombre"],
                            "descripcion" =>$fila["descripcion"],
                            "fecha_evento" =>$fila["fecha_evento"],
                            "img_evento" =>$fila["img_evento"]
                        );
                    }
                }

                $this->estado = 1;
                $this->mensaje = "Datos procesados correctamente";

            }catch(Exception $e){
                $this->estado = 2;
                $this->mensaje = "Se generado error al procesar la solcitud";
            }finally{
                parent::desconect();
                return $data;
            }
        }
}
?>