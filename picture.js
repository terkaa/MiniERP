window.onload = function() {
  document.getElementById('product_image').addEventListener('click', get_product_pdf, false);
  var product_id = document.getElementById('product_image').name;
  window.parent.document.getElementById("product_id").innerHTML = product_id;
  get_stock(product_id);
};


function get_product_pdf(evt){
  evt.preventDefault();
  var id = this.name;
  window.parent.document.getElementById('work_space').src = "./pdf_document.php?id="+id;
};


function get_stock(id){
  id = id.trim();
  $.ajax( {
    type:'POST',
    url:"get_id_stock.php",
    data: { key:id}
  })
  //.success (function() { alert(data)   ; }) 
    .success (function(data) { window.parent.document.getElementById("id_stock_amount").innerHTML = data; })
    .error   (function()     { alert("Error"); });
  //.complete(function()     { alert("complete"); })

};


