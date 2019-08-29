<?php
    session_start();
    include("define.php");

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    if(isset($_SESSION["user"])) {
        $id = $_SESSION["user"]["id"];
        $username = $_SESSION["user"]["username"];
        $picture = $_SESSION["user"]["picture"];
        $gender = $_SESSION["user"]["gender"];
        $career = $_SESSION["user"]["career"];
        $hobbies = $_SESSION["user"]["hobbies"];
        if($picture != "") {
            $picture = URL_UPLOAD_USER . "/" . $picture;
        } else {
            $picture = 'https://res.cloudinary.com/ddrw0yq95/image/upload/v1565673576/qbay0vl6qylmg6lkxp8g.jpg';
        }

        $str_hobbies = '';
        if($hobbies != "") {
            $arr_hobbies = explode("-", $hobbies);
            foreach($arr_hobbies as $value) {
                $str_hobbies .= " - " . $value;
            }
        }
    } else {
        header("location: ./signin.php");
    }
    
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
	<title>CV - Dang Huu Nghia</title>
	<link rel="stylesheet" type="text/css" href="./asset/css/home.css">
</head>
<body>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="header">
					<div class="nav-wrap">
						<div>
							<a class="brand" href="#">Liars</a>
						</div>	
						<div>
							<a class="nav-item" href="#">Home</a>
						</div>
						<div>
							<a class="nav-item" href="#about">About</a>
						</div>
						<div>
							<a class="nav-item" href="#timeline">Timeline</a>
						</div>
						<div>
							<a class="nav-item" href="#exercise">Exercise</a>
						</div>
						<div>
							<a class="nav-item has-child" href="#more">More &darr;</a>
						</div>
					</div>
				<div class="container"></div>
			</div>

			<div class="body">
				<div class="container">
					<div class="row">
						<section class="top">
							<div class="cover-photo">
								<div class="avatar">
									<a href=<?php echo $picture?> target="_blank"><img src=<?php echo $picture?> alt="avt" class="img-sm img-circle img-avatar"></a>
									<label class="mine-name"><?php echo $username?></label>
								</div>
							</div>
						</section>
						<section class="body">
							<div id="about" class="box-model">
								<div class="model-header">
									<h2 style="color: darkcyan;">About</h2>
								</div>
								<div class="model-body">
									<div class="model-body-left">
										<div class="tab">
											<label>
												<input type="checkbox" name="overview" style="display: none">Overview
											</label>
										</div>
										<div class="tab">
											<label>
												<input type="checkbox" name="contact" style="display: none">Contact
											</label>
										</div>
									</div>
									<div class="model-body-right">
										<p><label style="width: 120px; display: inline-block;">ID</label><?php echo $id?></p>
										<p><label style="width: 120px; display: inline-block;">Gender</label><?php echo ucfirst($gender)?></p>
										<p><label style="width: 120px; display: inline-block;">Carrer</label><?php echo ucfirst($career)?></p>
                                        <p style="display: flex">
                                            <label style="width: 120px; display: inline-block;">Hobbies</label>
                                            <?php echo $str_hobbies?>    
                                        </p>
									</div>
								</div>
                            </div>

                            <div id="product" class="box-model">
								<div class="model-header">
									<h2 style="color: darkcyan;">Product</h2>
								</div>
								<div class="model-body">
									<div class="model-body-left">
										<div class="tab">
											<label>
												<input type="checkbox" name="overview" style="display: none">Overview
											</label>
										</div>
										<div class="tab">
											<label>
												<input type="checkbox" name="contact" style="display: none">New +
											</label>
										</div>
									</div>
									<div class="model-body-right">
										<div id="list">

                                        </div>
                                        <div id="form">
                                            <h3>New product</h3>
                                            <form action="./controllers/product/product.php?role=add" method="POST" enctype="multipart/form-data">
                                                <p>
                                                    <label style="width: 120px; display: inline-block;">Name</label>
                                                    <input type="text" name="name" required>
                                                </p>
                                                <p style="display: flex; align-items: center">
                                                    <label style="width: 123px; display: inline-block;">Description</label>
                                                    <textarea name="description"></textarea>
                                                </p>
                                                <p>
                                                    <label style="width: 120px; display: inline-block;">Price</label>
                                                    <input type="number" name="price" required>
                                                </p>
                                                <p>
                                                    <label style="width: 120px; display: inline-block;">Picture</label>
                                                    <input type="file" name="picture">
                                                </p>
                                                <p>
                                                    <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary btn-outline">
                                                </p>
                                            </form>
                                        </div>
									</div>
								</div>
                            </div>


                        </section>
					</div>
				</div>
			</div>

			<div class="footer" style="text-align: center;">
				Liars &copy; 2019	
				<div class="container">
					
				</div>
				<div id="scrollTop" class="hide">
					<span title="top" style='font-size:50px; cursor: pointer;' onclick="javascript:scrollToTop()">&#8634;</span>
				</div>
			</div>

        </div>

        <div id="setting">
            <span onclick="changeUI()" id="setting-icon"><img id="setting-pic" src="./icon/cog-solid.svg"></span>
            <div id="btn-st" class="close">
                <span onclick="signout()" id="signout" title="Signout"><img id="setting-pic" src="./icon/reply-solid.svg"></span>
            </div>
        </div>

        <?php echo $mess?>
        
	</div>
	<script type="text/javascript">
		let onOpenNewTab = uri => {
			let win = window.open(uri, "_blank")
			win.forcus();
		}
		let scrollToTop = () => {
			window.scrollTo(0, 0)
		}

		window.onload = function() {

			window.onscroll = () => {
				let gotop = document.getElementById("scrollTop");
				console.log(window.scrollY)
				if(window.scrollY > 100) {
					gotop.classList.add("show");
					gotop.classList.remove("hide")
				} else {
					gotop.classList.add("hide");
					gotop.classList.remove("show")
				}
			}
        }
        
        changeUI = () => {
            let btnSt = document.getElementById("btn-st");
            let wSt = document.getElementById("setting");
            if(btnSt.classList[0] === 'close') {
                document.getElementById("setting-pic").src = "./icon/cogs-solid.svg";
                btnSt.classList.remove("close");
                btnSt.classList.add("open");
                wSt.classList.add("setting-click");
                wSt.classList.remove("setting-click-again");
            } else {
                document.getElementById("setting-pic").src = "./icon/cog-solid.svg";
                btnSt.classList.remove("open");
                btnSt.classList.add("close");
                wSt.classList.remove("setting-click");
                wSt.classList.add("setting-click-again");
            }
        }

        signout = () => {
            let check = window.confirm("Are you want to sign out?");
            if(check) {
                window.location = "./controllers/user/signout.php";
            }
        }
	</script>
</body>
</html>