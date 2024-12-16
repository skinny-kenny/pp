<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kfh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $phone_number = $_POST['phone_number'];
    $id_product = $_POST['id_product'];
    $quantity_product = $_POST['quantity_product'];

    $sql = "INSERT INTO clients (name, surname, patronymic, phone_number, id_product, quantity_product) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $name, $surname, $patronymic, $phone_number, $id_product, $quantity_product);

    if ($stmt->execute()) {
        $message = "Новый клиент успешно добавлен";
    } else {
        $message = "Ошибка: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить клиента</title>
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
        width: 80%; 
        max-width: 800px; 
        background: rgb(255, 255, 255);
        color: black;
        border-radius: 15px;
        padding: 30px 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .wrapper form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
    h1 {
        text-align: center;
    }
    form {
        margin-top: 20px;
    }   
    a {
        color: #000000;
        text-decoration: none;
        font-weight: 600;
    }
        .wrapper .link{
    font-size: 14.5px;
    text-align: center;
    margin-top: 20px;
 }
 .wrapper .input-box{
    width: 70%;
    height: 50px;
    margin: 15px 0;
    position: relative;
}
.input-box input{
    width: 100%; 
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(0, 0, 0, 0.2);
    border-radius: 40px;
    font-size: 16px;
    color: rgb(0, 0, 0);
    padding: 0 20px;
 }
 .wrapper label {
    align-self: flex-start;
    margin-left: 15%;
    margin-top: 10px;
}
 .wrapper .btn{
    width: 70%;
    height: 45px;
    background: #c9c9c9;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgb(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600; 
    margin-top: 20px;
 }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Добавить клиента</h1>
        <?php
        if ($message) {
            echo "<p>$message</p>";
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="surname">Фамилия:</label>
            <div class="input-box">
            <input type="text" id="surname" name="surname" required><br>
            </div>

            <label for="name">Имя:</label>
            <div class="input-box">
            <input type="text" id="name" name="name" required><br>
            </div>

            <label for="patronymic">Отчество:</label>
            <div class="input-box">
            <input type="text" id="patronymic" name="patronymic" required><br>
            </div>
            
            <label for="phone_number">Номер телефона:</label>
            <div class="input-box">
            <input type="text" id="phone_number" name="phone_number" required><br>
            </div>
            
            <label for="id_product">ID товара:</label>
            <div class="input-box">
            <input type="number" id="id_product" name="id_product" required><br>
            </div>
            
            <label for="quantity_product">Количество товара:</label>
            <div class="input-box">
            <input type="text" id="quantity_product" name="quantity_product" required><br>
            </div>

            <input type="submit" value="Добавить клиента" class="btn">
        </form>
        <div class="link">
            <p><a href="clients.php">Назад к списку клиентов</a></p>
        </div>
    </div>
</body>
</html>