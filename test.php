<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, word FROM words";
$result = $conn->query($sql);

$words = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $words[] = $row['word'];
    }
}
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'add':
            if (isset($_POST['word'])) {
                $conn->query("INSERT INTO words (word) VALUES ('". $_POST['word'] . "')");
                $words[] = $_POST['word'];
            }
            break;
        case "remove":
            $words = [];
            $conn->query("DELETE FROM words");
            break;
    }
}

$conn->close();

?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

</head>
<body>
<ul>
    <? foreach ($words as $word): ?>
        <li><?= $word ?></li>
    <? endforeach; ?>
</ul>

<div>
    <h1>Add new word</h1>
    <form method="post" class="form">
        <input type="hidden" name="action" value="add">
        <input name="word">
        <input type="submit" class="btn btn-default">
    </form>

    <h2>Remove all</h2>
    <form method="post" class="form">
        <input type="hidden" name="action" value="remove">
        <input type="submit" class="btn btn-default">
    </form>
</div>
</body>
</html>