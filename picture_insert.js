window.onload = function() {
  document.getElementById('back').addEventListener('click', go_back, false);
   };

function go_back(evt){
	evt.preventDefault();
        var product_id = document.getElementById('product_id').value;
	window.parent.document.getElementById('work_space').src = "./picture.php?id="+product_id;  
}

