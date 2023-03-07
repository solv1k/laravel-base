<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## О проекте

Универсальный шаблон веб-приложения c использованием пакетного менеджера [Packager](https://github.com/Jeroen-G/laravel-packager) и архитектуры [Porto](https://github.com/Mahmoudz/Porto).

За основу взят PHP-фреймворк [Laravel](https://laravel.com/docs).

Используются следующие библиотеки и пакеты:
- [Spatie: Laravel Data](https://spatie.be/docs/laravel-data/v3/introduction)
- [Spatie: Laravel Permissions](https://spatie.be/docs/laravel-permission/v5/introduction)
- [Spatie: Laravel Media Library](https://spatie.be/docs/laravel-medialibrary/v10/introduction)
- [Nova (Admin Panel)](https://nova.laravel.com)
- [Laravel Passport](https://laravel.com/docs/10.x/passport)
- [JWT-auth](https://github.com/tymondesigns/jwt-auth)
- [IDE-helper](https://github.com/barryvdh/laravel-ide-helper)

## Установка

Все команды необходимо выполнять в терминале, находясь непосредственно в папке с проектом.

1. `cp .env.example .env`
2. `composer config http-basic.nova.laravel.com <email> <license-key>` - вместо `<email>` и `<license-key>` укажите свои креды для Nova.
3. `composer install`
4. `php artisan sail:install` - выбираем: pgsql, redis, minio, mailpit.
5. `sail up -d`
6. `sail artisan nova:install`
7. `sail migrate`
8. `sail artisan db:seed --class=Curia\\Auth\\Database\\Seeders\\UsersSeeder`

## Minio (S3 хранилище)

Для полноценной работы проекта вам потребуется настроить Minio.

### Авторизация

По умолчанию путь к консоли Minio расположен по адресу: [http://127.0.0.1:8900/](http://127.0.0.1:8900/)

**Данные для входа:** логин `sail`, пароль `password`

### Настройка

**Для начала необходимо создать новый bucket:**
[http://127.0.0.1:8900/buckets/add-bucket](http://127.0.0.1:8900/buckets/add-bucket) - просто впишите имя в поле `Bucket Name` и нажмите на кнопку `Create Bucket`

**Сделайте bucket публичным:**
перейдите по адресу [http://127.0.0.1:8900/buckets](http://127.0.0.1:8900/buckets) и выберите свой бакет. В открывшемся окне нажмите на иконку карандаша, рядом с тектом `Access Policy` и выберите `Public` из выпадающего списка в форме. Не забудьте сохранить изменения кнопкой `Set`.

**Далее создайте новый ключ для доступа к Minio по адресу:**
[http://127.0.0.1:8900/access-keys/new-account](http://127.0.0.1:8900/access-keys/new-account)

**Осталось прописать все данные в** `.env` (в параметрах AWS_ACCESS_KEY_ID и AWS_SECRET_ACCESS_KEY необходимо указать созданный ранее ключ, а в AWS_BUCKET назание вашего бакета):
```yml
AWS_URL=http://minio:9000
AWS_BUCKET=curia
AWS_ACCESS_KEY_ID=vdKtAHVY7gg4qUNy
AWS_SECRET_ACCESS_KEY=LUtMHVlqBm5BxFify5YvXhZuVnCHHV9i
AWS_DEFAULT_REGION=us-east-1
AWS_USE_PATH_STYLE_ENDPOINT=true
```

## Проверка работоспособности API

Делаем запрос `GET /api/v1/base/test` - можно прямо в URL-строке браузера.

## Вход в админ-панель

По умолчанию вход в админ-панель расположен по адресу: [http://127.0.0.1/nova/login](http://127.0.0.1/nova/login)

**Данные для входа:** почта `super@admin.com`, пароль `password`