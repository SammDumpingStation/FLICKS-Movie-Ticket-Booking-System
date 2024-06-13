<?php
//The "Model" Class
class Register extends Dbh
{

    protected function setUser($username, $pwd, $email)
    {
        //Query to the database
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        //Use prepared statement for security reasons
        $stmt = $this->connection()->prepare($query);

        //Named parameters to assign the variables into the sql statement
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":pwd", $hashedPwd, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ../views/register.php?error=stmtfailed');
            exit();
        }
        $stmt = null;

    }

    protected function checkUser($username, $email)
    {
        //Query to the database
        $query = "SELECT username, email FROM users WHERE username = :username OR email = :email";

        //Use prepared statement for security reasons
        $stmt = $this->connection()->prepare($query);
        //Named parameters to assign the variables into the sql statement
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        //Checks if the query has been executed, if not, it will not continue to run
        if (!$stmt->execute()) {
            $stmt = null;
            header('Location: ../views/register.php?error=stmtfailed');
            exit();
        }

        //Checks if there is already a username or password that already existed. If there is, then we wont register the user
        $resultCheck = null;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        $stmt = null;
        return $resultCheck;
    }
}
