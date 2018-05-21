window.onload = function() {
 
};

$( document ).ready(function() {
   //alert("muu");
   document.getElementById("submit_customer").addEventListener('click', details_check, false);
   document.getElementById("order_continue").addEventListener('click', order_continue, false);
   order_id=document.getElementById("order_id").value;
});


function details_check(evt) {
	evt.preventDefault();
	var a=document.getElementById("c_name").value;
	var b=document.getElementById("c_address").value;
        var c=document.getElementById("c_postcode").value;
        var d=document.getElementById("c_city").value;
	var e=document.getElementById("c_vat").value;
	var f=document.getElementById("c_contact").value;
        var g=document.getElementById("c_email").value;
        var h=document.getElementById("c_delivery_way").value;
 	var i=document.getElementById("c_delivery_custno").value;

	if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="")
        {
            document.getElementById("warning").textContent="Täytä Kaikki (*) kentät!";
        }
	else {
		document.getElementById("warning").textContent="";
		customer_add(a,b,c,d,e,f,g,h,i);
	     }
}

function customer_add(a,b,c,d,e,f,g,h,i){
	 $.ajax( {
    		type:'POST',
   		url:"customer_add_row.php",
    		data: { c_name:a, c_address:b, c_postcode:c, c_city:d, c_vat:e, c_contact:f, c_email:g, c_delivery_way:h, c_delivery_custno:i }
  		 } )
    		.success (function(data) { added_customer(data);})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })
    };

function added_customer(data){

	document.getElementById("customer_details").src = "./customer_show.php?customer_id="+data;
	if(order_id != null) {
		$('#div-continue').show();
	}
}

function order_continue(){

	parent.window.document.getElementById("work_space").src = "./order_add.php?order_id="+order_id;
}

