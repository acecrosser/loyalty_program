Тестовое задание "Программа лояльности по баллам"
-----------------

Для быстрого запуска на локальной машине, требуется чтоб было установленно:

* PHP 7.4
* Composer

Для начала, создаем любую папку на локальном ПК:

`mkdir name_dir`

Переходим в папку:

`cd name_dir`

Через git делаем клонирование репозитория:

`git clone https://github.com/acecrosser/loyalty_program.git`

Переходим в папку проекта:

`cd loyalty_program`

Устанавливаем все зависимости через Composer:

`composer install`

После установки, требуется создать файл базы:

`php bin\console doctrine:database:create`

Применить миграцию:

`php bin\console doctrine:migrations:migrate`

Запустить сервер:

`symfony server:start`

Перейти в браузер по адресу:

http://127.0.0.1:8000/