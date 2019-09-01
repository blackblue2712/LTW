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
		
		if(isset($_SESSION["config"])) {
			$bg = $_SESSION["config"]["backgroundColor"];
			$sz = $_SESSION["config"]["fontSize"];
			$cl = $_SESSION["config"]["color"];
			$conf = '<script type="text/javascript">
						document.querySelector("section.body").style.backgroundColor = "#'.$bg.'";
						document.querySelector("section.body").style.color = "#'.$cl.'";
						document.querySelector("section.body").style.fontSize = "'.$sz.'px";
				</script>';
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
							<a class="nav-item" href="#product">Product</a>
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
											<label onclick="toggleModel('list')">
												<input type="checkbox" name="overview" style="display: none">Overview
											</label>
										</div>
										<div class="tab">
											<label onclick="toggleModel('form')">
												<input type="checkbox" name="contact" style="display: none">New +
											</label>
										</div>
									</div>
									<div class="model-body-right">
										<div id="list">
											<h3>List products <input style="margin-left: 20px" type="text" placeholder="Type to find ..." oninput="ajaxFind(value)"></h3>
											<div id="wrap-table">
												<!-- AJAX LOADED -->
											</div>
                                        </div>
                                        <div id="form" style="display: none">
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
										
										<div id="form-edit" class="hide">
                                            <h3>Edit product</h3>
                                            <form action="./controllers/product/product.php?role=edit" method="POST" enctype="multipart/form-data">
                                                <p>
                                                    <label style="width: 120px; display: inline-block;">Name</label>
                                                    <input type="text" name="name" required id="edit-name">
                                                </p>
                                                <p style="display: flex; align-items: center">
                                                    <label style="width: 123px; display: inline-block;">Description</label><br>
                                                    <textarea id="edit-description" name="description"></textarea>
                                                </p>
                                                <p>
                                                    <label style="width: 120px; display: inline-block;">Price</label>
                                                    <input type="number" name="price" required id="edit-price">
                                                </p>
                                                <p>
                                                    <label style="width: 120px; display: inline-block;">Picture</label>
                                                    <input type="file" name="picture">
                                                </p>
                                                <p>
													<input type="hidden" name="id" id="edit-id">
													<input type="hidden" name="oldPicture" id="edit-picture">
                                                    <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary btn-outline">
                                                </p>
											</form>
											<span onclick="document.getElementById('form-edit').classList.remove('show');document.getElementById('form-edit').classList.add	('hide')" class="close-model">x</span>
										</div>
										
										<div id="form-detail" class="hide">
                                            <h3>Detail product</h3>
                                            <div id="about" class="box-model">
												<div class="model-header">
													<h2 style="color: darkcyan;" id="detail-name"></h2>
												</div>
												<div class="model-body">
													<div class="model-body-left">
														
													</div>
													<div class="model-body-right">
														<p><label style="width: 120px; display: inline-block; color: darkcyan; font-weight: 700">ID</label><span id="detail-id"></span></p>
														<p><label style="width: 120px; display: inline-block; color: darkcyan; font-weight: 700">Price</label><span id="detail-price"></span></p>
														<p><label style="width: 120px; display: inline-block; color: darkcyan; font-weight: 700">Description</label><span id="detail-description"></span></p>
														<p>
															<label style="width: 120px; display: inline-block; color: darkcyan; font-weight: 700">Picture</label><img id="detail-picture" src="" width=200>
														</p>
													</div>
												</div>
											</div>
											<span 
												onclick="document.getElementById('form-detail').classList.remove('show');document.getElementById('form-detail').classList.add('hide');Array.from(document.querySelectorAll(`img[key-detail`)).map( el => el.src='./icon/eye-slash-solid.svg')"
												class="close-model">
												x
											</span>
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
            <div class="btn-st close">
                <span onclick="signout()" id="signout" title="Signout"><img src="./icon/power-off-solid.svg"></span>
			</div>
			<div class="btn-st close" style="top: 47px;left: -47px;">
                <span onclick="showConfig()" id="adjust" title="Adjust"><img src="./icon/adjust-solid.svg"></span>
			</div>
			<div class="btn-st close" style="top: 0px;left: -61px;">
                <span onclick="alert(`Comming soon`)" id="notify" title="Notify"><img src="./icon/bell-solid.svg"></span>
            </div>
        </div>
	</div>
	<div class="modal-config-font" style="position: fixed;top:  50%;left:  50%;transform: translate(-50%, -50%);width: 600px;background: black;padding: 20px 40px;opacity: .8; display: none">
		<h3><div class="modal-config-header">Custom</div></h3>
		<div class="modal-config-body">
			<div class="d-flex" style="margin-bottom:10px">
				<label class="pull-left">Background-color: </label>
				<div class="set-background-color">
					<input type="color" id="bg-color" name="bg-color" value="#151313" onmouseover="this.title=value" onchange="onChangeConfig('section.body', 'background', value)">
				</div>
			</div>

			<div class="d-flex" style="margin-bottom:10px">
				<label class="pull-left">Color: </label>
				<div class="set-color">
					<input type="color" id="text-color" name="bg-color" value="#ffffff" onmouseover="this.title=value" onchange="onChangeConfig('section.body', 'color', value)">
				</div>
			</div>
			
			<div class="d-flex" style="margin-bottom:10px">
				<label class="pull-left">Font: </label>
				<div class="set-font">
					<select class="select-font" onchange="onChangeConfig('section.body', 'font-family', value)">
						<option value="Times New Roman" style="font-family: Times New Roman">Times New Roman</option>
						<option value="Arial" style="font-family: Arial">Arial</option>
						<option value="monospace" style="font-family: monospace">Monospace</option>
						<option value="Courier New" style="font-family: Courier New">Courier New</option>
						<option value="Sans-serif" style="font-family: Sans-serif">Sans serif</option>
					</select>
				</div>
			</div>

			<div class="d-flex" style="margin-bottom:10px; display: flex">
				<label class="pull-left">Font size: </label>
				<div class="set-font-size">
					<input id="text-size" type="range" name="fontSize" value="16" min="1" max="30" onmouseover="this.title=value + 'px'" onchange="onChangeConfig('section.body', 'font-size', value)">
				</div>
			</div>
		</div><!-- end modal body -->
		<div class="modal-config-footer">
			<div class="d-flex">
				<a href="javascript:saveConfig()" id="save-config" class="btn btn-sm btn-default" title="Save change"><img src="./icon/save-regular.svg"></a>
				<a href="javascript:defaultConfig()" id="default-config" class="btn btn-sm btn-default" title="Default"><img src="./icon/spinner-solid.svg"></a>
				<a href="javascript:closeConfig()" class="btn btn-sm btn-default" title="Close"><img src="./icon/times-circle-solid.svg"></a>
			</div>
		</div>
	</div>
	<div id="notifi">
		<?php echo $mess?>
	</div>
	<div id="popup">
	</div>
	<?php echo $conf ?>
	<script type="text/javascript" src="./asset/js/home.js"></script>
</body>
</html>