<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Student|null $student
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    // public $rememberMe = true;

    private $_student = false; // Add this private property

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'], // Ensure the email is valid
            // ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $student = $this->getStudent();

            if (!$student || !$student->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getStudent());
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return Student|null
     */
    public function getStudent()
    {
        if ($this->_student === false) {
            $this->_student = Student::findByEmail($this->email); // Use Student model
        }

        return $this->_student;
    }
}
