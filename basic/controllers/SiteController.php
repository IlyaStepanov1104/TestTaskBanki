<?php

namespace app\controllers;


use app\models\Images;
use app\models\UploadImage;
use Yii;
use yii\db\Expression;
use yii\db\Query as QueryAlias;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Displays upload page.
     *
     * @return string|Response
     */
    public function actionUpload()
    {
        $model = new UploadImage();
        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstancesByName('files');
            if ($model->upload()) {
                return $this->render('confirm', ['model' => $model]);
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('upload', ['model' => $model]);
        }
    }


    public function actionView(): string
    {
        if (Yii::$app->request->get('sort') == 'time') {
            $images = (new QueryAlias())->select('*')->from('images')->orderBy('dateTime')->all();
        } else {
            $images = (new QueryAlias())->select('*')->from('images')->orderBy('path')->all();
        }
        return $this->render('view', ['images' => $images, 'sort' => Yii::$app->request->get('sort')]);
    }


    public function actionImages(): string
    {
        $model = new UploadImage();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('view', ['model' => $model]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }


    public function actionGetTotal(): string
    {
        return json_encode(array(
            'total' => count((new QueryAlias())->select('id')->from('images')->all())
        ));
    }

    public function actionGetById(): string
    {
        $id = Yii::$app->request->get('id');
        if ($id == null){
            return json_encode(['error' => 'haven\'t required get parameters - id']);
        }
        $img = (new QueryAlias())->select('*')->from('images')->where(['id' => $id])->one();
        if ($img['id'] == null){
            return json_encode(['error' => 'haven\'t image with this id!']);
        }
        return json_encode(array(
            'id' => $img['id'],
            'path' => $img['path'],
        ));
    }

    public function actionGetPages(): string
    {
        $images = (new QueryAlias())->select('*')->from('images')->all();
        $count = count($images);
        $page = Yii::$app->request->get('page');

        $images_on_page = array();
        for ($i = ($page-1)*10; $i < $page*10; $i++){
            if ($images[$i]['id'] == null) break;
            $images_on_page[] = json_encode([
                "id" => $images[$i]['id'],
                "path" => $images[$i]['path']
            ]);
        }
        if (count($images_on_page) == 0) {
            return json_encode(['error' => 'impossible to generate this page, because there are not so many images']);
        }
        return json_encode(array(
            'page' => $page,
            'list' => $images_on_page
        ));
    }
}
