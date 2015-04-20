<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
/**
 * LoginForm is the model behind the login form.
 */
class Players extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
        public static function tableName()
    {
        return 'players';
    }
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'lastname', 'date_born'], 'required'],
            [['date_born',], 'date', 'format' => 'yyyy-MM-dd'],  
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
            
             ['date_born', 
                function ($attr) {
                    $diff = strtotime(date('Y-m-d'))-strtotime($this->$attr);
                    $diff = $diff/(60*60*24*365);
                    
                    if($diff <= 18)  {
                     $this->addError('date_born', "You're too young."); 
                     return false;
                    } else {return true;}
                }
        ],
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