<?php
include 'app/Database.php';
include 'app/Account.php';

$database = new Database();
$db = $database->getConnection();

$users = [
    ['John', 'Doe', 'john.doe@example.com', 'Example Inc.', 'Manager', '+1234567890', '+0987654321', '+5678901234'],
    ['Jane', 'Smith', 'jane.smith@example.com', 'Example Corp.', 'Engineer', '+2345678901', '+8765432109', '+6789012345'],
    ['Jim', 'Beam', 'jim.beam@example.com', 'Bourbon Ltd.', 'Sales', '+3456789012', '+7654321098', '+7890123456'],
    ['Alice', 'Johnson', 'alice.johnson@example.com', 'Tech Co.', 'Developer', '+4567890123', null, null],
    ['Bob', 'Brown', 'bob.brown@example.com', 'Health Inc.', 'Doctor', '+5678901234', null, null],
    ['Charlie', 'Davis', 'charlie.davis@example.com', 'Edu Corp.', 'Teacher', '+6789012345', null, null],
    ['David', 'Evans', 'david.evans@example.com', 'FinTech Ltd.', 'Analyst', '+7890123456', null, null],
    ['Eve', 'White', 'eve.white@example.com', 'Retail Co.', 'Cashier', '+8901234567', null, null],
    ['Frank', 'Black', 'frank.black@example.com', 'Transport Inc.', 'Driver', '+9012345678', null, null],
    ['Grace', 'Green', 'grace.green@example.com', 'Media Ltd.', 'Reporter', '+0123456789', null, null],
    ['Henry', 'Blue', 'henry.blue@example.com', 'Design Co.', 'Designer', '+1234509876', null, null],
    ['Ivy', 'Orange', 'ivy.orange@example.com', 'Food Inc.', 'Chef', '+2345610987', null, null],
    ['Jack', 'Purple', 'jack.purple@example.com', 'Construction Co.', 'Builder', '+3456721098', null, null],
    ['Kathy', 'Red', 'kathy.red@example.com', 'Cleaning Ltd.', 'Janitor', '+4567832109', null, null],
    ['Leo', 'Yellow', 'leo.yellow@example.com', 'Entertainment Inc.', 'Actor', '+5678943210', null, null]
];

foreach ($users as $user) {
    $account = new Account($db);
    $account->first_name = $user[0];
    $account->last_name = $user[1];
    $account->email = $user[2];
    $account->company_name = $user[3];
    $account->position = $user[4];
    $account->phone1 = $user[5];
    $account->phone2 = $user[6];
    $account->phone3 = $user[7];

    if ($account->create()) {
        echo "User {$user[0]} {$user[1]} added successfully.<br>";
    } else {
        echo "Error adding user {$user[0]} {$user[1]}.<br>";
    }
}
