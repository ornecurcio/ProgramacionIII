<?php
    //Testing
    // if(FileManager::SaveFile("hola mundo")){
    //     echo("Se guardo el archivo");
    // }
    // else{
    //     echo("No se pudo guardar el archivo");
    // }
    // $data = "";
    // if(FileManager::ReadFile("phpTest.txt",$data)){

    // }else{
    //     echo("se a podido leer en el archivo: " . $data);
    // }
    
    Class FileManager{

        public static string $_fileName;
        public static string $_path;

        function __construct(string $fileName,string $path){
            $this->$fileName = $fileName;
            $this->$fileName = $path;
        }
        static function ReadFile(string $path,string $separator="<br>",&$data =""){
            if(file_exists($path)){
                $file = fopen($path,"r");
                $line;
                $retStr = "";
                while(!feof($file)) {
                    $line = fgets($file);
                    echo $line . $separator;
                    if(!$line){
                        return false;
                    }
                    else{
                        $data .= $line . $separator;
                    }
                  }    
                fclose($file);
            } 
            return true;
        }

        static function SaveFile(string $data,string $path="phpTest",bool $append=false,string $endFormat=".txt"){
            $ret = false;
            if(!FileManager::IsNullOrEmptyString($data)){
                $file;
                $path .= $endFormat;
                if($append){
                    $file = fopen($path,"a");                                    
                }
                else{
                    $file = fopen($path,"w");                    
                }
                if(fwrite($file,$data) > 0){
                    $ret = true;  
                }
            }
            fclose($file);
            return $ret;
        }

        private static function IsNullOrEmptyString($str){
            return ($str === null || trim($str) === '');
        }






    }


?>