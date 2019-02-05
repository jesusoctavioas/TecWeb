<?php
//namespace DB;
class DBAccess{
  const HOST_DB = "localhost";
  const USERNAME = "root";
  const PASSWORD = "";
  const DATABASE_NAME = "clinica";
  
  public $connessione;
  
  public function openDBConnection(){
    $this->connessione = mysqli_connect(static::HOST_DB, static::USERNAME, static::PASSWORD, static::DATABASE_NAME);

    if(!$this->connessione){
      return false;
    }
    else{
      return true;
    }
  }

    public function insertUser($email, $name, $surname, $telefono, $password){
  	$email = stripslashes($email);
    $email = mysqli_real_escape_string($this->connessione,$email);
    $name = stripslashes($name);
    $name = mysqli_real_escape_string($this->connessione,$name);
    $surname = stripslashes($surname);
    $surname = mysqli_real_escape_string($this->connessione,$surname);
	$telefono = stripslashes($telefono);
    $telefono = mysqli_real_escape_string($this->connessione,$telefono);
	$password = stripslashes($password);
	$password = mysqli_real_escape_string($this->connessione,$password);
    
  	$query = "INSERT INTO Users (Name, Surname, Telefono, Email, Password) VALUES (\"$name\", \"$surname\", \"$telefono\", \"$email\", '".md5($password)."')";
    $result = mysqli_query($this->connessione, $query);
	if(mysqli_affected_rows($this->connessione)>0){
		return true;	
	}
    else{
		return false;	
	}
  }
  
  public function login($email, $password){
		$email = stripslashes($email);
		//escapes special characters in a string
		$email = mysqli_real_escape_string($this->connessione,$email);
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($this->connessione,$password);
		//Checking is user existing in the database or not
        $query = "SELECT * FROM `Users` WHERE Email='$email' and Password='".md5($password)."'";
		$result = mysqli_query($this->connessione,$query);
        $out = $result->fetch_assoc();
		$rows = mysqli_num_rows($result);
        if($rows==1)
	    	$out['valid'] = true;
		else
			$out['valid']=false;
        return $out;
	}
	
	public function logout(){
		if(session_destroy())
			return true;
        else
        	return false;
	}


  


  public function getOrari(){
      $querySelect = "SELECT * FROM orari ORDER BY ID ASC";
      $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Error in getOrari query: " .mysqli_error($this->connessione));
      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }
      else{
        $result = array();
        while($row = mysqli_fetch_assoc($queryResult)){
        $arrayResult = array(
          "ID" => $row['ID'],
          "Giorno" => $row['Giorno'],
          "OrariStart" => $row['OrariStart'],
          "OrariEnd" => $row['OrariEnd'],
          );
          array_push($result, $arrayResult);
        }
        return $result;
      }
   }

function validateTime($time, $format = 'H:i'){
    $d = DateTime::createFromFormat($format, $time);
    return $d && $d->format($format) == $time;
}


function getImmaginiGalleria(){

  $result = array();
  $queryResult = mysqli_query($this->connessione, "SELECT * FROM galleria" ) or die ("Error in getImmaginiGalleria query: " .mysqli_error($this->connessione));
  if(mysqli_num_rows($queryResult) > 0){
    while($row = mysqli_fetch_assoc($queryResult))
    {
        //$rows[] = $row;
        array_push($result,$row);
    }

  }

  return $result;
}  


}
?>
