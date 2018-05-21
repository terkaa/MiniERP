window.onload = function() {
  $("#product_id").bind("keyup", {}, find_product);
};

$( document ).ready(function() {
  //alert("muu");
  document.getElementById("customer").addEventListener('change', customer_add, false);
  document.getElementById("date_ordered").addEventListener('click', calendar_show, false);
  document.getElementById("date_wanted").addEventListener('click', calendar_show, false);
  document.getElementById("submit_order").addEventListener('click', order_check, false);
  document.getElementById("add_product").addEventListener('click', add_product, false);
  document.getElementById("order_id").addEventListener('blur', order_list, false);
  document.getElementById("order_listed").addEventListener('load', set_customer, false);
  parent.window.document.getElementById("navibar").addEventListener('load', navi_loaded, false);
  document.getElementById("customer").value = document.getElementById("customer_id").value;
  //alert(document.getElementById("customer_id").value);
});

function add_product(evt){
  evt.preventDefault();
  var order_id=document.getElementById("order_id").value;
  var e = document.getElementById("customer");
  var customer_id = e.options[e.selectedIndex].value;
  var product_id=document.getElementById("product_id").value;
  alert(order_id+" "+customer_id+" "+product_id);
  parent.window.document.getElementById("work_space").src = "./product_add.php?order_id="+order_id+"&customer_id="+customer_id+"&product_id="+product_id;
}


function navi_loaded(evt){
  var length = parent.window.document.getElementById("navibar").contentWindow.document.body.innerHTML.length;
  if(length < 300){
    document.getElementById("add_product").disabled = false;
  }
  else {
    document.getElementById("add_product").disabled = true;
  }

}



function customer_add(evt){
  evt.preventDefault();
  var selected = document.getElementById("customer_add").selected;
  if(selected) {
    var order_id=document.getElementById("order_id").value;
    parent.window.document.getElementById("work_space").src = "./customer_add.php?order_id="+order_id;
  }

}


function find_product(e) {
  var code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) { //Enter keycode
    e.preventDefault();
  }
  else{
    var phrase = document.getElementById("product_id").value;
    parent.window.document.getElementById("navibar").src = "./get_products.php?phrase="+phrase;
  }

};

function calendar_show(evt){
  var destination = '#'+this.id;
  const picker = datepicker(document.querySelector(destination), {
    position: 'tl',
    startDate: new Date(),
    noWeekends: true,
    formatter: function(el, date) {
      // This will display the date as `1/1/2017`.
      el.value = formatDate(date);
    },
    customMonths: ['Tammi', 'Helmi', 'Maalis', 'Huhti', 'Touko', 'Kesä', 'Heinä', 'Elo', 'Syys', 'Loka', 'Marras', 'Joulu'],
    customDays: ['Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La']

  });


}

function formatDate(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return [year, month, day].join('-');
}

function order_check(evt) {
  evt.preventDefault();
  var a=document.getElementById("order_id").value;
  var b=document.getElementById("product_id").value;
  var c=document.getElementById("amount").value;
  var d=document.getElementById("date_wanted").value;
  var e=document.getElementById("date_ordered").value;
  var f = document.getElementById("customer");
  var g = f.options[f.selectedIndex].value;
  if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="",e==null || e=="")
  {
    document.getElementById("warning").textContent="Täytä Kaikki kentät!";
  }
  else {
    document.getElementById("warning").textContent="";
    order_add(a,b,c,d,e,g);
    document.getElementById("order_listed").src = "./order.php?order_id="+a;
  }
}

function order_add(a,b,c,d,e,g){
  $.ajax( {
    type:'POST',
    url:"order_add_row.php",
    data: { order_id:a, product_id:b, amount:c, date_wanted:d, date_ordered:e, customer:g }
  } )
    .success (function() { document.getElementById("order_listed").src = "./order.php?order_id="+a;
	window.parent.document.getElementById("orderbar").src = "./get_orders.php";
	})
    .error   (function()     { alert("Error")   ; });
  //.complete(function()     { alert("complete"); })
};


function order_list(evt){
  document.getElementById("order_listed").src = "./order.php?order_id="+this.value;
}

function set_customer(evt){
 
 var customer_id = document.getElementById('order_listed').contentWindow.document.getElementById('customer_id').innerHTML;
 if(customer_id){
   var customer_int = parseInt(customer_id);
   //alert(customer_int);
   document.getElementById("product_id").focus();
   document.getElementById('customer').value = customer_int;
   }

}
