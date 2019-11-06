var a = document.getElementById("kategori-sekolah");
var b = document.getElementById("kategori-usaha");

function TopScroll(){
    document.documentElement.scrollTop = 0;
    navbar.classList.remove("sticky");
}

function KatSekolah() {
    b.style.display = "none";

    if (a.style.display === "block") {
        a.style.display = "none";
    } else {
        a.style.display = "block";
    }
    
}

function KatUsaha() {
    a.style.display = "none";

    if (b.style.display === "block") {
        b.style.display = "none";
    } else {
        b.style.display = "block";
    }
    
}
