<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
/**
 * LoginForm is the model behind the login form.
 */
class Games extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    
    public function rules()
    {
        return [
            // username and password are both required
//            [['name', 'lastname', 'date_born'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
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
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
}