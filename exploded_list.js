$( document ).ready(function() {
  var add_basket_elements = [];

  add_basket_elements = document.getElementsByClassName('add_basket');
  for(var i = 0; i < add_basket_elements.length; i++){
    add_basket_elements[i].addEventListener('click', add_to_basket, false);
    //alert("jee");
  }
  document.getElementById("add_part").addEventListener('click', add_part, false);
  if(document.getElementById('dxf_open') !== null){
    document.getElementById("dxf_open").addEventListener('click', dxf_open, false);}
  if(document.getElementById('dxf_add') !== null){
    document.getElementById("dxf_add").addEventListener('click', dxf_add, false);}


  // Calculate window content height
  // Add 20 pixels of padding
  var content_height = $(".actionwindow-content").height() + 50;
  $("#actionwindow1", parent.window.document).css("height", content_height);

  // Set actionwindow button highlighted
  $("#div-actionbutton1", parent.window.document).addClass("active");

});

function add_part(evt){
  evt.preventDefault();
  var id = document.getElementById('id').value;
  //alert(id);
  parent.window.document.getElementById("actionwindow1").src = "./part_add.php?id="+id;

}


function add_to_basket(evt){
  evt.preventDefault();
  var key = this.name;
  var amount = document.getElementById('amount'+this.name).value;
  $.ajax( {
    type:'POST',
    url:"basket_add.php",
    data: { key:key ,amount:amount}
  } )
    .success (function() { alert("Viety"); })
    .error   (function() { alert("Error"); });
  //.complete(function()     { alert("complete"); })
}

function dxf_open(evt){
  evt.preventDefault();
  var id = document.getElementById('id').value;
  parent.window.document.getElementById("actionwindow1").src = "./dxf_reader_fpdf.php?id="+id+"&pdf=0&mode=1";
}

function dxf_add(evt){
  evt.preventDefault();
  var id = document.getElementById('id').value;
  parent.window.document.getElementById("actionwindow1").src = "./dxf_select.html?id="+id;
}

