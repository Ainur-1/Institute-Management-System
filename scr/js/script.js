$(document).ready(function() {
    // Загрузить header.html в момент загрузки страницы
    loadPage('#header-placeholder', 'includes/header.html');
    loadPage('#footer-placeholder', 'includes/footer.html');
});

function loadPage(placeholder, page) {
    $(placeholder).load(page);
}