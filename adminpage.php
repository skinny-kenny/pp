<?php
if (isset($_POST['view_staff'])) {
    header("Location: staff.php");
    exit();
}
if (isset($_POST['view_resources'])) {
    header("Location: resources.php");
    exit();
}
if (isset($_POST['view_products'])) {
    header("Location: products.php");
    exit();
}
if (isset($_POST['view_clients'])) {
    header("Location: clients.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="style_adminpage.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap');

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    background-color: #f4f4f4;
    background-size: cover;
    background-position: center;
}
header {
    background: #333;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
}
.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
}
.section {
    background: #fff;
    padding: 20px;
    margin: 10px 0;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    font-size: 28px;
}
.section .btn{
    width: 100%;
    height: 45px;
    background: #c9c9c9;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgb(0, 0, 0, .1);
    cursor: pointer;
    font-size: 20px;
    color: #333;
    font-weight: 600;
    margin-top: 10px;
}
.pp{
    font-size: 23px;
}
.logout-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 10px 20px;
        background-color: #c9c9c9;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    .logout-btn:hover {
        background-color: #a9a9a9;
    }
    </style>
</head>
<body>

<header>
    <h1>Панель администратора</h1>
</header>


<div class="container">

    <div id="database" class="section">
        <h2>КФХ</h2>
        <p class="pp">Управление базой данных</p>
        <form action="adminpage.php" method="post">
        <input type="submit" name="view_resources" value="Ресусры" class="btn">
        </form>
        <form action="adminpage.php" method="post">
        <input type="submit" name="view_products" value="Товары" class="btn">
        </form>
    </div>

    <div id="users" class="section">
        <h2>Персонал\клиенты</h2>
        <p class="pp">Управление персоналом\клиентами</p>
        <form action="adminpage.php" method="post">
        <input type="submit" name="view_staff" value="Персонал" class="btn">
        </form>
        <form action="adminpage.php" method="post">
        <input type="submit" name="view_clients" value="Клиенты" class="btn">
        </form>
    </div>

</div>

</body>
</html>
