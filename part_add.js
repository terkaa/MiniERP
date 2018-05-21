window.onload = function() {
	document.getElementById("type").addEventListener('change', type_search, false); 
	
};


function type_search(evt){


	var e = document.getElementById("type");
        var main_type = e.options[e.selectedIndex].value;
	var id = document.getElementById("id").value;
	//alert(id+" "+main_type);
	document.getElementById("parts_listed").src = "./get_parts.php?id="+id+"&main_type="+main_type;

}



