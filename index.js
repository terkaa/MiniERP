//Javascript functions used on main page
var product_id = ' ';

window.onload = function() {
  $("#find_product").bind("keypress", {}, prevent_enter);
  $("#find_product").bind("keyup", {}, find_product);
  document.getElementById("work_space").src = "./gallery.php"; //load gallery to workspace
  document.getElementById("navibar").src = "./get_products.php"; //load list of products to left bar
  document.getElementById("orderbar").src = "./get_orders.php"; //load list of open orders to right bar

};

$( document ).ready(function() {

  document.getElementById("work_space").style.display = 'block';
  document.getElementById("gallery_link").addEventListener('click', main_gallery, false);
  //document.getElementById("gallery_link").addEventListener('click', prevent_click, false);
  document.getElementById("action_link1").addEventListener('click', show_actionwindow1, false);
  //document.getElementById("action_link1").addEventListener('click', prevent_click, false);
  // document.getElementById("div-actionwindow1").addEventListener('mouseleave', hide_actionwindow, false);
  document.getElementById("action_link2").addEventListener('click', show_actionwindow2, false);
  //document.getElementById("action_link2").addEventListener('click', prevent_click, false);
  // document.getElementById("div-actionwindow2").addEventListener('mouseleave', hide_actionwindow, false);
  document.getElementById("order_add_button").addEventListener('click', order_add, false);
  document.getElementById("action_link3").addEventListener('click', show_actionwindow3, false);
  // document.getElementById("div-actionwindow3").addEventListener('mouseleave', hide_actionwindow, false);
  document.getElementById("action_link4").addEventListener('click', show_actionwindow4, false);
  // document.getElementById("div-actionwindow4").addEventListener('mouseleave', hide_actionwindow, false);
  document.getElementById("action_link5").addEventListener('click', show_actionwindow5, false);
  // document.getElementById("div-actionwindow5").addEventListener('mouseleave', hide_actionwindow, false);
  document.getElementById("action_link6").addEventListener('click', show_actionwindow6, false);
  //below code fits content dynamically to fit browser window size
  // $('#div-tyotila').height($(window).height() - 200)
  // $('#div-tilauspalkki').height($(window).height() - 100)
  // $('#div-navipalkki').height($(window).height() - 110)
  // $('#work_space').height($(window).height()-150)
  var height = $(window).height();

  $(".actionwindow").hide();

});

function prevent_click(evt){
  evt.preventDefault();
}

function main_gallery(evt){
  //clicking Gallery link basically resets application
  evt.preventDefault();
  document.getElementById("product_id").innerHTML = " ";
  document.getElementById("work_space").src = "./gallery.php";
  document.getElementById("find_product").value = '';
  document.getElementById("navibar").src = "./get_products.php";
  document.getElementById("id_stock_amount").innerHTML = "0";
};

function find_product(e) {
  //lists only products that contain phrase in search input field
  var code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) { //Enter keycode
    e.preventDefault();
  }
  else{
    var phrase = document.getElementById("find_product").value;
    document.getElementById("navibar").src = "./get_products.php?phrase="+phrase;
    document.getElementById("work_space").src = "./gallery.php?phrase="+phrase;
  }

};


function enable_actionbutton_icon(button_selector) {
  if($(button_selector).hasClass("fa-chevron-down")) {
    $(button_selector).addClass("fa-chevron-up");
    $(button_selector).removeClass("fa-chevron-down");
  } else {
    $(button_selector).addClass("fa-chevron-down");
    $(button_selector).removeClass("fa-chevron-up");
  }
}

function reset_actionbutton_icons() {
  $(".actionicon").each(function(index, element) {
    if (!$(element).hasClass("fa-chevron-down")) {
      $(element).addClass("fa-chevron-down");
      $(element).removeClass("fa-chevron-up");
    }
  });
}


function prevent_enter(e) {
  //prevents enter for search input field because it is replaced by functions above
  var code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) { //Enter keycode
    e.preventDefault();
  }

};

function show_actionwindow1(evt) {
  //shows or hides actionwindow1 based on current state also if shown content is loaded in it
  evt.preventDefault();
  $(".actionbutton").removeClass("active");
  reset_actionbutton_icons();

  if($("#div-actionwindow1").is(":visible")){
    $("#div-actionwindow1").hide();
  } else {
    $(".actionwindow").hide();
    $("#div-actionbutton1").addClass("active");
    enable_actionbutton_icon("#div-actionbutton1 .actionicon");

    var id = document.getElementById("product_id").innerHTML;
    document.getElementById('div-actionwindow1').style.display = "block";
    document.getElementById('actionwindow1').src = "./exploded_list.php?id="+id;
    // $('#div-actionwindow1').width(1000);
    // $('#div-actionwindow1').height(600);
  }
}


