<?php
/**
 * Created by PhpStorm.
 * User: medias
 * Date: 17.04.2018
 * Time: 11:39
 */
include_once 'Database.php';

if (session_status()!=2){
session_start();
}
class Users{

    public $currentUser;
    protected $login;
    protected $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public static function GetRegistrationForm()
    {
        include 'registrationForm.html';
    }

    public static function GetLoginForm()
    {
        include 'loginForm.html';
    }

    public static function Validate()
    {
        if ($_POST['password'] != $_POST['password_confirm']) {

            $_SESSION['POST'] = $_POST;
            $_SESSION['ValidationError'] = true;
            $_SESSION['ValidationErrorText'] = "Не корректно введені паролі";
            return false;
       }else{
            return true;
       }
    }

    public function Authorisation()
    {
        $requestParameters = [
            $this->login,
            $this->password,
        ];

        $requestText = 'select * from users where username = ? and password = ?';
        $a = $this->ExecuteRequest($requestText, $requestParameters);

        if (!empty($a) && count($a) == 1) {
            $this->currentUser = $a[0];
        }
    }

    public function ConfirmRegistration()
    {

    }

    private function CheckRegisterInformation(){

        $requestText = 'SELECT us.email
                        FROM users AS us WHERE email = ?';

        $requestParameters = [
            $_POST['email'],
        ];

        $result = $this->ExecuteRequest($requestText, $requestParameters);

    }

    public function CompleteRegistration(){

        $pass_hash = md5($_POST['password']);
        $requestParameters = [$_POST['username'],
                              $_POST['email'],
                              $pass_hash,
                              0,
                              $_POST['full_name']];


        $requestText = 'INSERT INTO users (`username`, `email`, `password`, `status`, `full_name`) 
                                  VALUES (?,?,?,?,?)';
        $a = $this->ExecuteRequest($requestText, $requestParameters);

    }

    private function ExecuteRequest($requestText, $requestParameters){

        $Database = new Database($requestText, $requestParameters);
        $Database->ExecuteRequest();
        $a = $Database->GetResult();
        return $a;
    }

}

