<?php

//The "Controller" class
class LoginContr extends Login
{
    //Methods that will store what we recieve from the register.inc.php file
    private $username;
    private $pwd;

    // Construct to assign the class properties
    public function __construct($username, $pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
    }

    //Using the methods below to check on the errors, then after validating and ensuring there is no error, we will sign up the user/insert the user into the database
    public function loginUser()
    {
        //Checks if the input fields are empty
        if (!$this->emptyInput()) {
            // echo "Empty Input!";
            header('Location: ../views/login-form.php?error=emptyinput');
            exit();
        }
        //After all the validations, if the user passed it, then we will insert him/her into the database using the class from our model
        $this->getUser($this->username, $this->pwd);
    }

    //Empty Field Check (Wa gi sudlan ni user sa form)
    private function emptyInput()
    {
        $result = null;
        if (empty($this->username) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
