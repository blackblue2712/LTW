<?php
    session_start();
    include_once("./connect.php");
    
    $mess = "";
    if(isset($_SESSION["message"])) {
        $mess = '<div id=show-message class="show-mess">
                    <div class="wrap-mess">
                        <div class="mess">
                            <p class="'.$_SESSION["message"]["type"].'">'.$_SESSION["message"]["content"].'</p>
                        </div>
                        <div class="close-mess" onclick="closeBox()">X</div>
                    </div>
                </div>';

        unset($_SESSION['message']);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form</title>
    <link rel="stylesheet" type="text/css" href="./asset/css/style.css">
</head>
<body> 
<div class="wrapper">
    <div class="box-form" style="width: 500">
        <h2>Login</h2>
        <form name="login-form" id="login-form" action="./controllers/user/user.php" method="POST" enctype="multipart/form-data">
            <div class="inputBox">
                <input type="text" name="username" id="username" required/>
                <label for="name">Username</label>
            </div>
            <div class="inputBox">
                <input type="password" name="password" id="password" required/>
                <label for="password">Password</label>
            </div>
            <div class="inputBox">
                <input type="password" name="re-password" id="re-password" required/>
                <label for="re-password">Password again</label>
            </div>
            <div class="form-group">
                <input type="file" name="picture" id="picture"/>
                <label for="picture">Picture</label>
                <a href="#" class="btn btn-primary btn-outline" id="choose-avatar">Choose file</a>
            </div>

            <div class="form-group">
                <label for="gender" class="title">Gender</label>
                <label style="color: #fff"><input type="radio" name="gender" value="male" checked="checked"> Male</label>
                <label style="color: #fff"><input type="radio" name="gender" value="female"> Female</label>
                <label style="color: #fff"><input type="radio" name="gender" value="other"> Other</label>
            </div>
            <div class="form-group">
                <label for="carrer" class="title">Career</label>
                <select name="career" id="career" class="form-control-sm">
                    <option value="student">student</option>
                    <option value="student">teacher</option>
                    <option value="student">farmer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hobby" class="title">Hobby</label>
                <div style="display: flex;">
                    <label style="width: 200px;"><input type="checkbox" name="hobby[]" value="Read book">Read book	</label>
                    <label style="width: 200px;"><input type="checkbox" name="hobby[]" value="Listen music">Listen music</label>
                    <label style="width: 200px;"><input type="checkbox" name="hobby[]" value="Code">Code</label>
                </div>
                <div style="display: flex;">
                    <label style="width: 200px;"><input type="checkbox" name="hobby[]" value="Play game">Play game</label>
                    <label style="width: 200px;"><input type="checkbox" name="hobby[]" value="Swim">Swim</label>
                    <label style="width: 200px;"><input type="checkbox" name="hobby[]" value="Go uot">Go uot</label>
                </div>
            </div>
            <div style="margin-top: 20px">
                <input type="submit" name="btnSubmit" value="Submit" style="margin-right: 10px" id="submit-form"/>
                <input type="reset" name="" value="Reset"/>
            </div>
        </form>
    </div>
</div>

<?php echo $mess?>

<!-- <p>Đặng Hữu Nghĩa - B1706729</p> -->
<script>
    window.onload = function () {
        let btnChooseFile = document.getElementById("choose-avatar");
        let fileIp = document.getElementById("picture");
        if(btnChooseFile) {
            btnChooseFile.addEventListener("click", () => {
                fileIp.click();
            })
        }
        if(fileIp) {
            fileIp.addEventListener("change", () => {
                btnChooseFile.innerHTML = fileIp.files[0].name;
            })
        }

        // validate
        let btnSubmit = document.getElementById("submit-form");
        btnSubmit.addEventListener("click", event => {
            event.preventDefault();
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let rePassword = document.getElementById("re-password").value;
            let career = document.getElementById("career").value;
            let gender = document.querySelector("input[name='gender']").value;
            let hobbyNode = document.querySelectorAll("input[name='hobby[]']:checked");
            let hobbies = [];
            if(hobbyNode.length > 0) {
                Array.from(hobbyNode).map( hb => {
                    hobbies.push(hb.value);
                })
            }

            if(password !== "" && username !== "") {
                if(password !== rePassword) {
                    alert("Password and re-password are not match");
                } else {
                    document.getElementById("login-form").submit();
                }
            } else {
                alert("You must enter username and password");
            }
        })

        // show/hide message
        let boxShowMes = document.getElementById("show-message");
        if(boxShowMes) {
            if(boxShowMes.classList[0] === "show-mess") {
                setTimeout( () => {
                    boxShowMes.classList.remove("show-mess");
                    boxShowMes.classList.add("strict-hide");
                }, 4000)
            }
        }

        closeBox = () => {
            boxShowMes.classList.add("strict-hide");
        }
    }
</script>
</body>
</html>
