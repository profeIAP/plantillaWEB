<?php

// Documentación Swift_Message [http://goo.gl/Z12Bo]
	
class Utilidades {
	
	const ENTORNO_DESARROLLO = 'localhost';
	const ENTORNO_PRODUCCION = 'dictados.wesped.es';

	// Devuelve el entorno actual
	
    public static function getEntorno() {
		switch ($_SERVER['SERVER_NAME']) {
		  case self::ENTORNO_DESARROLLO:
			return self::ENTORNO_DESARROLLO;
			break;
		  case self::ENTORNO_PRODUCCION:
			return self::ENTORNO_PRODUCCION;
			break;
		  default:
			throw new Exception("Entorno de servidor desconocido. Compruebe que '".$_SERVER['SERVER_NAME']."' se encuentra entre los nombres de servidor indicados como entornos."); 
			break;
		}
	}
	
	// Indica si nos encontramos en el entorno que nos indican
	
	public static function isEntorno($entorno) {
		return self::getEntorno()==$entorno;
	}
	
	// Obtiene la url http[s] al servidor actual
	
	public static function getCurrentUrl($full = true) {
          return "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'];
    }
    
    // Obtiene el ID de la sesión actual
	
	public static function getSessionID() {
		return session_id();
	}
	
	public static function generateUUID() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
	
	public static function mostrarSessionID(){
		
		$app = \Slim\Slim::getInstance();
		global $twig;
		
		$valores=array(
				'id_sesion'=>self::getSessionID()
			);
		echo $twig->render('session.php',$valores);
	}
	
}

?>
