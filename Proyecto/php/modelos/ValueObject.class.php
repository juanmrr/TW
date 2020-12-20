<?php 
	
	/**
	 * 
	 */
	abstract class ValueObject
	{
		private $properties; 
		
		function __construct($param = FALSE)
		{		
			$reflec = new ReflectionClass($this); 
			$this->properties = $reflec->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
			//var_dump($param); 
			if($param)
				if(is_array($param) && count($param) == count($this->properties))
					self::setFromArguments($param);
					
				//if($param && is_array ($param));
				else if( (is_object($param) && get_class($param) == "stdClass") || is_array ($param) ){
					self::setFromClass($param);
				}else{
					/*
					$caller = debug_backtrace()[0];
					$line = getCallingLine($caller);
					echo $line;*/
					//$regex = '/\$\w*/m';
					/*preg_match($regex, $line, $matches);
					$varname = $matches[0];
					var_dump($matches); 
					*/
					 
				}


		}
		/*
		Se puede mejorar el redimiento, repitiendo códfigo y sacando if del foreach
		*/
		private function setFromClass($array, $sobreescribir = false)
		{	
			//Prmite acceder a las variables privadas
			//Recorremos los atributos 
			//var_dump($this->properties); 
			foreach ($this->properties as $property) {
				$var_name  = $property->getName();
				//permite acceder al valor de la variable haciendo get_value()
				$get_value = self::getPrivate($this, $var_name); 
				//Si no queremos sobreescribir datos, solo se cambian los valores que no tengan valor
				if($sobreescribir || (!$sobreescribir && is_null($get_value())))
					if(is_object($array) && get_class($array) == "stdClass") // Si me han enviado los datos en una clase stdClass (Poripia de las consultas a la base de datos)
						if(isset($array -> $var_name)){
							//Permite modificar el valor haciendo $set_value()
							$set_value = self::setPrivate($this, $var_name)($array -> $var_name);
						}
					else if($array && is_array ($array)) // Si me han enviado los datos en un array
						if(isset($array["$var_name"])){
							//Permite modificar el valor haciendo $set_value()
							$set_value = self::setPrivate($this, $var_name)($array["$var_name"]);
						}

			}


			//Recorremos todas las variables
			/*while($entry = each($class_var_entries)){
				$var_name = $entry['key'];
				$var_value = $entry['value'];
				//Evita Sobreescribir variables que no queramos(Opcional)
				if($var_value == "DBSET")
					// Si el nombre de la variable es una clave del array
					if(isset($array["$var_name"]))
						//Le asiagnamos el valor asociado a la clave a la variable que se llema igual que la clave. 
						$object->$var_name = $array[$var_name]; 

			}*/
		}
		private function setFromArguments($params){
			//Prmite acceder a las variables privadas
			//Recorremos los atributos 
			//var_dump($this->properties);
			//echo "fuchlbjkñ";
			$i = 0;  
			foreach ($this->properties as $property) {
				$var_name  = $property->getName();
				$set_value = self::setPrivate($this, $var_name)($params[$i++]);
			}
		}

		/*
			Evita tener que crear getter y setter en las clases. 
		*/
		public function __call($name, $arguments)
	    {

	        $name = strtolower(str_replace("_","", $name));
			foreach ($this->properties as $property) {
				$var_name  = strtolower($property->getName());
				//echo "var_name = " . "get".$var_name . "<br>";
				//echo "name = ". $name ."<br>"; 
		        if($name == ("get".$var_name)){
					$var_value = self::getPrivate($this, $var_name)(); 
		        	return $var_value;
		        }else if($name == ("set".$var_name)){
		        	//Se se debe usar en los VO
		        }
		    }
	    }

		private function getPrivate($obj, $attribute) {
        $getter = function() use ($attribute) {return $this->$attribute;};
        return \Closure::bind($getter, $obj, get_class($obj));
	    }
	    
	    private function setPrivate($obj, $attribute) {
	        $setter = function($value) use ($attribute) {$this->$attribute = $value;};
	        return \Closure::bind($setter, $obj, get_class($obj));
	    }
	}


 
	function getCallingLine($caller)
	{
		$file = $caller['file'];
		$lineno = $caller['line'];
		$fp = fopen($file, 'r');
		for ($i = 0; $i < $lineno; $i++) {
	 		$line = fgets($fp);
		}
		return $line;

	}


 ?>