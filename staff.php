<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kfh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete_record'])) {
    $record_id = $_POST['record_id'];
    $sql = "DELETE FROM staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $record_id);
    if ($stmt->execute()) {
        $message = "Запись успешно удалена";
    } else {
        $message = "Ошибка удаления записи: " . $conn->error;
    }
    $stmt->close();
}

$sql = "SELECT id, name, surname, patronymic, specialization FROM staff";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Персонал</title>
    <link rel="stylesheet" href="style_tb.css">
    <style>
    body { 
        font-family: Arial, sans-serif; 
        background-color: #f4f4f4; 
        margin: 0; 
        padding: 0; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        min-height: 100vh; 
        background-size: cover;
        background-position: center;
    } 
    .wrapper {
        width: 90%; 
        max-width: 1200px; 
        background: rgba(255, 255, 255, 0.9);
        color: black;
        border-radius: 15px;
        padding: 30px 40px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
    table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0; 
        background-color: white; 
        border-radius: 8px; 
        overflow: hidden; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    th, td { 
        padding: 15px; 
        text-align: left; 
        border-bottom: 1px solid #e0e0e0; 
    } 
    th { 
        background-color: #c9c9c9; 
        color: black; 
        font-weight: bold;
    } 
    tr:nth-child(even) {
        background-color: #f8f8f8;
    }
    tr:hover { 
        background-color: #f1f1f1; 
    }
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }
    .actions {
        display: flex;
        justify-content: space-around;
    }
    .actions a, .actions input[type="submit"] {
        padding: 5px 10px;
        background-color: #c9c9c9;
        color: black;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }
    .actions input[type="submit"] {
        background-color: #c9c9c9;
    }
    .actions a:hover, .actions input[type="submit"]:hover {
        opacity: 0.8;
    }
    .link {
        font-size: 14.5px;
        text-align: center;
        margin-top: 20px;
    }
    .link a {
        color: black;
        text-decoration: none;
        font-weight: 600;
    }
    .link a:hover {
        text-decoration: underline;
    }
    @media (max-width: 768px) { 
        .wrapper {
            width: 95%;
            padding: 20px;
        }
        table, thead, tbody, th, td, tr { 
            display: block; 
        }
        thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        tr { 
            border: 1px solid #ccc; 
            margin-bottom: 10px;
        }
        td { 
            border: none;
            position: relative;
            padding-left: 50%; 
        }
        td:before { 
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
            content: attr(data-label);
            font-weight: bold;
        }
    }
</style>
</head>
<body>
<div class="wrapper">
    <h1>Персонал</h1>
    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Специальность</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td data-label='ID'>".$row["id"]."</td>";
            echo "<td data-label='Фамилия'>".$row["surname"]."</td>";
            echo "<td data-label='Имя'>".$row["name"]."</td>";
            echo "<td data-label='Отчество'>".$row["patronymic"]."</td>";
            echo "<td data-label='Специальность'>".$row["specialization"]."</td>";
            echo "<td data-label='Действия'>
                    <div class='actions'>
                        <form method='post' onsubmit='return confirm(\"Вы действительно хотите удалить запись?\");'>
                            <input type='hidden' name='record_id' value='".$row["id"]."'>
                            <input type='submit' name='delete_record' value='Удалить'>
                        </form>
                        <a href='edit_staff.php?id=".$row["id"]."'>Изменить</a>
                    </div>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Записей не найдено</td></tr>";
    }
    ?>
    </tbody>
</table>
    <div class="link">
    <p><a href="adminpage.php">Назад к панели администратора</a></p>
    <p><a href="add_staff.php">Добавить нового сотрудника</a></p>
    </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>