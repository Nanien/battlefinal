<?php 

	$db = new PDO ("mysql:host=localhost; dbname=moisweb", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$req = $db->prepare('DELETE FROM habitants WHERE id = ?');
	$req->execute([$_GET['id_habitant']]);

	if ($delete) 
	{
		header('Location: habitants-1.php?id=' .$_GET['id']);
	}

	$continents = $request->fetchAll(PDO::FETCH_OBJ);

 ?>