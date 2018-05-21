$( document ).ready(function() {
  var product_list_elements = [];
  var order_list_elements = [];
  var basket_list_elements = [];
  var packing_list_elements = [];

  order_list_elements = document.getElementsByClassName('order_link');
  for(var i = 0; i < order_list_elements.length; i++){
    order_list_elements[i].addEventListener('click', get_order, false);
  }

  product_list_elements = document.getElementsByClassName('product_link');
  for(var i = 0; i < product_list_elements.length; i++){
    product_list_elements[i].addEventListener('click', get_product, false);
    product_list_elements[i].addEventListener('mouseover', nayta_kuva, false);
    product_list_elements[i].addEventListener('mouseleave', sulje_kuva, false);
  }
  basket_list_elements = document.getElementsByClassName('basket_link');
  for(var i = 0; i < basket_list_elements.length; i++){
    basket_list_elements[i].addEventListener('click', get_basket, false);
    //basket_list_elements[i].addEventListener('click', prevent_click, false);
  }
  packing_list_elements = document.getElementsByClassName('packing_link');
  for(var i = 0; i < packing_list_elements.length; i++){
    packing_list_elements[i].addEventListener('click', get_packing_list, false);
    //basket_list_elements[i].addEventListener('click', prevent_click, false);
  }

});

function prevent_click(evt){
  evt.preventDefault();
}


function get_product(evt){
  evt.preventDefault();
  var id = this.name;
  product_id = this.text.trim();
  var workspace_content = parent.window.document.getElementById("work_space").src;
  if(workspace_content.indexOf('order_add.php') < 0) {
    parent.window.document.getElementById("work_space").src = "./picture.php?id="+product_id;
    $(".part-info", parent.window.document).show();
    $("#div-tyotila", parent.window.document).css("height", "calc(100% - 80px)");
  } else{
    parent.window.document.getElementById("work_space").contentWindow.document.getElementById('product_id').value = this.name;
    parent.window.document.getElementById("work_space").contentWindow.document.getElementById('amount').focus();
  }
};

function get_order(evt){
  evt.preventDefault();
  order_id = this.text.trim();
  parent.window.document.getElementById("work_space").src = "./order.php?order_id="+order_id;

  // Hide part info
  $(".part-info", parent.window.document).hide();
  $("#div-tyotila", parent.window.document).css("height", "100%");
}

function get_pdf_document(evt){
  evt.preventDefault();
  var id = this.name;
  product_id = this.text.trim();
  parent.window.document.getElementById("work_space").src = "./pdf_document.php?id="+product_id;
};

function get_basket(evt){
  evt.preventDefault();
  var id = this.id;
  parent.window.document.getElementById("work_space").src = "./basket_show.php?supplier="+id;
}

function get_packing_list(evt){
  evt.preventDefault();
  var id = this.id;
  parent.window.document.getElementById("work_space").src = "./packing_list_show.php?customer="+id;
}


function nayta_kuva(evt){
  var mouseX;
  var mouseY;
  var id = this.name;
  mouseX = evt.clientX;
  mouseY = evt.clientY;
  document.getElementById("small_pic").src = "./pics/"+id+".jpg";
  $('#float-tip').css({'top':mouseY-150 ,'left':mouseX-75,'height':150,'width':200});
  $('#float-tip').show();

}

function sulje_kuva(){
  $('#float-tip').hide();

}
