// Sidebar
const menuItems = document.querySelectorAll('.menu-item');

//remove active class from all menu items
const changeActiveItem = () => {
    menuItems.forEach(item =>{
        item.classList.remove('active');
    })
}
menuItems.forEach(item => {
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