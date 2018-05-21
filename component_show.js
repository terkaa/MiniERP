window.onload = function() {
	document.getElementById("to_part").addEventListener('click', to_part, false); 
	
};


function to_part(evt){
	evt.preventDefault();
	var id = parent.window.parent.window.document.getElementById("product_id").innerHTML;
	parent.window.parent.window.document.getElementById("actionwindow1").src = "./exploded_list.php?id="+id;
}



