<?php
//!!!!!!!! IMPORTANT THIS IS TEST FILE. JUST 4 TEST API
namespace app\controllers;

use Yii;
use yii\web\Controller;

class TestController extends Controller{
    public function actionCreate(){
        $service_url = 'http://blog.loc/api?access-token=7184807479ea2d012d4baca9b1154d99';
        $curl = curl_init($service_url);
        $curl_post_data = [
            'title' => 'Test Post ('.date("Y-m-d H:i:s").')',
            'description' => 'Test Description ('.date("Y-m-d H:i:s").')'
        ];
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);
        $info = curl_getinfo($curl);
        if ($curl_response === false) {
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        var_export($info);
        curl_close($curl);
        var_dump($curl_response);
        die();
    }

    public function actionUpdate(){
        $service_url = 'http://blog.loc/api/22?access-token=7184807479ea2d012d4baca9b1154d99';
        $curl = curl_init($service_url);
        $curl_post_data = [
            'title' => 'changed Post ('.date("Y-m-d H:i:s").')',
            'description' => 'changed Description ('.date("Y-m-d H:i:s").')'
        ];
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($curl_post_data));
        $curl_response = curl_exec($curl);
        $info = curl_getinfo($curl);
        if ($curl_response === false) {
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        var_export($info);
        curl_close($curl);
        var_dump($curl_response);
        die();
    }

    public function actionDelete(){
        $service_url = 'http://blog.loc/api/5?access-token=7184807479ea2d012d4baca9b1154d99';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        $curl_response = curl_exec($curl);
        $info = curl_getinfo($curl);
        if ($curl_response === false) {
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        var_export($info);
        curl_close($curl);
        var_dump($curl_response);
        die();
    }
    public function actionGet(){
        $service_url = 'http://blog.loc/api?expand=user';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $info = curl_getinfo($curl);
        if ($curl_response === false) {
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        var_export($info);
        curl_close($curl);
        var_dump($curl_response);
        die();
    }
}