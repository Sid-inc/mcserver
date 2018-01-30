<?php 
include "MCServerStatus.php";
$server = new MCServerStatus("sidhomenetwork.asuscomm.com"); //The second argument is optional in this case
$var = $server->online; //$server->online returns true if the server is online, and false otherwise
$motd = $server->motd; //Outputs the Message of the Day
$online_players = $server->online_players; //Outputs the number of players online
$max_players = $server->max_players; //Outputs the maximum number of players the server allows
//print_r($server)//for Debagging

//Started on Bukkit
//0
//20

?>

<div class="box2">
<?php 
echo "Приветствие сервера:";
echo "<br>";
echo "<span style=\"color: white\">$motd</span>";
echo "<br>";
echo "Количество игроков онлайн:\n";
echo "<span style=\"color: white\">$online_players</span>";
echo "<br>";
echo "Максимальное количество игроков:\n";
echo "<span style=\"color: white\">$max_players</span>";
?>
</div>