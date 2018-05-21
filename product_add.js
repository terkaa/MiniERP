window.onload = function() {
 
};

$( document ).ready(function() {
   //alert("muu");
   document.getElementById("submit_product").addEventListener('click', details_check, false);
   document.getElementById("order_continue").addEventListener('click', order_continue, false);
   order_id=document.getElementById("order_id").value;
   customer_id=document.getElementById("customer_id").value;
});


function details_check(evt) {
	evt.preventDefault();
	var a=document.getElementById("id_code").value;
	var b=document.getElementById("desc").value;
        var c=document.getElementById("weight").value;
        var d=document.getElementById("area").value;
	var e=document.getElementById("lot_size").value;
	var f=document.getElementById("price").value;
        
	if (a==null || a=="",b==null || b=="")
        {
            document.getElementById("warning").textContent="Täytä Kaikki (*) kentät!";
        }
	else {
		document.getElementById("warning").textContent="";
		product_add(a,b,c,d,e,f);
	     }
}

function product_add(a,b,c,d,e,f){
	 $.ajax( {
    		type:'POST',
   		url:"product_add_row.php",
    		data: { id_code:a, desc:b, weight:c, area:d, lot_size:e, price:f}
  		 } )
    		.success (function(data) { added_product(data);})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })
    };

function added_product(data){

	document.getElementById("product_details").src = "./product_show.php?product_id="+data;
	if(order_id != null) {
		$('#div-continue').show();
	}
}

function order_continue(){

	parent.window.document.getElementById("work_space").src = "./order_add.php?order_id="+order_id+"&customer_id="+customer_id;
}

