window.onload = function() {
 // document.getElementById('product_link').addEventListener('mouseleave', sulje_kuva, false);

};

$( document ).ready(function() {
    var list_elements = [];

    list_elements = document.getElementsByClassName('product_link');
    for(var i = 0; i < list_elements.length; i++){
  list_elements[i].addEventListener('click', get_product, false);
  list_elements[i].addEventListener('mouseover', nayta_kuva, false);
  list_elements[i].addEventListener('mouseleave', sulje_kuva, false);
    }

});

function get_product(evt){
        evt.preventDefault();
        var id = this.name;
        window.parent.document.getElementById('work_space').src = "./picture.php?id="+id;
};


function nayta_kuva(evt){
var mouseX;
var mouseY;
var id = this.name;
mouseX = evt.clientX;
mouseY = evt.clientY;
document.getElementById("small_pic").src = "./pics/"+id+".jpg";
$('#float-tip').css({'top':mouseY ,'left':mouseX,'height':150,'width':200});
//alert('x:'+mouseX+'y:'+mouseY);
$('#float-tip').show();

}


function sulje_kuva(){
$('#float-tip').hide();

}
