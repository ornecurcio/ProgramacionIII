<?php

include_once "Toolkit.php";
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
        $mailUsuarioUno = Toolkit::SacarValorDeClave($usuarioUno, "_email");
        $mailUsuarioDos = Toolkit::SacarValorDeClave($usuarioDos, "_email");

        if(trim($mailUsuarioUno) == trim($mailUsuarioDos))
        {
            $retorno = true;
        }
        return $retorno;
    }

    public function Alta($array, $ruta)
    {

        $retorno = null;
        $indice = Toolkit::ConsultaSiHayYCual($this, $array);

        if($indice == -1)
        {          
            Toolkit::AsignarId($this, $array);
            array_push($array, $this);
            GuardarLeerJson::GrabarEnJson($array, $ruta);
            $retorno = $this;
        }
        else
        {
            $retorno = $array[$indice];
        }     
        return $retorno;
    }

}

?>