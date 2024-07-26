/**
 * Функция для отображения указанного количества колонок с телефонами
 * @param {number} count - Количество колонок с телефонами для отображения
 */
function showPhoneColumns(count) {
    // Скрываем все колонки с телефонами
    var allColumns = document.querySelectorAll('.phone-column');
    allColumns.forEach(function(column) {
        column.style.display = 'none';
    });

    // Показываем нужное количество колонок с телефонами
    for (var i = 1; i <= count; i++) {
        var columnsToShow = document.querySelectorAll('.phone' + i);
        columnsToShow.forEach(function(column) {
            column.style.display = 'table-cell';
        });
    }
}

// Ждем загрузки контента страницы, чтобы применить начальные настройки
document.addEventListener('DOMContentLoaded', function() {
    // По умолчанию показывать только Phone 1
    showPhoneColumns(1);
});
