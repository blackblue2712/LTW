window.onload = function () {
    // validate
    let btnSubmit = document.getElementById("submit-form");
    btnSubmit.addEventListener("click", event => {
        event.preventDefault();
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        if(password !== "" && username !== "") {
            document.getElementById("login-form").submit();
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