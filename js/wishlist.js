// const productDB = new productDB();

const favActive = (event) =>{
    event.preventDefault();
    console.log(event.target);
    if (event.target.classList.contains('fa-regular')){
        event.target.classList.add('fa-solid');
        event.target.classList.remove('fa-regular');
    } else{
        event.target.classList.add('fa-regular');
        event.target.classList.remove('fa-solid');
    }
}

