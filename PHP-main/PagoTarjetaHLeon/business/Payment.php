<?php
require_once("bin/conekta-php-master/lib/Conekta.php");
class Payment{

    //Atributos que pide Conekta
    private $ApiKey="tuapikeyprivada";
    private $ApiVersion="2.0.0";

    private $UserDB="root";
    private $PassDB="";
    private $ServerDB="localhost";
    private $DataBaseDB="pagocurso";


    public function __construct($token,$card,$name,$description,$total,$email){

        $this->token=$token;
        $this->card=$card;
        $this->name=$name;
        $this->description=$description;
        $this->total=$total;
        $this->email=$email;
    }

    public function Pay(){

      //Obtengo una libreria que esta ubicada en una carpeta local
        \Conekta\Conekta::setApiKey($this->ApiKey);
        \Conekta\Conekta::setApiVersion($this->ApiVersion);

        if(!$this->Validate())
            return false;

        if(!$this->CreateCustomer())
            return false;

        if(!$this->CreateOrder())
            return false;

        $this->Save();

        return true;

    }

    public function Save(){
        $link = new PDO("mysql:host=".$this->ServerDB.";dbname=".$this->DataBaseDB, $this->UserDB, $this->PassDB);
  
        //El prepare y los : delante evita sql injection 
        $statement = $link->prepare("INSERT INTO payment (total,date_created,description,name,number_card,email,order_id)
            VALUES (:total, now(), :description,:name,:number_card,:email,:order_id)");
  
        //
        $statement->execute([
            'total' => $this->total,
            'description' => $this->description,
            'name' => utf8_decode($this->name),
            'number_card'=> substr($this->card,strlen($this->card)-5,4),
            'email'=>$this->email,
            'order_id'=>$this->order->id  //este id lo genera conekta cuando es exitoso
        ]);
        //se guarda el numero por cuesitones de debuggeo
        $this->order_number = $link->lastInsertId();
      
      }

    public function CreateOrder(){
        try{
         
          $this->order = \Conekta\Order::create(
            array(
              "amount"=>$this->total,
              "line_items" => array(
                array(
                  "name" => $this->description,
                  "unit_price" => $this->total*100, //se multiplica por 100 conekta
                  "quantity" => 1
                )//first line_item
              ), //line_items
              "currency" => "MXN",
              "customer_info" => array(
                "customer_id" => $this->customer->id 
              ), //customer_info
              "charges" => array(
                  array(
                      "payment_method" => array(
                              "type" => "default"
                      ) 
                  ) //first charge
              ) //charges
            )//order
          );
        } catch (\Conekta\ProcessingError $error){
          $this->error=$error->getMessage();
          return false;
        } catch (\Conekta\ParameterValidationError $error){
          $this->error=$error->getMessage();
          return false;
        } catch (\Conekta\Handler $error){
          $this->error=$error->getMessage();
          return false;
        }
  
        return true;
      }
    public function CreateCustomer(){
        try {
          $this->customer = \Conekta\Customer::create(
            array(
              "name" => $this->name,
              "email" => $this->email,
              //"phone" => "+52181818181",
              "payment_sources" => array(
                array(
                    "type" => "card",
                    "token_id" => $this->token
                )
              )//payment_sources
            )//customer
          );
        } catch (\Conekta\ProccessingError $error){
          $this->error=$error->getMesage();
          return false;
        } catch (\Conekta\ParameterValidationError $error){
          $this->error=$error->getMessage();
          return false;
        } catch (\Conekta\Handler $error){
          $this->error=$error->getMessage();
          return false;
        }
  
        return true;
    }

    public function Validate(){
        if($this->card=="" || $this->name=="" || $this->description=="" || $this->total=="" || $this->email==""){
          $this->error="El número de tarjeta, el nombre, concepto, monto y correo electrónico son obligatorios";
          return false;
        }
       
        if(strlen($this->card)<=14){
          $this->error="El número de tarjeta debe tener al menos 15 caracteres";
          return false;
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
          $this->error="El correo electrónico no tiene un formato de correo valido";
          return false;
        }
        if($this->total<=20){
          $this->error="El monto debe ser mayor a 20 pesos";
          return false;
        }
  
        return true;
      }
}

?>