const listMenuNav = document.querySelectorAll('.list-1');
let url = location.pathname.split("/")
for (let i = 0; i < listMenuNav.length; i++) {
    var pathname = listMenuNav[i].getAttribute('href').split("?");
    if (pathname[0] === url[1]){
        listMenuNav[i].classList.add('active');
        break;
    }
}