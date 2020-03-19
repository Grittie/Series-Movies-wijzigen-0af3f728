<?php
// phpcs:ignoreFile
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
    $awardUpdate = $_POST["awardUpdate"];
    $ratingUpdate = $_POST["ratingUpdate"];
    $countryUpdate = $_POST["countryUpdate"];
    $languageUpdate = $_POST["languageUpdate"];
    $seasonUpdate = $_POST["seasonUpdate"];
    $descriptionUpdate = $_POST["descriptionUpdate"];

    $pdo->query(
        "UPDATE series
        SET title = '$titleUpdate',
            rating ='$ratingUpdate',
            seasons ='$seasonUpdate',
             has_won_awards = $awardUpdate,
            description = '$descriptionUpdate',
            country = '$countryUpdate',
            language = '$languageUpdate'
        WHERE id = $id"
    );
}
header("Refresh: 0; url=series.php?id=$id");
exit("This will only take a second...");

?>