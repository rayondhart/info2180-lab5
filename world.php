<?php

header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if(isset($_GET['country']))
{

  $input = $_GET['country'];
  $country = filter_var($input, FILTER_SANITIZE_STRING);
  //REMOVED $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

  $heads = array('Name', 'Continent', 'Independence Year', 'Head of State');

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $conCode = $results[0]['code'];
  
  if(isset($_GET['Lookup']) && !empty($_GET['Lookup']))
  {
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.code = '$conCode'");
    $heads = array('Name', 'District', 'Population');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}

?>

<table>
  <tr>
  <?php foreach ($heads as $column): ?>
      <th><?= $column;?></th>
  <?php endforeach ?>
  </tr> 
<?php if(count($heads) === 4): 
    foreach ($results as $column): ?>
  <tr>
      <td><?= $column['name'];?></td>
      <td><?= $column['continent'];?></td>
      <td><?= $column['independence_year'];?></td>
      <td><?= $column['head_of_state'];?></td>
  </tr>
<?php endforeach;
else: 
 foreach ($results as $column): ?>
  <tr>
      <td><?= $column['name'];?></td>
      <td><?= $column['district'];?></td>
      <td><?= $column['population'];?></td>
  </tr>
  <?php endforeach; ?>
  <?php endif; ?>
</table>