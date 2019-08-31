<!DOCTYPE html>
<html>
<head> 
	<title> Slide </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>	
<body>
<div id="wrap">
	<div id="title">
		<h1>Bài 2 - Buổi 4</h1>
	</div> <!--end div title-->
	<div id="menu">
		<!-- chèn menu của sinh viên vào-->
	</div> <!--end div menu-->
	<div id="content">
		<!--Nội dung trang web-->
		<h1>Slide show</h1>
	
		<form>
			<img id="laptopImg" src="img/hp.jpg" height="300" width="300" />
			<br/>
			<input type="button" name="previous" value="Previous" onclick="changeSlide(-1)">
			<input type="button" name="next" value="Next" onclick="changeSlide(1)">
			<br/>
			<select name="laptopSel" onchange="chooseSlide(value)">
				<option value="0">HP</option>
				<option value="1">Dell</option>
				<option value="2">Acer</option>
				<option value="3">Asus</option>
			</select> 
		</form>
		<p class="requirements">Yêu cầu:<br/>
		Có 4 hình ảnh về máy tính đính kèm, mặc định hiển thị hình máy HP.<br/>
			<ul class="requirements">
				<li>Khi người dùng nhấn Next thì hiển thị hình tiếp theo (theo thứ tự Hp -> Dell -> Acer -> Asus).</li>
				<li>Khi người dùng nhấp Previous thì hiển thị hình trước đó.</li>
				<li>Cả nút Next và Previous đều hiển thị vòng tròn (nếu đang xem hình HP mà nhấn Previous thì sẽ chuyển sang hình Asus).</li>
				<li>Người dùng có thể chọn xem một hình nào đó từ danh sách bên dưới nút Previous và Next.</li>
				<li>Khi người dùng thay đổi hình bằng cách nhấn Previous hoặc Next thì tên hiển thị bên dưới cũng thay đổi theo.</li>
			</ul>	
		</p>
	</div> <!--end div content-->
	<div id="footer">
		<p>Họ tên SV: Đặng Hữu Nghĩa<br/> Email: nghiab1706729@student.ctu.edu.vn</p>
	</div> <!--end div footer-->
</div> <!--end div wrap-->

<script>
        let imageLoaded = [];
        let urlImageLoaded = "../b3/public/product/";
		let initPos = 0;
        
		const init = () => {
            // Load image ajax
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if(this.status === 200 && this.readyState === 4) {
                    imageLoaded = JSON.parse(this.response);

                    // Update select option tag
                    let optionTags = imageLoaded.map( (op, i) => `<option value="${i}">${op.name}</option>`);
                    document.querySelector("select[name='laptopSel']").innerHTML = optionTags;

                    // Initial first image
                    let imgElement = document.getElementById("laptopImg");
			        imgElement.src = urlImageLoaded + imageLoaded[initPos].image;
                }
            }
            xmlhttp.open("GET", "./ajaxLoadImage.php", true);
            xmlhttp.send();
		}
	
		function changeSlide(pos) {
			let imgElement = document.getElementById("laptopImg");
			if(pos > 0) {
				if(initPos === imageLoaded.length -1) initPos = -1;
				imgElement.src = urlImageLoaded + imageLoaded[initPos + pos].image;
				initPos ++;
			} else {
				if(initPos === 0) initPos = imageLoaded.length;
				imgElement.src = urlImageLoaded + imageLoaded[initPos + pos].image;
				initPos --;
			}
    
            // Chang selected option
            let selectLap = Array.from(document.querySelectorAll("select[name='laptopSel'] option"));
			selectLap.map( sl => sl.removeAttribute("selected"));
			selectLap[initPos].setAttribute("selected", "selected");
		}
	
		function chooseSlide(pos) {
			let imgElement = document.getElementById("laptopImg");
			imgElement.src = urlImageLoaded + imageLoaded[pos].image;
			initPos = Number(pos);
		}
	
		window.onload = () =>  {
            init();
            console.log(imageLoaded)
		}
	</script>


</body>
</html>