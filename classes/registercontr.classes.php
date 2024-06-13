<?php

//The "Controller" class
class RegisterContr extends Register
{
    //Methods that will store what we recieve from the register.inc.php file
    private $username;
    private $pwd;
    private $repeatpwd;
    private $email;

    // Construct to assign the class properties
    public function __construct($username, $pwd, $repeatpwd, $email)
    {
        $this->username = $username;
        $this->pwd = $pwd;
        $this->repeatpwd = $repeatpwd;
        $this->email = $email;
    }

    //Using the methods below to check on the errors, then after validating and ensuring there is no error, we will sign up the user/insert the user into the database
    public function registerUser()
    {
        //Checks if the input fields are empty
        if (!$this->emptyInput()) {
            // echo "Empty Input!";
            header('Location: ../views/register.php?error=emptyinput');
            exit();
        }
        //Checks if the username is invalid
        if (!$this->invalidUsername()) {
            // echo "Invalid Username!";
            header('Location: ../views/register.php?error=invalidusername');
            exit();
        }
        //Checks is the email is invalid
        if (!$this->invalidEmail()) {
            // echo "Invalid Email!";
            header('Location: ../views/register.php?error=invalidemail');
            exit();
        }
        //Checks if the password match front the retyped password
        if (!$this->pwdMatch()) {
            // echo "Passwords don't Match";
            header('Location: ../views/register.php?error=passworddontmatch');
            exit();
        }
        //Checks if the username or email is taken
        if (!$this->usernameEmailTaken()) {
            // echo "Username or Email is already Taken!";
            header('Location: ../views/register.php?error=alreadytakenusernameemail');
            exit();
        }
        //After all the validations, if the user passed it, then we will insert him/her into the database using the class from our model
        $this->setUser($this->username, $this->pwd, $this->email);
    }

    //Empty Field Check (Wa gi sudlan ni user sa form)
    private function emptyInput()
    {
        $result = null;
        if (empty($this->username) || empty($this->pwd) || empty($this->repeatpwd) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Invalid username check (Pang prevent sa SQL injection and cross-site hacking)
    private function invalidUsername()
    {
        $result = null;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Invalid Email check (tanawon ani na method if sakto ang syntax sa email na iyahang gi butang)
    private function invalidEmail()
    {
        $result = null;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Matching the initial password and the repeated password
    private function pwdMatch()
    {
        $result = null;
        if ($this->pwd != $this->repeatpwd) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Checks if the email or username is already taken

    private function usernameEmailTaken()
    {
        $result = null;
        if (!$this->checkUser($this->username, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
