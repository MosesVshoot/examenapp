<?php
//Generar respuesta Json con PHP y MySQL
	
	//Se genera la conexión a la base de datos MySQL
	$host="localhost";
	$usuario="root";
	$pass="reloj.com12";
	$bd='musica';
	
	$servidor= new mysqli($host,$usuario,$pass,$bd);
	//Se elige el formato de datos para la conexion UTF8
	mysqli_set_charset($servidor, "utf8");
	$consulta="select * from lista";
	$sql=$servidor->query($consulta);
	//mysqli_set_charset($sql, "utf8");
	
	//Se prepara la petición
	//Se establece la consulta ala BD
	if (!$sql){
		echo "Fallo al conectar MySQL";
	}
	else{
		//Se declara un arreglo
		$datos=array();
		//Se genera el archivo Json en un arreglo de php
		while ($obj=mysqli_fetch_object($sql)) {
			$datos[]=array('id'=>$obj->id,
			'BandArtista'=>utf8_encode($obj->bandartista),
			'Cancion'=>$obj->cancion);
			/*'Opuno'=>$obj->opuno),
			'Opdos'=>$obj->opdos),
			'Optres'=>$obj->optres);*/
		}
		//Se transforman los datos del arreglo a un formato json para su uso con otros lenguajes	
		echo '' . json_encode($datos) . ''; 
		//Se cierra la conexión
		mysqli_close ($servidor);
	
		//Se declara que será una aplicación que genera un Json
		header('Content-type: application/json');
		//Se abre el acceso a las conexiones que requieren de esta aplicación
		header("Access-Control-Allow-Origin: *");	
	}
?>