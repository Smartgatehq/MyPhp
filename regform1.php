<?php
include "work_database.php";



//validating the first name and last name

if(isset($_POST['submit'])){
   
    if (empty($_POST['first_name'])) {
        echo "First Name is required";
       
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["first_name"]))) {
       echo "First Name can only contain letters, numbers, and underscores.";
    } else {
        $firstname =  $_POST['first_name'];
    }


    if (empty($_POST['last_name'])) {
        echo "Last_name is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["last_name"]))) {
        echo "Lastname can only contain letters, numbers, and underscores.";
    } else {
        $lastname =  $_POST['last_name'];
    }



   // validating the email


    if (empty($_POST['email'])) {
        echo "An email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
       echo "Email must be a valid email address";
    } else {
        $check_email = trim($_POST['email']);
        
        // Check if the email already exists
        $check_user_email_sql = "SELECT id from users Where email = '$check_email'";
        $check_email_result = $conn->query($check_user_email_sql);
        
        if ($check_email_result->num_rows == 1) {
            echo "User already taken";
        //    exit; // Exit script if email is already taken
        } else {
            $email = $check_email;
        }

    }


    //validating the phone number to ensure it only contains numbers


    if (empty($_POST['phone_number'])) {
        echo "number is required";
     } elseif (!preg_match('/[0-9]+/', trim($_POST["phone_number"]))) {
        echo "only numbers is allow.";
     } else {
        $num = $_POST['phone_number'];
     }


     // validating the gender

     if (empty($_POST['gender'])) {
        echo "Gender is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["gender"]))) {
        echo "Gender can only contain letters, numbers, and underscores.";
    } else {
        $lastname =  $_POST['gender'];
    }

    if (empty($_POST['username'])) {
        echo "Username is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        echo "Username can only contain letters, numbers, and underscores.";
    } else {
        $username =  $_POST['username'];

        // Check if the email already exists

                $check_username_sql = "SELECT id from regform1 Where username = '$check_username'";
                $check_username_result = $conn->query($check_username_sql);
                
                if ($check_username_result->num_rows == 1) {
                    echo "Username already taken";

                //    exit; // Exit script if email is already taken

                } else {
                    $username = $check_username;
                }
    }


    // validating password


    if (empty($_POST['password'])) {
        echo "Password is required";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        echo"Password must be at least 6 characters";
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($_POST['confirm_password'])) {
       echo "Confirm Your Password";
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            echo "Passwords did not match";
        }
    }



    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($gender) ||
    empty($username) || empty($password)){
        echo "Please fill in all required fields.";
    } else {
        $hashed_password  = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (first_name, last_name, email, phone_number, gender, username, password)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $gender, $username, $hashed_password);
        
        if ($stmt->execute()) {
            $success_message = "Registration successful! You can now log in.";

            // the code that links this page to the login page was commented below

            // header("refresh:3;url=login.php");
            //header("location: login.php");
          //  exit; // Exit after successful insertion
        } else {
            echo "Something went wrong";
        }
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/regform1.css">
    <title>Registration Page</title>
</head>
<body>
    <form action="" method="">
        <h2>Registration Form</h2>
        <div class="name">
            <div class="first-name">
                <input 
                    type="text"
                    name="first_name"
                    id="first_name"
                    placeholder="First Name"
                    required             
                >
            </div>
            <div class="last-name">
                <input 
                    type="text"
                    name="last_name"
                    id="last_name"
                    placeholder="Last Name"
                    required             
                >
            </div>
        </div>
        <div class="form-field">
            <input 
                type="email"
                name="email"
                id="email"
                placeholder="Email Address"
                required 
            >
        </div>
        <div class="form-field">
            <input 
                type="tel"
                name="phone_number"
                id="phone_number"
                placeholder="Phone Number"
                maxlength="11"
                required 
            >
        </div>
        <div class="form-field">
            <input 
                type="text"
                name="gender"
                id="gender"
                placeholder="Gender"
                maxlength="6"
                required 
            >
        </div>
        <div class="form-field">
            <input 
                type="text"
                name="username"
                id="username"
                placeholder="Username"
                required 
            >
        </div>
        <div class="form-field">
            <input 
                type="password"
                name="password"
                id="password"
                placeholder="Password"
                required 
            >
        </div>
        <div class="form-field">
            <input 
                type="password"
                name="confirm_password"
                id="confirm_password"
                placeholder="Confirm Password"
                required 
            >
        </div>

        <input class="submit-button" type="submit" name="submit" id="submit" value="Register">

        <a href=""><p>Already a user?</p>Login</a>

    </form>
        
</body>
</html>