<?php
$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $movies = $pdo->query("select * from movies where id = $id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Movies </title>
</head>
<body>
<br>
<a href="index.php"> Return </a>
<?php
foreach($movies as $row) { ?>
    <h1> <?php
        echo $row["title"] . ' - ';
        echo $row["duur"] . ' ';
        echo "minutes";
        ?>
    </h1>

    <form action="filmsUpdate.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">

        <p>Title:  <input type="text" name="titleUpdate" value="<?php echo $row["title"] ?>"></p>
        <p>Duration:  <input type="number" name="durationUpdate" value="<?php echo $row["duur"] ?>"></p>
        <p>Release date: <input type="text" name="releaseUpdate" value="<?php echo $row["datum_van_uitkomst"] ?>" ></p>
        <p>Trailer: <input type="text" name="trailerUpdate" value="<?php echo $row["youtube_trailer_id"] ?>"></p> <br>


        <?php
        $videoId = $row["youtube_trailer_id"];
        echo(" <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/$videoId\" frameborder=\"0\"
                       allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe> <br>");
        ?>

        <input type="submit" name="update" value="Update">
    </form>
<?php } ?>
</body>
</html>