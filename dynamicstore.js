

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    active()
}

/*Calls the getfunction when new page loads
****IMPORTANT MUST GET INFO AFTER!!! NEW PAGE LOAD*****/

window.onload = function dt()
{   console.log(window.location.href)
    if(window.location.href == 'cart.html')
    {
        productincartupdate()
    }

    if (window.location.href == 'checkout.html')
    { 
        checkouttotalupdate()
    }


    
}

function active()
{


var removeci = document.getElementsByClassName('rbtn')
for (var i = 0; i < removeci.length; i++) {
    var button = removeci[i]
    button.addEventListener('click', removeCartItem)
}

var quantities = document.getElementsByClassName('cart-quantity-input')
for (var i = 0; i < quantities.length; i++) {
    var input = quantities[i]
    input.addEventListener('change', quantityChanged)
    console.log('quantity changed')
}

var addcartitem = document.getElementsByClassName('addcart')
for (var i = 0; i < addcartitem.length; i++) {
    var button = addcartitem[i]
    button.addEventListener('click', addToCartClicked)
}
//addsproduct to session storage for the cart
var addcartitemstorage = document.getElementsByClassName('addcartstorage')
for (var i = 0; i < addcartitemstorage.length; i++) {
    var button = addcartitemstorage[i]
    button.addEventListener('click', addproductstorage)
    
}

var submittocheckout = document.getElementsByClassName('submitbtn')
for (var i = 0; i < submittocheckout.length; i++) {
    var button = submittocheckout[i]
    button.addEventListener('click', addtotalStorage )
}
}

function addToCartClicked(event) {

    var button = event.target
    console.log('addclicked')
    var card = button.parentElement.parentElement
    var title = card.getElementsByClassName('prodtitle')[0].innerText
    console.log(title)
    var price = card.getElementsByClassName('prodprice')[0].innerText
    console.log(price)
    var img = card.getElementsByClassName('prodimg')[0].src
    addItemToCart(title, price, img)
    updateCartTotal()
}
function addItemToCart(title, price, img) {
    var card = document.createElement('div')
    card.classList.add('card')
    var cartItems = document.getElementsByClassName('card')[0]
    console.log(cartItems)
    var cartItemNames = cartItems.getElementsByClassName('prodtitle')
    console.log(cartItemNames)
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('This item is already added to the cart')
            return
        }
    }

var carddesc = `

<div class="card">

    <div class="details">
        <img class="cartitemimage" src="${img}" height="250"  width="250" >
    


    <span class="prodtitle">${title}</span>
    <br></br>
    <span class="prodprice">${price}</span>
    <br></br>
<input class="cart-quantity-input" type="number" value="1">
<button class="rbtn" type="button">Remove</button>
</div>
</div>
 `
card.innerHTML = carddesc
cartItems.append(card)
card.getElementsByClassName('rbtn')[0].addEventListener('click', removeCartItem)
card.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}


function updateCartTotal()
{
    var productincart = document.getElementsByClassName('productincart-container')[0]
    var details = productincart.getElementsByClassName('details')
   
    var total = 0
    for(var i = 0; i < details.length; i++)
    {
        var sdetail = details[i]

        var priceE = sdetail.getElementsByClassName('prodprice')[0]

        var quanE = sdetail.getElementsByClassName('cart-quantity-input')[0]

        console.log(priceE, quanE)

        var price = parseFloat(priceE.innerText.replace('$', ''))
        var quantity = quanE.value
        console.log(price, quantity)
        total = total + (price * quantity)
        console.log(total)

    }
    
total = Math.round(total * 100) / 100
document.getElementsByClassName('cartTotal')[0].innerText = '$' + total


}

/*https://www.section.io/engineering-education/how-to-use-localstorage-with-javascript/ 
Above link show general code outline I could not get localstorage to save data across html pages so used sessionstorage
which should be interchangable but only it works???*/ 


/* Adds total to html storage*/
function addtotalStorage(event)
{ window.location.href='checkout.html'
   

        var ttotal = document.getElementsByClassName('cartTotal')[0].innerText

        
        console.log(ttotal)
        var transtotal = parseFloat(ttotal.replace('$', ''))

        if(!isNaN(transtotal) )
        {
            sessionStorage.setItem('checkTotal', JSON.stringify(transtotal))
            console.log(transtotal)
        }

     
      
     
    

    console.log(window.location.href)
    


}
/*Add product price and title to storage*/
function addproductstorage(event)
{
    var cartitemcounter = +1
    var ttitle = document.getElementsByClassName("prodtitle")[0].innerText

    var tprice = document.getElementsByClassName("prodprice")[0].innerText
    var timg = document.getElementsByClassName("prodimg")[0].src

    console.log(ttitle,tprice,timg)

    if(isNaN(ttitle, tprice))
    {
        sessionStorage.setItem('pTtitle', ttitle )
        sessionStorage.setItem('ptprice', tprice)
        sessionStorage.setItem('ptimg', timg)
        sessionStorage.setItem('cartcounter', cartitemcounter)
        
    }
    window.location.href = 'cart.html'
}



function productincartupdate()
{
    if ( window.location.href == 'file:///C:/Users/iploe/Documents/Senior%20CIS/Group4-main-Admin-Build/Group4-main/cart.html')
    {
        var ctitle = window.sessionStorage.getItem('pTtitle')
        var cprice = window.sessionStorage.getItem('ptprice')
        var cimg = window.sessionStorage.getItem('ptimg')
        var cic = window.sessionStorage.getItem('cartcounter')


        console.log(ctitle, cprice, cimg, cic)

        if(!null == (cic))
        {
        addItemToCart(ctitle,cprice,cimg)
        }
       

        updateCartTotal()
    }
}

/*Retrieves data if the correct page is loaded*/
function checkouttotalupdate() 
{ 
   

    if ( window.location.href == 'file:///C:/Users/iploe/Documents/Senior%20CIS/Group4-main-Admin-Build/Group4-main/checkout.html')
    {

    
    var cttotal = window.sessionStorage.getItem('checkTotal');
    console.log(cttotal);
    
    var tchange = document.getElementById("checkoutTotal")
    console.log(tchange)
    tchange.innerText = "$" + cttotal
    }
    else{ return}


    
   

    
    
}


