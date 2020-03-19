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
    $series = $pdo->query("select * from series where id = $id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Series </title>
</head>
<body>
<br>
<a href="index.php"> Return </a>
<?php
foreach($series as $row) { ?>
    <h1> <?php
        echo $row["title"] . ' - ';
        echo $row["rating"] . ' ';
        ?>
    </h1>
    <form action="seriesUpdate.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">

        <p>Title: <input type="text" name="titleUpdate" value="<?php echo $row["title"] ?>"></p>
        <p>Awards: <input type="text" name="awardUpdate" value="<?php echo $row["has_won_awards"] ?>"></p>
        <p>Rating: <input type="text" name="ratingUpdate" value="<?php echo $row["rating"] ?>"></p>
        <p>Country: <input type="text" name="countryUpdate" value="<?php echo $row["country"] ?>"><p>
        <p>Language: <input type="text" name="languageUpdate" value="<?php echo $row["language"] ?>"></p>
        <p>Seasons: <input type="text" name="seasonUpdate" value="<?php echo $row["seasons"] ?>"></p>

        <p><textarea name="descriptionUpdate" cols="60" rows="15"><?php echo $row["description"] ?></textarea></p>

        <input type="submit" name="update" value="Update">
    </form>
<?php } ?>
</body>
</html>