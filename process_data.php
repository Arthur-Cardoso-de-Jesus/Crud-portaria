<?php

include ("config.php");
//process_data.php

if(isset($_POST["query"]))
{	

	$data = array();

	$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);
 
	$query = "
	SELECT pkIdUsuario, numDocUsuario, nomeUsuario FROM tbUsuarios 
		WHERE nomeUsuario LIKE '%".$condition."%' OR numDocUsuario LIKE '%".$condition."%' 
		ORDER BY pkIdUsuario DESC 
	";

	$result = $conn->query($query);

	$replace_string = '<b>'.$condition.'</b>';

	foreach($result as $row)
	{
		$data[] = array(
			'nomeUsuario'		=>	str_ireplace($condition, $replace_string, $row["nomeUsuario"]),
            'numDocUsuario'     =>  str_ireplace($condition, $replace_string, $row["numDocUsuario"]),
			'pkIdUsuario'       =>  str_ireplace($condition, $replace_string, $row["pkIdUsuario"])
		);
	}

	echo json_encode($data);
}

$post_data = json_decode(file_get_contents('php://input'), true);

if(isset($post_data['search_query']))
{

	$data = array(
		':search_query'		=>	$post_data['search_query']
	);

	$query = "
	SELECT pkIdUsuario, nomeUsuario, numDocUsuario FROM tbUsuarios 
	WHERE numDocUsuario = :search_query OR nomeUsuario = :search_query
	";

	$statement = $conn->prepare($query);

	$statement->execute($data);
}

?>
