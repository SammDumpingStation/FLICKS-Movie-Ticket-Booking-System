<?php
class Login extends Dbh
{

    protected function getUser($username, $pwd)
    {
        //Query to the database
        $query = "SELECT username, pwd FROM users WHERE username = :username OR email = :username";
        //Use prepared statement for security reasons
        $stmt = $this->connection()->prepare($query);

        //Named parameters to assign the variables into the sql statement
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ../views/login-form.php?error=stmtfailed');
            exit();
        }
        //If no user is returned, then no user found
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header('Location: ../views/login-form.php?error=usernotfound');
            exit();
        }

        $result = $stmt->fetch();
        $stmt = null;

        $pwdHashed = $result['pwd'];
        $checkPwd = password_verify($pwd, $pwdHashed);


        if (!$checkPwd) {
            $stmt = null;
            header('Location: ../views/login-form.php?error=wrongpassword');
            exit();

        } elseif ($checkPwd == true) {
            $query = "SELECT * FROM users WHERE username = :username OR email = :email AND pwd = :pwd;";
            //Use prepared statement for security reasons
            $stmt = $this->connection()->prepare($query);
            
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $username, PDO::PARAM_STR);
            $stmt->bindParam(":pwd", $checkPwd, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                $stmt = null;
                header('Location: ../views/login-form.php?error=stmtfailed');
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header('Location: ../views/login-form.php?error=usernotfound');
                exit();
            }

            $user = $stmt->fetchAll();
            session_start();
            $_SESSION['username'] = $user[0]['username'];
            $_SESSION['id'] = $user[0]['id'];
        }

        $stmt = null;

    }
}
