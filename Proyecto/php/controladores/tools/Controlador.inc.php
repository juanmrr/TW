<?php  
	require_once 'php/controladores/tools/vendor/autoload.php';

	class Controlador {
		private static $loader;
		private static  $twig;

		private static function getTwig(){
			if(!isset(self::$twig)){
				if(!isset(self::$loader))
					self::$loader = new \Twig\Loader\FilesystemLoader('./templates/html/');
				self::$twig = new \Twig\Environment(self::$loader);
			}
			return self::$twig;
		}

		public static function renderizar($ruta, $argumentos = FALSE){ 
			$template = self::getTwig() -> load($ruta);
			
			if($argumentos)
				return $template -> render($argumentos);
			else
				return $template -> render();
		}
	}

?>