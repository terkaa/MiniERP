window.onload = function() {
	document.getElementById("supplier").addEventListener('change', supplier_add, false);
	document.getElementById("select_supplier").addEventListener('click', supplier_select, false);
};

$( document ).ready(function() {
   //alert("muu");
   
   
});



function supplier_add(evt){
	evt.preventDefault(); 
        var selected = document.getElementById("supplier_add").selected;
	if(selected) {
	var id = document.getElementById("id_code").value;
	var main_type = document.getElementById("main_type").value;
	var part_id = document.getElementById("part_id").value;
	parent.window.parent.window.document.getElementById("actionwindow1").src = "./supplier_add.php?id="+id+"&main_type="+main_type+"&part_id="+part_id;
	}
}


function supplier_select(evt){
	evt.preventDefault(); 
        var e = document.getElementById("supplier");
        var supplier = e.options[e.selectedIndex].value;
	var id = document.getElementById("id_code").value;
	var main_type = document.getElementById("main_type").value;
	var part_id = document.getElementById("part_id").value;
	//alert("su: "+supplier+" id: "+id+" mt: "+main_type+" pid: "+part_id); 
	component_add(supplier,id,main_type,part_id);
	}

function component_add(a,b,c,d){
	 $.ajax( {
    		type:'POST',
   		url:"part_add_row.php",
    		data: { supplier:a, id_code:b, main_type:c, part_id:d }
  		 } )
    		.success (function(data) { added_part(data);})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })
    };

function added_part(data){

	document.getElementById("component_listed").src = "./component_show.php?key_id="+data;
}
