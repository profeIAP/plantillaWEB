<?php

// Documentación Swift_Message [http://goo.gl/Z12Bo]
	
class Email {

	// MEJORA meter en un fichero único de configuración
	
	const ADMIN_EMAIL = "jasvazquez@iesalandalus.com";
	const FROM_EMAIL = "admin@alDictado.com";
	const FROM_NAME  = "AlDictado";
	
    public static function enviar($to, $subject, $body) {
		
		if(Utilidades::isEntorno(Utilidades::ENTORNO_DESARROLLO))
			self::enviarDesarrollo($to, $subject, $body);
		else
			self::enviarProduccion($to, $subject, $body);
	}
	
	private static function enviarProduccion($to, $subject, $body){
		
		$headers = "From: ".self::FROM_EMAIL."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		mail($to, $subject, $body, $headers);
	}
	
	private static function enviarDesarrollo($to, $subject, $body){
		
		// TODO quitar clave email de aquí
		
		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
		  ->setUsername('TU_CORREO@gmail.com')
		  ->setPassword('CLAVE_ULTRA_SECRETA');

		$mailer = Swift_Mailer::newInstance($transport);

		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array(self::FROM_EMAIL => self::FROM_NAME))
		  ->setTo(array($to))
		  //->setBody('This is a <b>test</b> mail.')
		  ->addPart($body, 'text/html');

		$result = $mailer->send($message);
	}
	
	public static function getMessageAutenticacion($to, $token) {

		return 'Ha recibido el siguiente mensaje porque alguien ha solicitado acceder a la web <b><a href="http://localhost:9000">AlDictado</a></b> con su dirección de correo electrónico<br><br>'
			.  'Si ha sido ud. pulse el siguiente <a href="'.Utilidades::getCurrentUrl(false).'/usuario/autenticar/'.$token.'?email='.$to.'">enlace para entrar</a>.<br>'
			.  'En caso contrario, ignore este correo.<br><br>'
			.  'Gracias por su atención.';
	}
	
	public static function getMessageDictadosTerminados($email) {

		return "El usuario $email ha realizado todos los dictados existentes en la BD<br>"
			. "Deberíamos crear alguno nuevo para que no se 'aburra'.<br>"
			. "¿No te parece?";
	}
	
	public static function getMessageActividadSospechosa($email, $donde) {

		return "El usuario $email está realizando actividades extrañas en <b>'$donde'</b>";
	}

        
}

?>
