<?php
include 'app/Database.php';
include 'app/Account.php';

$error = '';

// Проверяем, является ли запрос методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Создаем объект базы данных и получаем соединение
    $database = new Database();
    $db = $database->getConnection();

    // Создаем объект Account и задаем свойства
    $account = new Account($db);
    $account->first_name = $_POST['first_name'];
    $account->last_name = $_POST['last_name'];
    $account->email = $_POST['email'];
    $account->company_name = $_POST['company_name'];
    $account->position = $_POST['position'];
    $account->phone1 = $_POST['phone1'];
    $account->phone2 = $_POST['phone2'] ?? null;
    $account->phone3 = $_POST['phone3'] ?? null;

    try {
        // Пытаемся создать новый аккаунт
        if ($account->create()) {
            header('Location: index.php'); // Перенаправление на главную страницу при успешном создании
            exit;
        }
    } catch (PDOException $e) {
        // Обрабатываем ошибку дублирования email
        if ($e->getCode() == 23000) {
            $error = 'Такая почта уже используется';
        } else {
            $error = 'Ошибка при добавлении аккаунта';
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Добавить аккаунт</title>
    <link rel="stylesheet" type="text/css" href="assets/css/add_edit_styles.css">
    <script src="assets/js/phoneFields.js"></script>
</head>
<body>
<h1>Добавить новый аккаунт</h1>

<?php if ($error): ?>
    <div class="error-message"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" class="account-form">
    <div>
        <label for="first_name">Имя*:</label>
        <input type="text" name="first_name" id="first_name" required>
        <label for="last_name">Фамилия*:</label>
        <input type="text" name="last_name" id="last_name" required>
    </div>
    <div>
        <label for="email">Email*:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="company_name">Компания:</label>
        <input type="text" name="company_name" id="company_name">
    </div>
    <div>
        <label for="position">Должность:</label>
        <input type="text" name="position" id="position">
    </div>
    <div id="phoneFields">
        <label id="phone1Label" for="phone1">Телефон*:</label>
        <input type="text" name="phone1" id="phone1" class="phone">
        <img src="assets/img/add.png" id="addPhone" class="add-phone" alt="Добавить телефон">
    </div>
    <button type="submit">Добавить аккаунт</button>
</form>
</body>
</html>
