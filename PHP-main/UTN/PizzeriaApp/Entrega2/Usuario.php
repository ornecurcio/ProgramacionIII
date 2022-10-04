<?php

include_once "Herramientas.php";
include_once "GuardarLeerJson.php";

class Usuario
{
    public $_id;
    public $_email;

    public function __construct($email)
    {
        $this->_email = $email;
    }

    public function Equals($usuarioUno, $usuarioDos)
    {
        $retorno = false;
        $mailUsuarioUno = Herramientas::SacarValorDeClave($usuarioUno, "_email");
        $mailUsuarioDos = Herramientas::SacarValorDeClave($usuarioDos, "_email");

        if(trim($mailUsuarioUno) == trim($mailUsuarioDos))
        {
            $retorno = true;
        }
        return $retorno;
    }

    public function Alta($array, $ruta)
    {
        $retorno = null;
        $indice = Herramientas::ConsultaSiHayYCual($this, $array);
        if($indice == -1)
        {          
            Herramientas::AsignarId($this, $array);
            array_push($array, $this);
            // $this->GrabarEnBD();
            $retorno = $this;
        }
        else
        {
            $retorno = $array[$indice];
        }     
        GuardarLeerJson::GrabarEnJson($array, $ruta);
        return $retorno;
    }


}




?>