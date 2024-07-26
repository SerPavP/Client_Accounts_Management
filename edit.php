<?php
include 'app/Database.php';
include 'app/Account.php';

// Создаем объект базы данных и получаем соединение
$database = new Database();
$db = $database->getConnection();

// Создаем объект Account и получаем данные аккаунта по ID
$account = new Account($db);
$account->id = $_GET['id'];
$account->readOne();

$error = '';

// Проверяем, является ли запрос методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обновляем свойства объекта Account
    $account->first_name = $_POST['first_name'];
    $account->last_name = $_POST['last_name'];
    $account->email = $_POST['email'];
    $account->company_name = $_POST['company_name'];
    $account->position = $_POST['position'];
    $account->phone1 = $_POST['phone1'];
    $account->phone2 = $_POST['phone2'] ?? null;
    $account->phone3 = $_POST['phone3'] ?? null;

    try {
        // Пытаемся обновить аккаунт
        if ($account->update()) {
            header('Location: index.php'); // Перенаправление на главную страницу при успешном обновлении
            exit;
        }
    } catch (PDOException $e) {
        // Обрабатываем ошибку дублирования email
        if ($e->getCode() == 23000) {
            $error = 'Такая почта уже используется';
        } else {
            $error = 'Ошибка при обновлении аккаунта';
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Редактировать аккаунт</title>
    <link rel="stylesheet" type="text/css" href="assets/css/add_edit_styles.css">
    <script src="assets/js/phoneFields.js"></script>
</head>
<body>
<h1>Редактировать аккаунт</h1>

<?php if ($error): ?>
    <div class="error-message"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" class="account-form">
    <div>
        <label for="first_name">Имя*:</label>
        <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($account->first_name) ?>" required>
        <label for="last_name">Фамилия*:</label>
        <input type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($account->last_name) ?>" required>
    </div>
    <div>
        <label for="email">Email*:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($account->email) ?>" required>
    </div>
    <div>
        <label for="company_name">Компания:</label>
        <input type="text" name="company_name" id="company_name" value="<?= htmlspecialchars($account->company_name) ?>">
    </div>
    <div>
        <label for="position">Должность:</label>
        <input type="text" name="position" id="position" value="<?= htmlspecialchars($account->position) ?>">
    </div>
    <div id="phoneFields">
        <label id="phone1Label" for="phone1">Телефон*:</label>
        <input type="text" name="phone1" id="phone1" class="phone" value="<?= htmlspecialchars($account->phone1) ?>">
        <?php if (!empty($account->phone2)): ?>
            <div id="phone2Div">
                <label for="phone2">Телефон 2:</label>
                <input type="text" name="phone2" id="phone2" class="phone" value="<?= htmlspecialchars($account->phone2) ?>">
                <img src="assets/img/remove.png" alt="Удалить телефон" class="remove-phone" onclick="removePhoneField(2)">
            </div>
        <?php endif; ?>
        <?php if (!empty($account->phone3)): ?>
            <div id="phone3Div">
                <label for="phone3">Телефон 3:</label>
                <input type="text" name="phone3" id="phone3" class="phone" value="<?= htmlspecialchars($account->phone3) ?>">
                <img src="assets/img/remove.png" alt="Удалить телефон" class="remove-phone" onclick="removePhoneField(3)">
            </div>
        <?php endif; ?>
        <img src="assets/img/add.png" id="addPhone" class="add-phone" alt="Добавить телефон">
    </div>
    <button type="submit">Обновить аккаунт</button>
</form>
</body>
</html>
