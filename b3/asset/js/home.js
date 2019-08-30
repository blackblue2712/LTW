let onOpenNewTab = uri => {
    let win = window.open(uri, "_blank")
    win.forcus();
}
window.onload = function() {

    // Scroll on top
    window.onscroll = () => {
        let gotop = document.getElementById("scrollTop");
        if(window.scrollY > 100) {
            gotop.classList.add("show");
            gotop.classList.remove("hide")
        } else {
            gotop.classList.add("hide");
            gotop.classList.remove("show")
        }
    }

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

    // ajax get products
    getProducts();
}


let scrollToTop = () => {
    window.scrollTo(0, 0)
}

let changeUI = () => {
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

let signout = () => {
    let check = window.confirm("Are you want to sign out?");
    if(check) {
        window.location = "./controllers/user/signout.php";
    }
}

let getProducts = () => {
    let wrapList = document.getElementById("wrap-table");
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            if(wrapList) {
                let res = JSON.parse(this.response);
                let URL_PIC = res[res.length -1].URL_PIC;
                delete(res[res.length -1]);
                let xpr = "";
                res.map( (pr, index) => {
                    // let description = pr.description.length > 100 ? pr.description.substr(0, 100) + "..." : pr.description;
                    xpr += `<tr class="odd">
                                <td>${pr.idProduct}</td>
                                <td>${pr.name}</td>
                                <td>${pr.price}</td>
                                <td><img src="${URL_PIC+'/'+pr.picture}" width=70></td>
                                <td><img src='./icon/edit.png' width=30 style="cursor: pointer" onclick="onEdit('product',${pr.idProduct})"></td>
                                <td><img src='./icon/delete.png' width=30 style="cursor: pointer" onclick="onDelete('product',${pr.idProduct})"></td>
                            </tr>`;
                })
                let xhtml = `<table class="table-list">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">ID</th>
                                        <th style="width: 40%;">Name</th>
                                        <th style="width: 30%;">Price</th>
                                        <th style="width: 15%;">Picture</th>
                                        <th style="width: 5%;">Edit</th>
                                        <th style="width: 5%;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${xpr}
                                </tbody>
                            </table>`;

                setTimeout( () => {
                    wrapList.innerHTML = xhtml
                }, 1000);
            }
        }
    }

    xmlhttp.open("GET", "./controllers/product/ed-product.php?role=getall", true);
    xmlhttp.send();
}

let toggleModel = id => {
    let listBox = document.getElementById('list');
    let formBox = document.getElementById('form');
    if(id === 'list') {
        listBox.classList.add('show-model-box');
        listBox.classList.remove('hide-model-box');
        formBox.classList.add('hide-model-box');
    } else {
        formBox.classList.add('show-model-box');
        formBox.classList.remove('hide-model-box');
        listBox.classList.add('hide-model-box');
    }
}

let onEdit = (type, id) => {
    document.getElementById("form-edit").classList.add("show");
    document.getElementById("form-edit").classList.remove("hide");

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            let data = JSON.parse(this.response);
            document.getElementById("edit-name").value = data.name;
            document.getElementById("edit-price").value = data.price;
            document.getElementById("edit-description").innerHTML = data.description;
            document.getElementById("edit-id").value = data.idProduct;
        }
    }

    xmlhttp.open("GET", "./controllers/"+type+"/ed-product.php?role=getsingle&id="+id);
    xmlhttp.send();
}

let onDelete = (type, id) => {
    console.log(type, id)
}