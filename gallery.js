$( document ).ready(function() {
  var list_elements = [];
  list_elements = document.getElementsByClassName('pic_link');
  for(var i = 0; i < list_elements.length; i++){
    list_elements[i].addEventListener('click', get_product, false);
  }

  $(".part-info", parent.window.document).hide();
  $("#div-tyotila", parent.window.document).css("height", "100%");

});


function get_product(evt){
  evt.preventDefault();
  var id = this.name;
  window.parent.document.getElementById('work_space').src = "./picture.php?id="+id;
  $(".part-info", parent.window.document).show();
  $("#div-tyotila", parent.window.document).css("height", "calc(100% - 80px)");
};
