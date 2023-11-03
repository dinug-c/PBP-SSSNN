<?php
session_start();
require_once('lib/db_login.php');

if(isset($_POST["submit"])){
    $valid = true;
    $email = test_input($_POST['email']);
    if($email == ''){
        $error_email = "Email is required";
        $valid = false;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_email = "Invalid email format";
        $valid = false;
    }
    $password = test_input($_POST['password']);
    if($password == ''){
        $error_password = "Password is required";
        $valid = false;
    }
    if($valid){
        $query = "SELECT * FROM admin WHERE email = '".$email."' AND password = '".md5($password)."'";
        $result = $db->query($query);
        if(!$result){
            die("Could not query the database: <br/>".$db->error."<br/>Query: ".$query);
        }else{
            if($result->num_rows > 0){
                $_SESSION['username'] = $email;
                header('Location: view_customer.php');
            }else{
                echo '<span class="error">Email or Password is invalid</span>';
            }
        }
        $db->close();
    }
}

?>
<?php include("components/header.html") ?>
<br>
<div class="card">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" size="30" name="email" value="<?php if(isset($email)) echo $email; ?>">
                <span class="error"><?php if(isset($error_email)) echo $error_email; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="">
                <span class="error"><?php if(isset($error_password)) echo $error_password; ?></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
</div>
<?php include("components/footer.html") ?>