function show_actionwindow2(evt) {
  //shows actionwindow2 it is closed by mouseleave
  evt.preventDefault();
  $(".actionbutton").removeClass("active");
  reset_actionbutton_icons();

  if($("#div-actionwindow2").is(":visible")){
    $("#div-actionwindow2").hide();
  } else{
    $(".actionwindow").hide();
    $("#div-actionbutton2").addClass("active");
    enable_actionbutton_icon("#div-actionbutton2 .actionicon");

    document.getElementById('div-actionwindow2').style.display = "block";
    document.getElementById('actionwindow2').src = "./basket_list.php";
  }

  // $('#div-actionwindow2').width(300);
  //$('#div-actionwindow2').height(600);
}

function show_actionwindow3(evt) {
  //shows actionwindow3 it is closed by mouseleave
  evt.preventDefault();
  $(".actionbutton").removeClass("active");
  reset_actionbutton_icons();

  if($("#div-actionwindow3").is(":visible")){
    $("#div-actionwindow3").hide();
  } else {
    $(".actionwindow").hide();
    $("#div-actionbutton3").addClass("active");
    enable_actionbutton_icon("#div-actionbutton3 .actionicon");

    document.getElementById('div-actionwindow3').style.display = "block";
    document.getElementById('actionwindow3').src = "./balance.php";
  }
  // $('#div-actionwindow3').width(450);
  // $('#div-actionwindow3').height($(window).height() - 150);
}

function show_actionwindow4(evt) {
  //shows actionwindow4 it is closed by mouseleave
  evt.preventDefault();
  $(".actionbutton").removeClass("active");
  reset_actionbutton_icons();

  if($("#div-actionwindow4").is(":visible")){
    $("#div-actionwindow4").hide();
  } else {
    $(".actionwindow").hide();
    $("#div-actionbutton4").addClass("active");
    enable_actionbutton_icon("#div-actionbutton4 .actionicon");

    document.getElementById('div-actionwindow4').style.display = "block";
    document.getElementById('actionwindow4').src = "./packing_list.php";
  }
  // $('#div-actionwindow4').width(250);
  // $('#div-actionwindow4').height($(window).height() - 150);
}

function show_actionwindow5(evt) {
  //shows actionwindow5 it is closed by mouseleave
  evt.preventDefault();
  $(".actionbutton").removeClass("active");
  reset_actionbutton_icons();

  if($("#div-actionwindow5").is(":visible")){
    $("#div-actionwindow5").hide();
  } else {
    $(".actionwindow").hide();
    $("#div-actionbutton5").addClass("active");
    enable_actionbutton_icon("#div-actionbutton5 .actionicon");

    var product_id = document.getElementById("product_id").innerHTML;
    product_id = product_id.trim();
    document.getElementById('div-actionwindow5').style.display = "block";
    document.getElementById('actionwindow5').src = "./work_calendar.php?id="+product_id;
  }
  // $('#div-actionwindow5').width($(window).width() - 350);
  // $('#div-actionwindow5').height($(window).height() - 150);
}


function show_actionwindow6(evt) {
  //shows actionwindow6 it is closed by mouseleave
  evt.preventDefault();
  $(".actionbutton").removeClass("active");
  reset_actionbutton_icons();

  if($("#div-actionwindow6").is(":visible")){
    $("#div-actionwindow6").hide();
  } else {
    $(".actionwindow").hide();
    $("#div-actionbutton6").addClass("active");
    enable_actionbutton_icon("#div-actionbutton6 .actionicon");
    document.getElementById('div-actionwindow6').style.display = "block";
    document.getElementById('actionwindow6').src = "./clockcard_get_stamps.php";
  
}

      // $('#div-actionwindow5').width($(window).width() - 350);
  // $('#div-actionwindow5').height($(window).height() - 150);
}


function hide_actionwindow(evt){
  //actionwindow1 is closed by mouseleave unless iframe inside it has div with id="prevent_close"
  if(document.getElementById('actionwindow1').contentWindow.document.getElementById('prevent_close') == null){
    $(this).hide();
  }

  $(".actionbutton").removeClass("active");
}

function order_add(evt){
  //order_add button functionality
  evt.preventDefault();
  document.getElementById("work_space").src = "./order_add.php";
}
