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
  
    public function insertUser($username, $name, $surname, $email, $password){
  	$username = stripslashes($username);
    $username = mysqli_real_escape_string($this->connessione,$username);
    $name = stripslashes($name);
    $name = mysqli_real_escape_string($this->connessione,$name);
    $surname = stripslashes($surname);
    $surname = mysqli_real_escape_string($this->connessione,$surname);
    $email = stripslashes($email);
    $email = mysqli_real_escape_string($this->connessione,$email);
	$password = stripslashes($password);
	$password = mysqli_real_escape_string($this->connessione,$password);
    
  	$query = "INSERT INTO Users (Name, Surname, Username, Email, Password) VALUES (\"$name\", \"$surname\", \"$username\", \"$email\", '".md5($password)."')";
    $result = mysqli_query($this->connessione, $query);
	if(mysqli_affected_rows($this->connessione)>0){
		return true;	
	}
    else{
		return false;	
	}
  }
  
		public function login($username, $password){
		$username = stripslashes($username);
		//escapes special characters in a string
		$username = mysqli_real_escape_string($this->connessione,$username);
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($this->connessione,$password);
		//Checking is user existing in the database or not
        $query = "SELECT * FROM `Users` WHERE Username='$username' and Password='".md5($password)."'";
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


  public function closeDBConnection(){

    if($this->connessione){
      $this->connessione->close();
    }

  }

public function getGalleriaRandom($n){

  $querySelect = "SELECT * FROM galleria ORDER BY RAND() LIMIT ".$n;
    $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Errore in getGalleriaRandom " . mysqli_error($this->connessione));
    
    if(mysqli_num_rows($queryResult) > 0){
    $result = array();
    while($row = mysqli_fetch_assoc($queryResult))
    {
        //$rows[] = $row;
        array_push($result,$row);
    }
  }
  return $result;
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
