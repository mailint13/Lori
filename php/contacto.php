<?php

//	nac quitar luego if(empty($_GET['id'])){
	//die();
//}


/*?>//usamos el recaptcha de google, no se puede usar hasta que no se registra un sitio, hay que probarlo al final
require_once "includes/php/recaptchalib.php";
//ponemos la clave que nos ha dado google
$secret = "6Ld68r4UAAAAAHpIR4GmoGGay8-joQONIWSfLVgD";
 $response = null;
 $siteKey = "";
 $error = "";
 // comprueba la clave secreta
 $reCaptcha = new ReCaptcha($secret);
 
 if ($_POST["g-recaptcha-response"]) {
     $response = $reCaptcha->verifyResponse(
     $_SERVER["REMOTE_ADDR"],
     $_POST["g-recaptcha-response"]
     );
  }
 
 
 if ($response != null && $response->success) {
    // Si el código es correcto, seguimos procesando el formulario como siempre
  } else {
    // Si el código no es válido, lanzamos mensaje de error al usuario
	 header("HTTP/1.0 403 Forbidden"); 
        exit;
  }
  //termina el recaptcha de google<?php */

function ValidarDatos($campo){
    //Array con las posibles cabeceras a utilizar por un spammer
    $badHeads = array("Content-Type:",
                                 "MIME-Version:",
                                 "Content-Transfer-Encoding:",
                                 "Return-path:",
                                 "Subject:",
                                 "From:",
                                 "Envelope-to:",
                                 "To:",
                                 "bcc:",
                                 "cc:");
    //Comprobamos que entre los datos no se encuentre alguna de
    //las cadenas del array. Si se encuentra alguna cadena se
    //dirige a una página de Forbidden
    foreach($badHeads as $valor){ 
      if(strpos(strtolower($campo), strtolower($valor)) !== false){ 
        header("HTTP/1.0 403 Forbidden"); 
        exit; 
      }
    } 
  }
 
  
if(isset($_POST['email'])) {
	$email = $_POST['email'];
// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
$email_to = "nataliaac@gmail.com";
$email_subject = "PaginaWeb:";

// Aquí se deberían validar los datos ingresados por el usuario
//si es una maquina no se envia
if(isset($_POST['noEnviar'])){
    $noEnviar = $_POST['noEnviar'];
}
if(isset($_POST['noCambiar'])){
    $noCambiar = $_POST['noCambiar'];
}
if ($noEnviar != '' && $noCambiar != 'Mcetpm@2899Tclhg') {
	die();
}

if(isset($_POST['remail'])){
	$remail = $_POST['remail'];
}

if($remail != $email){
	header ("Location: error.html");
die();
}

if(!isset($_POST['nombre']) ||
!isset($_POST['email']) ||
!isset($_POST['remail']) ) {

header ("Location: error.html");
die();
}
//Validamos que los campos no son spam
ValidarDatos($_POST['nombre']);
ValidarDatos($_POST['email']);
ValidarDatos($_POST['remail']);
ValidarDatos($_POST['mensaje']);


$email_from = $_POST['email'];
$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " . $_POST['nombre'] . "\n";
$email_message .= "E-mail: " . $_POST['email'] . "\n";
$email_message .= "Subject: " . $_POST['subject'] . "\n";
$email_message .= "Mensaje: " . $_POST['mensaje'] . "\n";


// Ahora se envía el e-mail usando la función mail() de PHP
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

//$volver = $_GET['id'];
//header ("Location: ../$volver");
//header ($volver);
echo $email_message;
echo "He llegado hasta el final del php";


}

?>