var part_id = 0;

window.onload = function() {
 $("#desc").bind("keyup", {}, find_part); 
};

$( document ).ready(function() {
	   document.getElementById("submit_component").addEventListener('click', check_component, false);
	   document.getElementById("part_add_continue").addEventListener('click', part_add_continue, false);
	   
   
});

function find_part(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) { //Enter keycode                        
        e.preventDefault();
       	}
    else{
	var phrase = document.getElementById("desc").value;
	//alert(phrase);
	document.getElementById("part_details").src = "./part_check.php?phrase="+phrase;	
    }
        
};

function check_component(evt){
	evt.preventDefault();
	var a=document.getElementById("desc").value;
	var b=document.getElementById("id_code").value;
        var c=document.getElementById("base_size").value;
        var d=document.getElementById("unit").value;
	var e=document.getElementById("price").value;
	if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="")
        {
            document.getElementById("warning").textContent="Täytä Kaikki (*) kentät!";
        }
	else {
		document.getElementById("warning").textContent="";
		component_add(a,b,c,d,e);
	     }	


}

function component_add(a,b,c,d,e){
	var id = document.getElementById("id_code").value;
	var main_type = document.getElementById("main_type").value;
	 $.ajax( {
    		type:'POST',
   		url:"component_add_row.php",
    		data: { desc:a, id_code:b, base_size:c, unit:d, price:e, main_type:main_type,part_id:id }
  		 } )
    		.success (function(data) { added_component(data);})
    		.error   (function(data)     { alert(data)   ; })
    		//.complete(function()     { alert("complete"); })
    };

function added_component(data){
	part_id = data;
	document.getElementById("part_details").src = "./component_show_row.php?key_id="+data;
	if(data != null) {
		$('#div-continue').show();
	}
}

function part_add_continue(evt){
	var id = document.getElementById("id").value;
	var main_type = document.getElementById("main_type").value;
//	alert("id="+id+"&main_type="+main_type+"&part_id="+part_id);
        parent.window.document.getElementById("actionwindow1").src = "./supplier_select.php?id="+id+"&main_type="+main_type+"&part_id="+part_id;
    };



