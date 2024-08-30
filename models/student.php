<?php

namespace app\models;

use Firebase\JWT\JWT;
use yii\db\ActiveRecord;
use Yii;
use yii\web\IdentityInterface;

class Student extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'student';
    }

    public function rules()
    {
        return [
            [['name', 'fathername', 'email', 'gender' , 'subject', 'password'], 'required'],
            ['password', 'string', 'min' => 6],
            ['email', 'email'],
            ['email', 'unique'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z ]+$/', 'message' => 'Name can only contain alphabetic characters.'],
            ['fathername', 'match', 'pattern' => '/^[a-zA-Z ]+$/', 'message' => 'Father name can only contain alphabetic characters.'],
            ['subject', 'match', 'pattern' => '/^[a-zA-Z .& ]+$/', 'message' => 'Subject can only contain alphabetic characters.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Student Name',
            'fathername' => 'Father Name',
            'subject' => 'Subject',
            'gender' => 'Gender',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    
    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }

        // Generate password hash
        $this->password = Yii::$app->security->generatePasswordHash($this->password);

        // Generate a new auth key and set it
        // $this->auth_key = Yii::$app->security->generateRandomString();

        return $this->save();
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    // Implement IdentityInterface methods
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // If you're not using access tokens, you can leave this method unimplemented or return null.
        return null;
    }

    public function getId()
    {
        return $this->id; // Ensure `id` is the primary key in your `student` table
    }

    public function getAuthKey()
    {
        // return $this->auth_key; // Return the auth_key from the database
    }
    public function generateJwtToken()
    {
        $key = Yii::$app->params['jwtSecretKey']; // Store this key securely
        $payload = [
            'iat' => time(), // Issued at
            'exp' => time() + 3600, // Token expiration time
            'sub' => $this->id, // User ID
           
        ];
 
        $algorithm = 'HS256'; // Specify the algorithm to use
 
        return JWT::encode($payload, $key, $algorithm);
 
    }

    public function validateAuthKey($authKey)
    {
        // return $this->auth_key === $authKey;
    }
}
