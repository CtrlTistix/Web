<!-- Modal para Detalles del Producto -->
<div id="productModal" class="product-modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h4 id="modalProductName"></h4>
    <p id="modalProductPrice">Precio: <span id="modalPriceValue"></span></p>
    <div id="modalProductImage"></div>
    <div class="quantity-container">
      <button id="decreaseQuantity">-</button>
      <input type="number" id="productQuantity" value="1" min="1" readonly>
      <button id="increaseQuantity">+</button>
    </div>
    <a href="#" class="btnAddcarrito add-to-cart-button" id="modalAddToCart" prod="">Añadir al carrito</a>
  </div>
</div>



<?php include_once 'Views/template/header-principal.php'; ?>

<!-- banner section start -->
<div class="banner_section layout_padding">
  <div class="container">
    <div id="my_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
              <div class="buynow_bt"><a href="#">Buy Now</a></div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
              <div class="buynow_bt"><a href="#">Buy Now</a></div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
              <div class="buynow_bt"><a href="#">Buy Now</a></div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
        <i class="fa fa-angle-left"></i>
      </a>
      <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
        <i class="fa fa-angle-right"></i>
      </a>
    </div>
  </div>
</div>
<!-- banner section end -->

</div>
<!-- banner bg main end -->

<!-- fashion section start -->
<?php foreach ($data['categorias'] as $categoria) { ?>
  <div class="fashion_section">
    <div class="container" id="categoria_<?php echo $categoria['id']; ?>">
      <h1 class="fashion_taital text-uppercase"><?php echo $categoria['categoria']; ?></h1>
      <div class="row <?php echo (count($categoria['productos']) > 0) ? 'multiple-items' : ''; ?>">
        <?php foreach ($categoria['productos'] as $producto) { ?>
          <div class="<?php echo (count($categoria['productos']) > 2) ? 'col-lg-4' : 'col-lg-12'; ?>">
            <div class="box_main">
              <h4 class="shirt_text"><?php echo $producto['nombre']; ?></h4>
              <p class="price_text">Precio <span style="color: #262626;">$ <?php echo $producto['precio']; ?></span></p>
              <div class="text-center">
                <img data-lazy="<?php echo BASE_URL . $producto['imagen']; ?>" />
              </div>
              <div class="btn_main">
                <div class="buy_bt"><a href="#" class="btnAddcarrito" prod="<?php echo $producto['id']; ?>">Añadir</a></div>
                <div class="seemore_bt"><a href="#">Leer más</a></div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } ?>

<?php include_once 'Views/template/footer-principal.php'; ?>


<style>
/* Estilos del Modal de Producto */
.product-modal {
  display: none; 
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.6);
}

.product-modal .modal-content {
  background-color: #fff;
  margin: 10% auto;
  padding: 20px;
  border-radius: 5px;
  width: 80%;
  max-width: 600px;
  text-align: center;
}

.product-modal .close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.product-modal .close:hover,
.product-modal .close:focus {
  color: #000;
  cursor: pointer;
}


.quantity-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-top: 15px;
}

.quantity-container button {
  width: 30px;
  height: 30px;
  font-size: 18px;
  cursor: pointer;
}

#productQuantity {
  width: 40px;
  text-align: center;
}

.add-to-cart-button {
  background-color: #ff6f61;
  color: #fff;
  border: none;
  padding: 10px 20px;
  margin-top: 15px;
  cursor: pointer;
  border-radius: 5px;
}

.add-to-cart-button:hover {
  background-color: #ff3b2f;
}

</style>
<!-- fin del estilo-->

<!--Script detalles(leer mas)-->
<script>

$(document).on('click', '.seemore_bt a', function(event) {
  event.preventDefault();
  
 
  let productId = $(this).closest('.box_main').find('.btnAddcarrito').attr('prod');
  let productName = $(this).closest('.box_main').find('.shirt_text').text();
  let productPrice = parseFloat($(this).closest('.box_main').find('.price_text span').text().replace('$', '').trim());
  let productImageSrc = $(this).closest('.box_main').find('img').attr('data-lazy');

  $('#modalProductName').text(productName);
  $('#modalPriceValue').text(`$ ${productPrice.toFixed(2)}`);
  $('#modalProductImage').html(`<img src="${productImageSrc}" alt="${productName}" style="width: 100%;">`);
 
  $('#modalAddToCart').attr('prod', productId);
  $('#productModal').data('productPrice', productPrice);
  $('#productQuantity').val(1);
  

  $('#productModal').fadeIn();
});


$(document).on('click', '.close', function() {
  $('#productModal').fadeOut();
});

$(window).on('click', function(event) {
  if ($(event.target).is('#productModal')) {
    $('#productModal').fadeOut();
  }
});


$('#increaseQuantity').on('click', function() {
  let quantity = parseInt($('#productQuantity').val()) + 1;
  $('#productQuantity').val(quantity);
  updateModalPrice();
});

$('#decreaseQuantity').on('click', function() {
  let quantity = Math.max(1, parseInt($('#productQuantity').val()) - 1);
  $('#productQuantity').val(quantity);
  updateModalPrice();
});


function updateModalPrice() {
  let basePrice = $('#productModal').data('productPrice');
  let quantity = parseInt($('#productQuantity').val());
  let totalPrice = basePrice * quantity;
  $('#modalPriceValue').text(`$ ${totalPrice.toFixed(2)}`);
}


$(document).on('click', '#modalAddToCart', function(event) {
  event.preventDefault();
  

  let productId = $(this).attr('prod');
  let quantity = parseInt($('#productQuantity').val());
  let totalPrice = parseFloat($('#modalPriceValue').text().replace('$', '').trim());
  

  $.ajax({
    url: 'ruta_del_controlador_para_agregar_al_carrito.php', 
    type: 'POST',
    data: {
      id: productId,
      quantity: quantity,
      price: totalPrice
    },
    success: function(response) {

      $('#productModal').fadeOut(); 

    },
    error: function() {
      alert('Hubo un problema al añadir el producto al carrito.');
    }
  });
});

</script>
<!-- Fin del escript-->

<script>
  $('.multiple-items').slick({
    lazyLoad: 'ondemand',
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
</script>

</body>

</html>