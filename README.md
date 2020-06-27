Инструкция по запуску приложения:
1. Выполнить в консоли git clone https://github.com/aic513/test-api.git
2. В папке проекта запустить команду make run
3. После того, как контейнеры запустились, пишем в консоли docker-compose exec fpm bash
4. Выполняем  cd ../laravel-api/ && php artisan migrate:fresh --seed

Troubleshooting:

 Если возникли проблемы с правами доступа, внутри контейнера fpm выполняем:
 - chown -R $USER:www-data storage
 - chown -R $USER:www-data bootstrap/cache
 - chmod -R 775 storage
 - chmod -R 775 bootstrap/cache
 - chown -R :www-data /var/www/laravel-api/
 - chmod -R 775 /var/www/laravel-api/database/database.db
 - chown -R $(whoami) /var/www/laravel-api/database/database.db

Проект доступен по адресу http://localhost:8095

Методы:

POST /api/indicators/ - генерация случайного значения и его идентификатора с возможностью задать входные параметры в теле запроса,

GET /api/indicators/{id} - получение значения по id, которое вернулось в методе создания,

GET /api/indicators/ - получение списка всех индентификаторов.







