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

        let arr_errors  = [];

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
        } else {
            arr_errors.push("Select one hobby");
        }
        let pattUs = /^[a-zA-z]+.*/g;
        let pattPs = /[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/;

        if(password === "" || username === "") {
            arr_errors.push('You must enter username and password')
        }

        if(password !== rePassword) {
            arr_errors.push("Password and re-password are not match");
        }

        if(username.length < 5 || username.length > 15) {
            arr_errors.push("Username too long or too short!");
        }

        if(password.length < 5 || password.length > 15) {
            arr_errors.push("Password too long or too short!");
        }

        let str = pattUs.test(username) == true ? "pass" : "not-pass";
        if(str !== "pass") {
            arr_errors.push("Username must start with character!");
        }
        console.log(password.match(pattPs))
        if(password.match(pattPs) !== null) {
            arr_errors.push("Password only have number and character, not special character");
        }

        if(arr_errors.length === 0) {
            document.getElementById("login-form").submit();
        } else {
            alert(arr_errors[0]);
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

    document.getElementById("login-form").onclick = () => {
        let ele = document.getElementById('requirements');
        ele.classList.remove("show");
        ele.classList.add("hide");
    }
}

let onWrite = (event, text) => {
    setTimeout( () => {
        let ele = document.getElementById('requirements');
        ele.classList.add("show");
        ele.classList.remove("hide");
        ele.style.top = event.clientY - ele.offsetHeight/2 + "px";
        ele.style.left = event.clientX + ele.offsetWidth/2 + "px";
        ele.innerHTML = text;
    }, 1)

}

let onBlur = () => {
    let username = document.getElementById("username").value;
    let xmlhttp  = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status ===  200) {
            if(this.response !== "") {
                let mes = JSON.parse(this.response).message;
                onWrite(window.event, `<span style='color: red'>${mes}</span>`)
            }
        }
    }
    xmlhttp.open("GET", `./controllers/user/check.php?username=${username}`, true);
    xmlhttp.send();

}

