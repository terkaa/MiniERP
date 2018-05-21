window.onload = function() {

	delete_elements = document.getElementsByClassName('delete');
	name_elements = document.getElementsByClassName('name');
	for(var i = 0; i < delete_elements.length; i++){
		delete_elements[i].addEventListener('click', delete_stamps, false);
	}
	for(var i = 0; i < name_elements.length; i++){
		name_elements[i].addEventListener('change', change_name, false);
	}
	

};


function change_name(evt) {
	evt.preventDefault();
	var key = this.name;
        var name= this.value;    
	$.ajax( {
    		type:'POST',
   		url:"./clockcard_change_name.php",
    		data: { key:key, name:name }
  		 } )
    		.success (function() {location.reload();})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })    
}


function delete_stamps(evt) {
	 evt.preventDefault();
	var key = this.name;	
	$.ajax( {
    		type:'POST',
   		url:"./clockcard_stamps_delete.php",
    		data: { key:key }
  		 } )
    		.success (function() {alert("poistettu");})
    		.error   (function()     { alert("Error")   ; })
    		//.complete(function()     { alert("complete"); })
}   



