Yii 2 Simple blog with REST
============================


[Online version](http://blog.electrobeat.org/)

API
------------
GET (http://blog.electrobeat.org/api) - index, you can use filter and sorting (http://blog.electrobeat.org/api?PostSearch[description]=test&sort=description)

POST (http://blog.electrobeat.org/api) - create record (you have to use your access-token, it shows into your profile)

PUT (http://blog.electrobeat.org/api/[id]) - change your record (you have to use your access-token, it shows into your profile)

DELETE (http://blog.electrobeat.org/api/[id]) - delete your record (marks as unactive) (you have to use your access-token, it shows into your profile)

API using examples placed in [/controllers/TestController.php](https://github.com/YGugnin/blog/blob/master/controllers/TestController.php)

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

