// ************************************************
// Shopping Cart API
// ************************************************

var shoppingCart = (function() {
  // =============================
  // Private methods and propeties
  // =============================
  cart = [];
  
  // Constructor
  function Item(produk, price, count, idproduk, warna) {
    this.idproduk = idproduk;
    this.produk = produk;
    this.price = document.getElementById('modal_total').value;
    this.count = document.getElementById('jumlah_produk').value;
    this.warna = $('input[name=pilihwarna]:checked').attr('namawarna');
    this.idwarna = $('input[name=pilihwarna]:checked').val();
    this.bahan = $('input[name=pilihbahan]:checked').attr('namabahan');
    this.idbahan = $('input[name=pilihbahan]:checked').val();
    this.satbahan = $('input[name=pilihbahan]:checked').attr('placeholder');
    this.idukuran = $('input[name=pilihukuran]:checked').val();
    this.ukuran = $('input[name=pilihukuran]:checked').attr('namaukuran');
    this.desain = $('input[name=pilihdesain]:checked').val();
    this.ketpembayaran = $('input[name=ket_pembayaran]:checked').val();    
  }
  
  // Save cart
  function saveCart() {
    sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
  }
  
    // Load cart
  function loadCart() {
    cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
  }
  if (sessionStorage.getItem("shoppingCart") != null) {
    loadCart();
  }
  

  // =============================
  // Public methods and propeties
  // =============================
  var obj = {};
  
  // Add to cart
  obj.addItemToCart = function(produk, price, count, idproduk, warna, bahan, ukuran, satbahan) {
    for(var item in cart) {
      if(cart[item].produk === produk) {
        cart[item].count ++;
        saveCart();
        return;
      }
    }
    var item = new Item(produk, price, count, idproduk, warna, bahan, ukuran, satbahan);
    cart.push(item);
    saveCart();
  }
  // Set count from item
  obj.setCountForItem = function(produk, count) {
    for(var i in cart) {
      if (cart[i].produk === produk) {
        cart[i].count = count;
        break;
      }
    }
  };
  // Remove item from cart
  obj.removeItemFromCart = function(produk) {
      for(var item in cart) {
        if(cart[item].produk === produk) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveCart();
  }

  // Remove all items from cart
  obj.removeItemFromCartAll = function(produk) {
    for(var item in cart) {
      if(cart[item].produk === produk) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  // Clear cart
  obj.clearCart = function() {
    cart = [];
    saveCart();
  }

  // Count cart 
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

  // Total cart
  obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].count;
    }
    return Number(totalCart);
  }

  // List cart
  obj.listCart = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * (item.count / item.satbahan));
      cartCopy.push(itemCopy)
    }
    return cartCopy;
  }

  // cart : Array
  // Item : Object/Class
  // addItemToCart : Function
  // removeItemFromCart : Function
  // removeItemFromCartAll : Function
  // clearCart : Function
  // countCart : Function
  // totalCart : Function
  // listCart : Function
  // saveCart : Function
  // loadCart : Function
  return obj;
})();


// *****************************************
// Triggers / Events
// ***************************************** 
// Add item
$('.add-to-cart').click(function(event) {
  event.preventDefault();
  var produk = $(this).data('produk');
  var price = Number($(this).data('price'));
  var count = Number($(this).data('count'));
  var idproduk = $(this).data('idproduk');
  var warna = $(this).data('warna');
  var bahan = $(this).data('bahan');
  var ukuran = $(this).data('ukuran');
  shoppingCart.addItemToCart(produk, price, count, idproduk, warna, bahan, ukuran);
  displayCart();
});

// Clear items
$('.clear-cart').click(function() {
  shoppingCart.clearCart();
  displayCart();
});


function displayCart() {
  var cartArray = shoppingCart.listCart();
  var output = "";
  var outputbayar = "";
  for(var i in cartArray) {
    output += "<tr>"
      + "<td>" + cartArray[i].produk + " / " + cartArray[i].warna + " / " + cartArray[i].bahan + " / " + cartArray[i].ukuran + "</td>" 
      + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-produk=" + cartArray[i].produk + ">-</button>"
      + "<input type='number' id='jumlah' class='item-count form-control' data-produk='" + cartArray[i].produk + "' value='" + cartArray[i].count + "'>"
      + "<button class='plus-item btn btn-primary input-group-addon' data-produk=" + cartArray[i].produk + ">+</button></div></td>"
      + "<td><button class='delete-item btn btn-danger' data-produk=" + cartArray[i].produk + ">X</button></td>"
      + " = " 
      + "<td>" + cartArray[i].total + "</td>" 
      +  "</tr>";

      outputbayar += "<tr>"
      + "<td>" + cartArray[i].produk + " / " + cartArray[i].warna + " / " + cartArray[i].bahan + " / " + cartArray[i].ukuran + "</td>" 
      + "<td>"+ cartArray[i].count +"</td>"
      + " = " 
      + "<td>" + cartArray[i].total + "</td>" 
      +  "</tr>"
      + "<input type='hidden' name='id_produk' value='" + cartArray[i].idproduk + "'>"
      + "<input type='hidden' name='nama_produk' value='" + cartArray[i].produk + "'>"
      + "<input type='hidden' name='pilihwarnaa' value='" + cartArray[i].idwarna + "'>"
      + "<input type='hidden' name='pilihbahan' value='" + cartArray[i].idbahan + "'>"
      + "<input type='hidden' name='pilihukuran' value='" + cartArray[i].idukuran + "'>"
      + "<input type='hidden' name='pilihdesain' value='" + cartArray[i].desain + "'>"
      + "<input type='hidden' name='ket_pembayaran' value='" + cartArray[i].ketpembayaran + "'>"
      + "<input type='hidden' name='jumlah_produk' value='" + cartArray[i].count + "'>"
      + "<input type='hidden' name='sub_total' value='" + cartArray[i].total + "'>"
      + "<input type='hidden' name='total' value='" + shoppingCart.totalCart() + "'>";
  }
  $('.show-cart').html(output);
  $('.show-cart-bayar').html(outputbayar);
  $('.total-cart').html(shoppingCart.totalCart());
  $('.total-count').html(shoppingCart.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
  var produk = $(this).data('produk')
  shoppingCart.removeItemFromCartAll(produk);
  displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
  var produk = $(this).data('produk')
  shoppingCart.removeItemFromCart(produk);
  displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
  var produk = $(this).data('produk')
  shoppingCart.addItemToCart(produk);
  displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
   var produk = $(this).data('produk');
   var count = Number($(this).val());
  shoppingCart.setCountForItem(produk, count);
  displayCart();
});

displayCart();

$(document).on('click','body *',function (){
  
});
