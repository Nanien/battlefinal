<?php 

    $db = new PDO ("mysql:host=localhost; dbname=moisweb", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $result = $db->prepare("SELECT * FROM pays WHERE id_continent = ?");
      $result->execute([$_GET['id']]);
      $row = $result->fetchAll(); 

      $req = $db->prepare("SELECT id FROM pays WHERE id_continent = ? ORDER BY id DESC LIMIT 1 OFFSET 0");
      $req->execute([$_GET['id']]);
      $res = $req->fetch();
      $dernier_id = $res['id'];   

    // $id =  $_GET['id']; 
    // $req = 'SELECT p.nom, p.superficie, COUNT(v.nom) AS Nombre_de_ville 
    //         FROM pays AS p JOIN villes AS v 
    //         ON p.id = v.id_pays 
    //         WHERE p.id_continent IN 
    //         (SELECT id_continent FROM pays WHERE p.id_continent = ?)
    //         GROUP BY v.id_pays
    //           '; 
    if (isset($_POST['valide'])) 
    {
    
        $ins0 = $db->prepare('INSERT INTO villes(nom, superficie, id_pays) VALUES(?,?, ?)');
        $ins0->execute([$_POST['ville1'], 0, $dernier_id]);

        $ins1 = $db->prepare('INSERT INTO villes(nom, superficie, id_pays) VALUES(?,?, ?)');
        $ins1->execute([$_POST['ville2'], 0, $dernier_id]);

        $ins2 = $db->prepare('INSERT INTO villes(nom, superficie, id_pays) VALUES(?,?, ?)');
        $ins2->execute([$_POST['ville3'], 0, $dernier_id]);
        
    }
    

          
               
         
    // // var_dump($id);
    // // die();        
    
    // $result = $db->prepare($req);
    // $result->execute([$id]);
    // $row = $result->fetchAll();
    
   

    // $result = $db->prepare("SELECT * FROM pays WHERE id_continent = ?");
   
    // $result->execute([$id]);
    // $row = $result->fetchAll();
   
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
        <h2>Table des pays de l'Afrique</h2> 
      <form class="form-group" method="post">
          <input class="from-control" name="ville1" id="ville1" placeholder="Entrez un nom">
           <input class="from-control" name="ville2" id="ville2" placeholder="Entrez un nom">
            <input class="from-control" name="ville3" id="ville3" placeholder="Entrez un nom">
            <button class="btn btn-primary" name="valide">Ajouter 3 villes</button>
      </form>

      <table class="table">
        <thead>
          <tr>
            <th>nom</th>
            <th>superficie</th>
            <th>Nombre de ville</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($row as $value):
            $req = $db->prepare("SELECT COUNT(id) AS Nombre_de_ville FROM villes WHERE id_pays = ?");
            $req->execute([$value['id']]);
            $Nombre_de_ville = $req->fetch(PDO::FETCH_OBJ); ?>
          <tr>
            <td><?= $value['nom'] ?></td>
            <td><?= $value['superficie'] ?></td>
            <td><?= $value['Nombre_de_ville'] ?></td>  
          </tr>
            <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
