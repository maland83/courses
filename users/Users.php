<?php


include_once $_SERVER['DOCUMENT_ROOT'].'/Database.php';

if (session_status()!=2){
session_start();
}
class Users{

    public $currentUser;
    protected $login;
    protected $password;
    protected $userId;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public static function GetRegistrationForm()
    {
        include $_SERVER['DOCUMENT_ROOT'].'/registrationForm.html';
    }

    public static function GetLoginForm()
    {
        include 'loginForm.html';
    }

    public function Validate()
    {
        if ($_POST['password'] != $_POST['password_confirm']) {

            $_SESSION['POST'] = $_POST;
            $_SESSION['ValidationError'] = true;
            $_SESSION['ValidationErrorText'] = "Не корректно введені паролі";
            return false;
       }
       if (count($this->CheckRegisterInformation_email())){
           $_SESSION['POST'] = $_POST;
           $_SESSION['ValidationError'] = true;
           $_SESSION['ValidationErrorText'] = "E-mail вже зареєстрований";
           return false;
       }
        return true;

    }

    public function ValidateConfirmRegistration(){

        $requestParameters = [$_GET['id']];
        $requestText = 'select us.username, us.email, us.status, us.last_access
                        from users as us WHERE id = ?';

        $res = $this->ExecuteRequest($requestText, $requestParameters);

        $have_err = false;
        if ($res[0]['last_access'] != '0000-00-00 00:00:00') {
            echo 'Уже активировано!';
            $have_err = true;
        }

        if ($res[0]['status'] != '0' && $have_err == false) {
            echo 'Уже активировано!';
            $have_err = true;
        }

        if ($have_err) {
            return false;
        }

        $this->currentUser = $res[0];
        return true;
    }

    private function SendEmail(){
        $summury_String = $_POST['username'] . $_POST['email'];
        $super_hash = md5($summury_String);
        $full_url = $_SERVER['HTTP_HOST'] . '/users/confirm_registration.php?id=' . $this->userId . '&hash=' . $super_hash;

        if (mail($_POST['email'], 'Registration', $full_url)){
            return true;
        };

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

        $super_hash = md5($this->currentUser['username'].$this->currentUser['email']);

        if ($super_hash == $_GET['hash']){

            $requestText = 'UPDATE users SET status = 1 WHERE id = ?';
            $requestParameters = [$_GET['id']];
            $a = $this->ExecuteRequest($requestText, $requestParameters);

        }
    }

    private function CheckRegisterInformation_email(){

        $requestText = 'SELECT us.email
                        FROM users AS us WHERE email = ?';

        $requestParameters = [
            $_POST['email'],
        ];

        $result = $this->ExecuteRequest($requestText, $requestParameters);
        return $result;
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
        $this->userId = $a;
        if ($this->SendEmail()){
            return true;
        }
    }

    private function ExecuteRequest($requestText, $requestParameters){

        $Database = new Database($requestText, $requestParameters);
        $Database->ExecuteRequest();
        $a = $Database->GetResult();
        return $a;
    }

}

