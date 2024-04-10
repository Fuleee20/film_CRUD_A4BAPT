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
    <h1>Új film hozzáadása</h1>
    <form action="" method="POST">
        <label>Cím:</label><br>
        <input type="text" name="title" required><br>
        <label>Megjelenés éve:</label><br>
        <input type="number" name="year" required><br>
        <label>Kategória:</label><br>
        <input type="radio" name="category_id" value="1" required> Sci-fi<br>
        <input type="radio" name="category_id" value="2" required> Akció<br>
        <input type="radio" name="category_id" value="3" required> Vígjáték<br>
        <input type="radio" name="category_id" value="4" required> Dráma<br>
        <label>Leírás:</label><br>
        <textarea name="description" required></textarea><br>
        <button type="submit">Film hozzáadása</button>
    </form>
    <?php include 'post.php' ?>
    <?php
    //show_movies.php betölti a filmType.json nevű json fájlt, majd a kategóriákat tömbbe rendezi, ahol a kategória neve a kulcs, és a kategória azonosítója a hozzárendelt érték
    $categories_json = file_get_contents('filmType.json');
    $categories = json_decode($categories_json, true);

    $typeToCategoryId = [];
    foreach ($categories as $category) {
        $typeToCategoryId[$category['name']] = $category['cat_id'];
    }
    ?>
    <?php include 'footer.php' ?>
</body>

</html>