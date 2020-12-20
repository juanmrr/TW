<?php 

function input_filter($data, $htmlAllow = FALSE) {
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlentities($data); // Codifica los caracteres susceptibles de ello en HTML entities 
  $data = htmlspecialchars($data); // Solo convierte &, “, ‘, <, >
  if(!$htmlAllow)
  	$data = strip_tags($data); // Elimina cualquier tag de HTML o PHP

  return filter_var($data, FILTER_SANITIZE_STRING);
}

function test_string($string, $max_size = -1){

	if($max_size > 0)
		$string = substr($string, 0, $max_size);

	return input_filter($string, FALSE);

}

function test_email($email, $max_size = 30){

	$string;
	if($max_size > 0)
		$string = substr($email, 0, $max_size);

	$string = input_filter($string, FALSE);
	$out = [$string, filter_var($string, FILTER_VALIDATE_EMAIL)];
	return $out;

}

function test_int($param, $min, $max){

	$string = filter_var($param, FILTER_SANITIZE_NUMBER_INT);

	$options = array(
   					'options' => array(
				                      	'min_range' => $min,
				                      	'max_range' => $max,
				                      	'default' => -1,
                     	)
	);
	$out = [$string, filter_var($string, FILTER_VALIDATE_INT, $options)];

	return $out;

}

function test_int_with_max($param, $max){

	$string = filter_var($param, FILTER_SANITIZE_NUMBER_INT);

	$options = array(
   					'options' => array(
				                      	'max_range' => $max,
				                      	'default' => -1,
                     	)
	);
	$out = [$string, filter_var($string, FILTER_VALIDATE_INT, $options)];

	return $out;
}
function test_int_with_min($param, $min){

	$string = filter_var($param, FILTER_SANITIZE_NUMBER_INT);

	$options = array(
   					'options' => array(
				                      	'min_range' => $min,
				                      	'default' => $min,
                     	)
	);
	$out = [$string, filter_var($string, FILTER_VALIDATE_INT, $options)];

	return $out;


}

?>