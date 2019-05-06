<?php 

    $db = new PDO ("mysql:host=localhost; dbname=moisweb", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $db->prepare("SELECT * FROM continents WHERE id_planete = 1");
    $result->execute([]);
    $row = $result->fetchAll(PDO::FETCH_OBJ);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Table des continents</h2>      
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     <?php foreach ($row as $value):?>
      <tr>
        <td><?= $value->nom ?></td>
        <td><?= $value->superficie ?></td>
        <td>
            <a href="pays.php?id=<?= $value->id ?>" class="btn btn-primary">Voir pays</a>
            <a  href="villes.php?id=<?= $value->id ?>" class="btn btn-success">Voir villes</a>
            <a href="habitants-1.php?id=<?= $value->id ?>" class="btn btn-danger" href="">Voir habitants</a>
        </td>     
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>

</body>
</html>
