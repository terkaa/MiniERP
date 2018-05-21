window.onload = function() {
  document.getElementById('back').addEventListener('click', go_back, false);
   };

function go_back(evt){
	evt.preventDefault();
        var product_id = document.getElementById('product_id').value;
	window.parent.document.getElementById('actionwindow1').src = "./exploded_list.php?id="+product_id;  
}

