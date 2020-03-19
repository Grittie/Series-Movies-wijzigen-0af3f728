<?php
$host="localhost";
$db = "netland";
$username = "root";
$password = "";

$dsn= "mysql:host=$host;dbname=$db";
try {
    // create a PDO connection with the configuration data
    $pdo = new PDO($dsn, $username, $password);

    // display a message if connected to database successfully
    if ($pdo) {
    }
} catch (PDOException $e) {
    // report error message
    echo $e->getMessage();
}

if (isset($_POST["id"])) {
    $id = $_POST["id"];

    $titleUpdate = $_POST["titleUpdate"];
    $durationUpdate = $_POST["durationUpdate"];
    $releaseUpdate = $_POST["releaseUpdate"];
    $trailerUpdate = $_POST["trailerUpdate"];

    $pdo->query(
        "UPDATE movies 
        SET title = '$titleUpdate', 
        duur = $durationUpdate, 
        datum_van_uitkomst = '$releaseUpdate', 
        youtube_trailer_id = '$trailerUpdate' 
        WHERE id = $id"
    );
}

header("Refresh: 1; url=films.php?id=$id");
exit("This will only take a second...");

?>