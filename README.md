Yii 2 Simple blog with REST
============================



API
------------
GET (/api) - index, you can use filter and sorting (/api?PostSearch[description]=test&sort=description)

POST (/api) - create record (you have to use your access-token, it shows into your profile)

PUT (/api/[id]) - change your record (you have to use your access-token, it shows into your profile)

DELETE (/api/[id]) - delete your record (marks as unactive) (you have to use your access-token, it shows into your profile)

API using examples placed in [/controllers/TestController.php](https://github.com/YGugnin/blog/blob/master/controllers/TestController.php)

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

