<?php
//namespace DB;
class DBAccess{
  const HOST_DB = "localhost:3307";
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
  
      public function isAdmin($id){
    	$query="SELECT ID, Admin FROM Utente WHERE ID='$id' AND Admin IS NOT NULL";
        $queryResult=mysqli_query($this->connessione, $query) or die ("Error in isAdmin query: " .
                                                                    mysqli_error($this->connessione));
      	if(mysqli_num_rows($queryResult) == 0){
        return false;
      	}else{
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
    
  	$query = "INSERT INTO utente (Name, Surname, Telefono, Email, Password) VALUES ('".$name."', '".$surname."', '".$telefono."', '".$email."', '".md5($password)."')";

    //die(var_dump($query));
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
    $query = "SELECT * FROM `utente` WHERE Email='".$email."' and Password='".md5($password)."'";
        
		$result = mysqli_query($this->connessione,$query);
    $out = $result->fetch_assoc();
		$rows = mysqli_num_rows($result);
    if($rows==1){
	    	$out['valid'] = true;
    }    
		else{
			$out['valid']=false;
    }
    //die(var_dump($query, $out));
    return $out;
	}
	
	public function logout(){
		if(session_destroy()){
      unset($_SESSION);
			return true;
    }
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

public function getemergenze(){
      $querySelect = "SELECT * FROM emergenze";
      $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Error in getOrari query: " .mysqli_error($this->connessione));
      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }
      else{
        $result = array();
        while($row = mysqli_fetch_assoc($queryResult)){
        $arrayResult = array(
          "id" => $row['id'],
          "name" => $row['name'],
          "Path" => $row['Path'],
          "alt" => $row['alt'],
          "Descrizione" => $row['Descrizione'],
          );
          array_push($result, $arrayResult);
        }
        return $result;
      }
   }

public function getservizi(){
      $querySelect = "SELECT * FROM servizi";
      $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Error in getOrari query: " .mysqli_error($this->connessione));
      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }
      else{
        $result = array();
        while($row = mysqli_fetch_assoc($queryResult)){
        $arrayResult = array(
          "id" => $row['id'],
          "name" => $row['name'],
          "Path" => $row['Path'],
          "alt" => $row['alt'],
          "Descrizione" => $row['Descrizione'],
          );
          array_push($result, $arrayResult);
        }
        return $result;
      }
   }

public function getserviziIndice(){
      $querySelect = "SELECT * FROM serviziIndice";
      $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Error in getOrari query: " .mysqli_error($this->connessione));
      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }
      else{
        $result = array();
        while($row = mysqli_fetch_assoc($queryResult)){
        $arrayResult = array(
          "id" => $row['id'],
          "name" => $row['name'],
          "Path" => $row['Path'],
          "alt" => $row['alt'],
          );
          array_push($result, $arrayResult);
        }
        return $result;
      }
   }



public function getemergenzeIndice(){
      $querySelect = "SELECT * FROM emergenzeIndice";
      $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Error in getOrari query: " .mysqli_error($this->connessione));
      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }
      else{
        $result = array();
        while($row = mysqli_fetch_assoc($queryResult)){
        $arrayResult = array(
          "id" => $row['id'],
          "name" => $row['name'],
          "Path" => $row['Path'],
          "alt" => $row['alt'],
          );
          array_push($result, $arrayResult);
        }
        return $result;
      }
   }


public function getpiante(){
      $querySelect = "SELECT * FROM piante";
      $queryResult=mysqli_query($this->connessione, $querySelect) or die ("Error in getOrari query: " .mysqli_error($this->connessione));
      if(mysqli_num_rows($queryResult) == 0){
        return null;
      }
      else{
        $result = array();
        while($row = mysqli_fetch_assoc($queryResult)){
        $arrayResult = array(
          "name" => $row['name'],
          "Path" => $row['Path'],
          "alt" => $row['alt'],
          "PartiTossiche" => $row['PartiTossiche'],
          "Sintomatologia" => $row['Sintomatologia'],
          );
          array_push($result, $arrayResult);
        }
        return $result;
      }
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


function insertImmaginiGalleria($path, $alt, $descrizione){

	$queryResult = mysqli_query($this->connessione, "INSERT INTO galleria (Path, alt, descrizione) VALUES ('".$path."', '".$alt."', '".$descrizione."')");
	return $queryResult;

}

 function isAdminLogged($user){ //funzione che ritorna true sse c'è un amministratore loggato
    $query="SELECT * FROM utente WHERE utente.Email=".$user." AND Admin!=0";
    $queryResult = mysqli_query($this->connessione, $query) or die("impossibile stabilire se l'utente sia admin o meno");
    if(mysqli_num_rows($queryResult) > 0)
      return true;
    return false;
}
}

?>
