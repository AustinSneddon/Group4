// Sidebar
const menueItems = document.querySelectorAll('menu-item');

//remove active class from all menu items
const changeActiveItem = () => {
    menueItems.forEach(item =>{
        item.classList.remove('active');
    })
}
menueItems.forEach(item => {
    item.addEventListener('click', () => {
        changeActiveItem();
        item.classList.add('active');
        if(item.id != 'products'){
            document.querySelector('.product-popup').
            stlye.display = 'none';            
        }
        else{
            document.querySelector('.product-popup').
            stlye.display = 'block';  
        }
    })
})

