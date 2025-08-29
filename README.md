Виконайте наступні кроки, щоб розгорнути проєкт локально.

1. Клонуйте репозиторій
```Bash
git clone <URL-вашого-репозиторію>
cd <назва-папки-проєкту>
```
2. Створіть файл конфігурації
Скопіюйте файл .env.example та створіть на його основі .env.

```Bash
cp .env.example .env
```
У файлі .env вже налаштовані змінні для роботи з Docker. Нічого змінювати не потрібно, оскільки DB_HOST вже вказує на назву сервісу mariadb з docker-compose.yml.

3. Запустіть Docker контейнери
Ця команда збере та запустить усі необхідні контейнери (веб-сервер, PHP, MariaDB) у фоновому режимі.

```Bash
docker-compose up -d --build
```

4. Встановіть залежності PHP
Запустіть Composer всередині app контейнера для встановлення всіх пакетів.

```Bash
docker-compose exec app composer install
```
5. Згенеруйте ключ програми
Це обов'язковий крок для будь-якого Laravel-проєкту.

```Bash
docker-compose exec app php artisan key:generate
```
6. Застосуйте міграції бази даних
Ця команда створить усі необхідні таблиці в базі даних MariaDB.

```Bash
docker-compose exec app php artisan migrate
```
