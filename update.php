<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Update Movie</title>
</head>

<body>
    <?php
    // az update.php egy film frissítési űrlapot kínál az adott film azonosítójának alapján az oldal az űrlapról érkező adatokkal frissíti a film adatait, majd átirányítja a felhasználót egy másik oldalra, hogy megjelenítse az új információkat

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("Hiányzik az 'id' paraméter az URL-ből.");
    }

    $movies_json = file_get_contents('movies.json');
    $movies = json_decode($movies_json, true);

    foreach ($movies as $index => $movie) {
        if ($movie['id'] == $id) {
            break;
        }
    }

    if (!isset($movies[$index])) {
        die("Nem található film az adott azonosítóval.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $movies[$index]['title'] = $_POST['title'];
        $movies[$index]['year'] = $_POST['year'];
        $movies[$index]['category_id'] = $_POST['category_id'];
        $movies[$index]['description'] = $_POST['description'];

        file_put_contents('movies.json', json_encode($movies, JSON_PRETTY_PRINT));

        header('Location: show_movies.php?delete_msg="Sikeresen frissítetted az adatokat"');
        exit;
    }
    ?>
    <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <label>Cím:</label><br>
        <input type="text" name="title" required value="<?php echo $movie['title']; ?>"><br>
        <label>Megjelenés éve:</label><br>
        <input type="number" name="year" required value="<?php echo $movie['year']; ?>"><br>
        <label>Kategória:</label><br>
        <input type="radio" name="category_id" value="1" <?php if ($movie['category_id'] == 1) echo "checked"; ?> required> Sci-fi<br>
        <input type="radio" name="category_id" value="2" <?php if ($movie['category_id'] == 2) echo "checked"; ?> required> Akció<br>
        <input type="radio" name="category_id" value="3" <?php if ($movie['category_id'] == 3) echo "checked"; ?> required> Vígjáték<br>
        <input type="radio" name="category_id" value="4" <?php if ($movie['category_id'] == 4) echo "checked"; ?> required> Dráma<br>
        <label>Leírás:</label><br>
        <textarea name="description" required><?php echo $movie['description']; ?></textarea><br>
        <button type="submit">Film frissítése</button>
    </form>
</body>

</html>