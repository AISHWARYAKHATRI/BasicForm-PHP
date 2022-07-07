<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .error{
        color: #FF0000;
    }
    input{
        margin: 5px;
    }
</style>
<body>
<?php
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $website = $gender = $comment = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['name'])) {
            $nameErr = "Name is required";
        }
        else {
            $name = test_input($_POST['name']);
            if(!preg_match("/^[a-zA-Z]*$/", $name)){
                $nameErr = "Only letters and white space allowed";
            }
        }
        if(empty($_POST['email'])) {
            $emailErr = "Email is required";
        }
        else {
            $email = test_input($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr = "Invalid email format";
            }
        }
        if(empty($_POST['website'])) $websiteErr = "";
        else $website = test_input($_POST['website']);
        if(empty($_POST['comment'])) $comment = "";
        else $comment = test_input($_POST['comment']);
        if(empty($_POST['gender'])) $genderErr = "Gender is required";
        else $gender = test_input($_POST['gender']);
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    
    <h1>Registration form</h1>
   <p><span class="error">* required field</span></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

        Name:<input type="text" name="name" value="<?php echo $name ?>"><span class="error">*<?php echo " $nameErr" ?></span>
       <br>
        Email:<input type="email" name="email" value="<?php echo $email ?>"><span class="error">*<?php echo "$emailErr"?></span>
        <br>
        Website: <input type="text" name="website" value="<?php echo $website ?>">
       <br>
        Comment: <textarea name="comment" id="comment" cols="30" rows="10"><?php echo $comment ?></textarea>
       <br>
        Gender:<span class="error"></span>
        <input type="radio" name="gender" <?php if(isset($gender) && $gender=="female") echo "checked"?> value="female">Female
        <input type="radio" name="gender" <?php if(isset($gender) && $gender=="male") echo "checked"?> value="Male">Male
        <input type="radio" name="gender" <?php if(isset($gender) && $gender=="other") echo "checked"?> value="Other">Other <span class="error">*<?php echo $genderErr ?></span>
        <br>
        <button type="submit">Submit</button>

    </form>    
        
        <?php 
        echo "<h1>Your details</h1>";
        echo "$name<br>";
        echo "$email<br>";
        echo "$website<br>";
        echo "$comment<br>";
        echo "$gender<br>";
        ?>

</body>
</html>