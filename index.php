<?php
include 'app/Database.php';
include 'app/Account.php';

// Создаем объект базы данных и получаем соединение
$database = new Database();
$db = $database->getConnection();

// Создаем объект Account
$account = new Account($db);

// Получаем текущую страницу и вычисляем смещение для SQL-запроса
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Получаем общее количество аккаунтов и вычисляем количество страниц
$total_accounts = $account->count();
$total_pages = ceil($total_accounts / $limit);

// Получаем аккаунты для текущей страницы
$accounts = $account->readAll($offset, $limit);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Аккаунты клиентов</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <script src="assets/js/toggleColumns.js" defer></script>
</head>
<body>
<h1>Аккаунты клиентов</h1>

<div class="phone-buttons">
    <button onclick="showPhoneColumns(1)">Телефон 1</button>
    <button onclick="showPhoneColumns(2)">Телефон 1, Телефон 2</button>
    <button onclick="showPhoneColumns(3)">Телефон 1, Телефон 2, Телефон 3</button>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Email</th>
        <th>Компания</th>
        <th>Должность</th>
        <th class="phone-column phone1">Телефон 1</th>
        <th class="phone-column phone2">Телефон 2</th>
        <th class="phone-column phone3">Телефон 3</th>
        <th>Действия</th>
    </tr>
    <?php while ($row = $accounts->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['company_name']) ?></td>
            <td><?= htmlspecialchars($row['position']) ?></td>
            <td class="phone-column phone1"><?= htmlspecialchars($row['phone1']) ?></td>
            <td class="phone-column phone2"><?= htmlspecialchars($row['phone2']) ?></td>
            <td class="phone-column phone3"><?= htmlspecialchars($row['phone3']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($row['id']) ?>"><img src="assets/img/edit.png" alt="Редактировать" class="icon"></a>
                <a href="javascript:void(0);" onclick="confirmDelete('delete.php?id=<?= htmlspecialchars($row['id']) ?>')"><img src="assets/img/del.png" alt="Удалить" class="icon"></a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<ul class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li><a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a></li>
    <?php endfor; ?>
</ul>
<div class="add-account-button">
    <a href="add.php"><button>Добавить новый аккаунт</button></a>
</div>
</body>
<script>
    function confirmDelete(url) {
        if (confirm("Вы точно уверены?")) {
            window.location.href = url;
        }
    }
</script>
</html>
