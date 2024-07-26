document.addEventListener('DOMContentLoaded', function() {
    // Функция для применения маски к полю телефона
    function applyPhoneMask(phoneField) {
        phoneField.addEventListener('input', function() {
            let value = phoneField.value.replace(/\D/g, '').substring(0, 11);
            if (value.length > 0) {
                value = '+' + value;
                if (value.length > 2) {
                    value = value.replace(/^(\+\d)(\d)/, '$1($2');
                }
                if (value.length > 5) {
                    value = value.replace(/(\+\d\(\d{3})(\d)/, '$1)-$2');
                }
                if (value.length > 8) {
                    value = value.replace(/(\+\d\(\d{3}\)-\d{3})(\d)/, '$1-$2');
                }
                if (value.length > 10) {
                    value = value.replace(/(\+\d\(\d{3}\)-\d{3}-\d{2})(\d)/, '$1-$2');
                }
            }
            phoneField.value = value;
        });
    }

    // Проверка, что номер телефона введен полностью
    function isPhoneComplete(phoneField) {
        const value = phoneField.value.replace(/\D/g, '');
        return value.length === 11;
    }

    // Применение маски к полю phone1 при загрузке страницы
    applyPhoneMask(document.getElementById('phone1'));

    const phoneFieldsContainer = document.getElementById('phoneFields');
    const addPhoneButton = document.getElementById('addPhone');
    let phoneCount = 1;

    // Обновление меток для полей телефонов
    function updateLabels() {
        for (let i = 1; i <= phoneCount; i++) {
            const label = document.getElementById(`phone${i}Label`);
            if (label) {
                label.textContent = `Телефон ${i}${i === 1 ? '' : ''}:`;
            }
        }
    }

    // Обновление состояния кнопки удаления для второго поля телефона
    function updateDeleteButtonVisibility() {
        const phone2DeleteButton = document.querySelector('#phone2Div .remove-phone');
        if (phoneCount === 3 && phone2DeleteButton) {
            phone2DeleteButton.disabled = true;
            phone2DeleteButton.classList.add('disabled');
        } else if (phone2DeleteButton) {
            phone2DeleteButton.disabled = false;
            phone2DeleteButton.classList.remove('disabled');
        }
    }

    // Функция для добавления нового поля телефона
    function addPhoneField() {
        if (phoneCount < 3) {
            phoneCount++;
            const newPhoneDiv = document.createElement('div');
            newPhoneDiv.id = `phone${phoneCount}Div`;
            newPhoneDiv.classList.add('phone-field');

            const newLabel = document.createElement('label');
            newLabel.id = `phone${phoneCount}Label`;
            newLabel.htmlFor = `phone${phoneCount}`;
            newLabel.textContent = `Телефон ${phoneCount}:`;

            const newPhoneField = document.createElement('input');
            newPhoneField.type = 'text';
            newPhoneField.name = `phone${phoneCount}`;
            newPhoneField.id = `phone${phoneCount}`;
            newPhoneField.classList.add('phone');
            applyPhoneMask(newPhoneField);

            const deleteButton = document.createElement('img');
            deleteButton.src = 'assets/img/remove.png';
            deleteButton.alt = 'Удалить телефон';
            deleteButton.classList.add('remove-phone');
            deleteButton.addEventListener('click', function() {
                removePhoneField(phoneCount);
            });

            newPhoneDiv.appendChild(newLabel);
            newPhoneDiv.appendChild(newPhoneField);
            newPhoneDiv.appendChild(deleteButton);
            phoneFieldsContainer.appendChild(newPhoneDiv);

            updateLabels();
            updateDeleteButtonVisibility();

            // Блокировка кнопки добавления телефона, если добавлено 3 поля
            if (phoneCount === 3) {
                addPhoneButton.disabled = true;
                addPhoneButton.classList.add('disabled');
            }
        }
    }

    // Функция для удаления поля телефона
    function removePhoneField(phoneNumber) {
        const phoneDiv = document.getElementById(`phone${phoneNumber}Div`);
        phoneFieldsContainer.removeChild(phoneDiv);
        phoneCount--;

        // Разблокировка кнопки добавления телефона, если количество полей меньше 3
        if (phoneCount < 3) {
            addPhoneButton.disabled = false;
            addPhoneButton.classList.remove('disabled');
        }

        updateLabels();
        updateDeleteButtonVisibility();
    }

    // Проверка заполненности всех полей телефонов перед отправкой формы
    function validatePhones() {
        const phone1 = document.getElementById('phone1');
        if (phone1.value.length > 1 && !isPhoneComplete(phone1)) {
            alert('Поле "Телефон 1" заполнено некорректно.');
            return false;
        }
        for (let i = 2; i <= phoneCount; i++) {
            const phoneField = document.getElementById(`phone${i}`);
            if (phoneField && !isPhoneComplete(phoneField)) {
                alert(`Поле "Телефон ${i}" заполнено некорректно.`);
                return false;
            }
        }
        return true;
    }

    // Привязка функции добавления нового поля телефона к кнопке
    addPhoneButton.addEventListener('click', function() {
        if (!addPhoneButton.disabled) {
            addPhoneField();
        }
    });

    // Проверка формы перед отправкой
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!validatePhones()) {
            event.preventDefault();
        }
    });

    // Инициализация меток
    updateLabels();
});
