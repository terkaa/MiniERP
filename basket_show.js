$( document ).ready(function() {
  var delete_basket_elements = [];

  delete_basket_elements = document.getElementsByClassName('delete');
  for(var i = 0; i < delete_basket_elements.length; i++){
    delete_basket_elements[i].addEventListener('click', delete_from_basket, false);
  }
  document.getElementById('basket_order').addEventListener('click',create_purchase_order, false);
});

function delete_from_basket(evt){
  evt.preventDefault();
  var key = this.name;
  var supplier_id = document.getElementById('supplier_id').name;
  //alert(supplier_id);
  $.ajax( {
    type:'POST',
    url:"basket_del.php",
    data: { key:key }
  } )
    .success (function() {parent.window.document.getElementById("work_space").src = "./basket_show.php?supplier="+supplier_id;})
    .error   (function()     { alert("Error")   ; });
  //.complete(function()     { alert("complete"); })
};

function create_purchase_order(evt){
  evt.preventDefault();
  var supplier_id = document.getElementById('supplier_id').name;
  var time = document.getElementById('time').value;
  parent.window.document.getElementById("work_space").src = "./purchase_order_create.php?supplier_id="+supplier_id+"&time="+time;

}
