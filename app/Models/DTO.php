<?php 
namespace App\Http\Models;

//refactor and rename as CredintialModel for better practice
class DTO implements \JsonSerializable{
    
    private $errorCode;
    private $errorMessage;
    private $data;

    //BEST practice: Use a non-defualt constructor for Object models
    public function __construct($code, $message, $data){
        $this->errorCode = $code;
        $this->errorMessage=$message;
        $this->data=$data;
    }
    
    public function jsonSerialize(){
        return get_object_vars($this);
    }
    
    
    
    
}
?>