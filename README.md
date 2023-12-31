# Institute-Management-System

## Используемые Технологии

- **Клиентская часть:**
  - HTML
  - CSS
  - JavaScript

- **Серверная часть:**
  - PHP
  - MySQL

## Запуск Проекта

1. **Клонируйте репозиторий:**
    ```bash
        git clone https://github.com/yourusername/institute-management.git
    ```

2.  **Настройте Базу Данных:**
    Импортируйте SQL-скрипт из database.sql в вашу базу данных.

3. **Настройте Сервер:**
    Измените параметры подключения к базе данных в файле server/config.php.

4. **Запустите Локальный Сервер:**
    Используйте встроенный в PHP сервер или установите другое средство.
    ```bash
        cd path/to/project-root
        php -S localhost:8000
    ```
5. **Откройте веб-браузер:**
    Перейдите по адресу http://localhost:8000/client/index.html.

## Дополнительные Замечания
Если вы вносите изменения в базу данных, не забудьте обновить соответствующие API в папке server/api/.

Дополнительные ресурсы, такие как изображения, могут быть размещены в папке assets/.

## Лицензия
Этот проект распространяется под лицензией MIT.