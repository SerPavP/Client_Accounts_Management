# Client Accounts Management

Этот проект представляет собой интерфейс для управления аккаунтами клиентов. Он позволяет добавлять, редактировать, удалять и просматривать список аккаунтов с поддержкой пагинации.

## Функционал
1. **Добавление аккаунта**
2. **Редактирование аккаунта**
3. **Удаление аккаунта**
4. **Список аккаунтов** с постраничной навигацией (pagination)

## Технологии

- **Backend**: PHP с использованием ООП
- **Frontend**: HTML, CSS, JavaScript
- **База данных**: MySQL
- **Пакетный менеджер**: Composer для управления зависимостями (если требуется)

## Установка и настройка

1. Склонируйте репозиторий на ваш локальный компьютер:
    ```sh
    git clone https://github.com/SerPavP/Client_Accounts_Management
    ```

2. Перейдите в директорию проекта:
    ```sh
    cd client-account
    ```

3. Создайте базу данных MySQL и импортируйте схему базы данных из файла `database.sql`:
    ```sql
    CREATE DATABASE clients_accounts;
    USE clients_accounts;
    SOURCE path/to/database.sql;
    ```

4. Настройте соединение с базой данных в файле `app/Database.php`:
    ```php
    private $host = 'localhost';
    private $db_name = 'clients_accounts';
    private $username = 'tester';
    private $password = 'test';
    ```

5. Убедитесь, что веб-сервер (например, Apache или Nginx) настроен для работы с вашим проектом.

