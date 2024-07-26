-- Создание базы данных и таблицы accounts

CREATE DATABASE IF NOT EXISTS clients_accounts;

USE clients_accounts;

CREATE TABLE IF NOT EXISTS accounts (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    company_name VARCHAR(255),
    position VARCHAR(255),
    phone1 VARCHAR(20),
    phone2 VARCHAR(20),
    phone3 VARCHAR(20)
    );

-- Добавление тестовых данных

INSERT INTO accounts (first_name, last_name, email, company_name, position, phone1, phone2, phone3)
VALUES
    ('John', 'Doe', 'john.doe@example.com', 'Example Inc.', 'Manager', '123-456-7890', '098-765-4321', '567-890-1234'),
    ('Jane', 'Smith', 'jane.smith@example.com', 'Example Corp.', 'Engineer', '234-567-8901', '876-543-2109', '678-901-2345'),
    ('Jim', 'Beam', 'jim.beam@example.com', 'Bourbon Ltd.', 'Sales', '345-678-9012', '765-432-1098', '789-012-3456');
