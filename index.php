<?php
// az index.php feladata és funkciója, hogy egy json fájlt tárol és olvas be és a benne lévő adatokat beolvassa majd leszűri az adott kategóriákat egyenként

$movies_json = file_get_contents('movies.json');
$movies = json_decode($movies_json, true);

$categories_json = file_get_contents('filmType.json');
$categories = json_decode($categories_json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    header("Location: index.php?category_id=$category_id");
    exit;
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    if ($category_id != 'all') {
        $movies = array_filter($movies, function ($movie) use ($category_id) {
            return $movie['category_id'] == $category_id;
        });
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Filmek</title>
</head>

<body>
    <?php include 'script.php' ?>
    <?php include 'header.php' ?>
    <h1>Filmek</h1>
    <form action="" method="POST">
        <label for="category_id">Kategória:</label>
        <select name="category_id" id="category_id">
            <option value="all">Minden</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['cat_id']; ?>"><?= $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Szűrés</button>
    </form>
    <ul>
        <?php foreach ($movies as $movie) : ?>
            <li>
                <h2><?= $movie['title']; ?></h2>
                <p>Megjelenés éve: <?= $movie['year']; ?></p>
                <p>Leírás: <?= $movie['description']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php include 'footer.php' ?>
</body>

</html>