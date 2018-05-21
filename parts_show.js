window.onload = function() {
	document.getElementById("add_part").addEventListener('click', add_part, false); 
	
};

$( document ).ready(function() {
	part_list_elements = document.getElementsByClassName('part_link');
    	for(var i = 0; i < part_list_elements.length; i++){
	part_list_elements[i].addEventListener('click', select_part, false);
	}

});


function add_part(evt){
        //alert("muu");
	evt.preventDefault();
	var e = parent.window.document.getElementById("type");
        var main_type = e.options[e.selectedIndex].value;
	var id = parent.window.document.getElementById("id").value;
	//alert(id+" "+main_type);
	parent.window.parent.window.document.getElementById("actionwindow1").src = "./part_add_new.php?id="+id+"&main_type="+main_type;

}

function select_part(evt){
	evt.preventDefault();
	var part_id = this.name;
	var id = parent.window.document.getElementById("id").value;
	var e = parent.window.document.getElementById("type");
        var main_type = e.options[e.selectedIndex].value;
	parent.window.parent.window.document.getElementById("actionwindow1").src = "./supplier_select.php?id="+id+"&main_type="+main_type+"&part_id="+part_id;
	

}



