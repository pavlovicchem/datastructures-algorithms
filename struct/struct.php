<?php
/*
Struct datastructure is associative array of key value pairs of different types
we can implement it using php arrays or php classes
php arrays are faster in construction and operation, but are more space consuming
*/
// Implementing struct as PHP associative array
$player = [
"name" => "Ronaldo",
"country" => "Portugal",
"age" => 31,
"currentTeam" => "Real Madrid"
];

// Implementing struct as PHP Class
class Player {
  public $name;
  public $country;
  public $age;
  public $currentTeam;
}

$ronaldo = new Player;
$ronaldo->name = "Ronaldo";
$ronaldo->country = "Portugal";
$ronaldo->age = 31;
$ronaldo->currentTeam = "Real Madrid";


?>
