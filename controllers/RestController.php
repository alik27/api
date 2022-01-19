<?php

namespace app\controllers;

use app\models\Moderator;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\Controller;
use app\models\Expert;

class RestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
                'registration',
            ],
        ];

        return $behaviors;
    }
    protected function verbs()
    {
        return [
            'login' => ['POST'],
            'registration' => ['POST'],
        ];
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogin()
    {

        $auth = Expert::find()->select('id')
        ->andWhere(['and',
            ['pass'=>Yii::$app->request->post('pass')],
            ['login'=>Yii::$app->request->post('login')],
            ['activ'=>1],
        ])->limit(1)->one();
        $t=1;
       if($auth==null){
            $auth = Moderator::find()->select('id')
                ->andWhere(['and',['pass'=>Yii::$app->request->post('pass')],['login'=>Yii::$app->request->post('login')]])->limit(1)->one();
           $t=2;
       }
        if($auth==null){
            return $this->asJson([
                'success' => false,
            ]);
        }
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();

        // Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
            ->issuedBy('http://api')// Configures the issuer (iss claim)
            ->permittedFor('http://example.org')// Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 3600)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 100)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token

        return $this->asJson([
            'token' => (string)$token,
            'type' =>$t,
        ]);
    }

    public function actionExpert()
    {
        $auth = new Expert;
        if(Yii::$app->request->post('first_name')){
            $auth->first_name=Yii::$app->request->post('first_name');
        }
        if(Yii::$app->request->post('middle_name')){
            $auth->middle_name=Yii::$app->request->post('middle_name');
        }
        if(Yii::$app->request->post('last_name')){
            $auth->last_name=Yii::$app->request->post('last_name');
        }
        if(Yii::$app->request->post('email')){
            $auth->email=Yii::$app->request->post('email');
        }
        if(Yii::$app->request->post('birthday')){
            $auth->birthday=Yii::$app->request->post('birthday');
        }
        if(Yii::$app->request->post('sex')){
            $auth->sex=Yii::$app->request->post('sex');
        }
        if(Yii::$app->request->post('login')){
            $auth->login=Yii::$app->request->post('login');
        }
        if(Yii::$app->request->post('pass')){
            $auth->pass=Yii::$app->request->post('pass');
        }
        if(Yii::$app->request->post('about')){
            $auth->about=Yii::$app->request->post('about');
        }
        if(Yii::$app->request->post('age')){
            $auth->age=Yii::$app->request->post('age');
        }
        if(Yii::$app->request->post('work_Experience')){
            $auth->work_Experience=Yii::$app->request->post('work_Experience');
        }
            $auth->activ=0;
        if($auth->save()) {
            return $this->asJson([
                'success' => true,
            ]);
        }else{
            return $this->asJson([
                'success' => false,
            ]);
        }
    }
    public function actionModerator()
    {
        $auth = new Moderator;
        if(Yii::$app->request->post('first_name')){
            $auth->first_name=Yii::$app->request->post('first_name');
        }
        if(Yii::$app->request->post('middle_name')){
            $auth->middle_name=Yii::$app->request->post('middle_name');
        }
        if(Yii::$app->request->post('last_name')){
            $auth->last_name=Yii::$app->request->post('last_name');
        }
        if(Yii::$app->request->post('email')){
            $auth->email=Yii::$app->request->post('email');
        }
        if(Yii::$app->request->post('birthday')){
            $auth->birthday=Yii::$app->request->post('birthday');
        }
        if(Yii::$app->request->post('sex')){
            $auth->sex=Yii::$app->request->post('sex');
        }
        if(Yii::$app->request->post('login')){
            $auth->login=Yii::$app->request->post('login');
        }
        if(Yii::$app->request->post('pass')){
            $auth->pass=Yii::$app->request->post('pass');
        }
        if(Yii::$app->request->post('about')){
            $auth->about=Yii::$app->request->post('about');
        }
        if(Yii::$app->request->post('age')){
            $auth->age=Yii::$app->request->post('age');
        }
        if(Yii::$app->request->post('work_Experience')){
            $auth->work_Experience=Yii::$app->request->post('work_Experience');
        }
        if($auth->save()) {
            return $this->asJson([
                'success' => true,
            ]);
        }else{
            return $this->asJson([
                'success' => false,
            ]);
        }
    }
}