<?php
    echo 'hi';
    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $name=check_input($_POST['name']);
        $uname=check_input($_POST['uname']);
        $email=check_input($_POST['email']);
        $pass=check_input($_POST['pass']);
        $cpass=check_input($_POST['cpass']);
        $pass=sha1($pass);
        $created=date('Y-m-d');

        if ($pass!=$cpass){
            echo 'Password did not match!';
            exit();
        }
        else{
            $sql=$conn->prepare("SELECT username,email FROM users WHERE username=? OR email=?");
            $sql->bind_param("ss",$uname,$email);
            $sql->execute();
            $result=$sql->get_result();
            $row=$result->fetch_array(MYSQLI_ASSOC);

            if($row['username']==$uname){
                echo 'Username not available. Try a different one!';
            }
            elseif($row['email']==$email){
                echo 'Email is already registered. Try a different one!';
            }
            else{
                $stmt=$conn->prepare("INSERT INTO users (name,username,email,pass,created) VALUES (?,?,?,?,?)");
                $stmt->bind_param("sssss",$name,$uname,$email,$pass,$created);
                if($stmt->execute()){
                    echo 'Registered successfully.Login now!';
                }
                else{
                    echo 'Something went wrong.Please try again';
                }
            }
        }
    }

    function check_input($data){
        $data=trim($data);
        $data=stripslashers($data);
        $data=htmlspecialchars($data);
        return $data;
    }
?>