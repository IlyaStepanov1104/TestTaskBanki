# TestTaskBanki
Тестовое задание для компании banki.shop.

Формулировака задания:
    Разработать прототип хостинга изображений.

    Инструменты для реализации задания:
    - фреймворк Yii2 (обязательно)
    - mysql

    1. Реализовать форму для загрузки изображений.

    При загрузке изображений должны соблюдаться следующие правила:
    - в 1 запросе, в одной форме, можно загружать до 5 файлов
    - название каждого файла должно транслителироваться на английский язык и приводиться к нижнему регистру
    - название каждого файла должно быть уникальным, и, если файл с таким названием существует, нужно задавать новому файлу уникальное название
    - все файлы должны отправляться в одну директорию
    - записывать в БД инфу о загруженных файлах: название файла, дата и время загрузки

    2. Реализовать страницу просмотра информации об изображениях.

    На странице должны быть реализованы:
    - вывод информации о загруженных файлах (название файла, дата и время загрузки)
    - просмотр превью изображения
    - возможность просмотра оригинального изображения
    - сортировка по названию/дате и времени загрузки изображения

    3. Реализовать простое API, результат возвращать в формате JSON
    - запрос который выдает общее количество загруженных картинок {"total": 40}
    - запрос с параметром указывающим запрошенную страницу в списке, возвращает список картинок по 10 штук на страницу {"page": 1, "list": [{"id": 10, "path": "image.jpg"}]}
    - запрос c параметром id который вернет данные картинки по id {"id": 10, "path": "image.jpg"}

    Код задания необходимо выложить на github/gitlab/bitbucket.
    Бонусом будет возможность просмотра результата в общем доступе (например vds)
    
В задании выполнены все подзадачи:]  
        На каждую страницу можно перейти по кнопке в меню;  
        Для использования API необходимо отправлять запросы на следующие страницы:  
            /site/get-total - запрос который выдает общее количество загруженных картинок {"total": 40}  
            /site/get-pages?page=... - запрос с параметром указывающим запрошенную страницу в списке, возвращает список картинок по 10 штук на страницу {"page": 1, "list": [{"id": 10, "path": "image.jpg"}]}  
            /site/get-by-id?id=... - запрос c параметром id который вернет данные картинки по id {"id": 10, "path": "image.jpg"}\n
