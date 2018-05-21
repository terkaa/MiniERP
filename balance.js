$( document ).ready(function() {
  var balance_list_elements = [];

  balance_list_elements = document.getElementsByClassName('balance_link');
  for(var i = 0; i < balance_list_elements.length; i++){
    balance_list_elements[i].addEventListener('click', get_product, false);
    balance_list_elements[i].addEventListener('mouseover', show_pic, false);
    balance_list_elements[i].addEventListener('mouseleave', close_pic, false);
  }

  // Calculate window content height
  // Add 20 pixels of padding
  var content_height = $(".actionwindow-content").height() + 20;
  $("#actionwindow3", parent.window.document).css("height", content_height);

  // Set actionwindow button highlighted
  $("#div-actionbutton3", parent.window.document).addClass("active");

});

function prevent_click(evt){
  evt.preventDefault();
}


function get_product(evt){
  evt.preventDefault();
  var id = this.name;
  product_id = this.text.trim();
  parent.window.document.getElementById("work_space").src = "./picture.php?id="+product_id;
  $(".part-info", parent.window.document).show();
  $("#div-tyotila", parent.window.document).css("height", "calc(100% - 80px)");
};


function show_pic(evt){
  var mouseX;
  var mouseY;
  var id = this.name;
  mouseX = evt.clientX;
  mouseY = evt.clientY;
  document.getElementById("small_pic").src = "./pics/"+id+".jpg";
  $('#float-tip').css({'top':mouseY ,'left':mouseX-80,'height':150,'width':200});
  //alert('x:'+mouseX+'y:'+mouseY);
  $('#float-tip').show();

}

function close_pic(){
  $('#float-tip').hide();

}
