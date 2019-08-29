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