<?php
session_start();

if (isset($_SESSION['words'])) {
    $words = $_SESSION['words'];
}else{
    $words = [];

}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'add':
            if (isset($_POST['word'])) {
                $words[] = $_POST['word'];
                $_SESSION['words'] = $words;
            }
            break;
        case "remove":
            $_SESSION['words'] = [];
            $words = ['asdf'];
            break;
    }
}

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