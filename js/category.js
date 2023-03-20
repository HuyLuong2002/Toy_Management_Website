// let span = document.getElementsByTagName('span');
let spanpre = document.getElementById('previous');
let spannext = document.getElementById('next');
let product = document.getElementsByClassName('product')
let product_page = Math.ceil(product.length / 4);
console.log(spanpre);
console.log(spannext);
let l = 0;
let movePer = 25.34;
let maxMove = 203;
// mobile_view	
let mob_view = window.matchMedia("(max-width: 768px)");
if (mob_view.matches) {
    movePer = 50.36;
    maxMove = 504;
}

let right_mover = () => {
    l = l + movePer;
    if (product == 1) { l = 0; }
    for (const i of product) {
        if (l > maxMove) { l = l - movePer; }
        i.style.left = '-' + l + '%';
    }

}
let left_mover = () => {
    l = l - movePer;
    if (l <= 0) { l = 0; }
    for (const i of product) {
        if (product_page > 1) {
            i.style.left = '-' + l + '%';
        }
    }
}
spannext.onclick = () => { right_mover(); }
spanpre.onclick = () => { left_mover(); }