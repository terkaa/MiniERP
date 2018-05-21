var supplier_id = 0;
$( document ).ready(function() {
   //alert("muu");
   document.getElementById("submit_supplier").addEventListener('click', details_check, false);
   document.getElementById("component_add_continue").addEventListener('click', component_add_continue, false);
   //id=document.getElementById("id").value;
});


function details_check(evt) {
	evt.preventDefault();
	var a=document.getElementById("name").value;
	var b=document.getElementById("address").value;
        var c=document.getElementById("postcode").value;
        var d=document.getElementById("city").value;
	var e=document.getElementById("phone").value;
        var g=document.getElementById("email").value;
        var h=document.getElementById("delivery_way").value;
 	var i=document.getElementById("deliveryterm").value;
	var j=document.getElementById("paydays").value;

	if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="")
        {
            document.getElementById("warning").textContent="Täytä Kaikki (*) kentät!";
        }
	else {
		document.getElementById("warning").textContent="";
		supplier_add(a,b,c,d,e,g,h,i,j);
	     }
}

function supplier_add(a,b,c,d,e,g,h,i,j){
	 // alert(e);
	 $.ajax( {
    		type:'POST',
   		url:"supplier_add_row.php",
    		data: { name:a, address:b, postcode:c, city:d, phone_no:e, email:g, delivery_way:h, deliveryterm:i, paydays:j }
  		 } )
    		.success (function(data) { added_supplier(data);})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })
    };

function added_supplier(data){
	document.getElementById("supplier_details").src = "./supplier_show.php?supplier_id="+data;
	if(data != null) {
		supplier_id = data;		
		$('#div-continue').show();
	}
}

function component_add_continue(evt){

	var id = document.getElementById("id_code").value;
	var main_type = document.getElementById("main_type").value;
	var part_id = document.getElementById("part_id").value;
        $.ajax( {
    		type:'POST',
   		url:"part_add_row.php",
    		data: { supplier:supplier_id, id_code:id, main_type:main_type, part_id:part_id }
  		 } )
    		.success (function(data) { added_part(data);})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })
    };

function added_part(data){

	document.getElementById("supplier_details").src = "./component_show.php?key_id="+data;
}

