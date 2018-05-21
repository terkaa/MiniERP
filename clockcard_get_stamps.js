$( document ).ready(function() {
   document.getElementById("employee").addEventListener('change', employee_select, false);
   document.getElementById("admin_stamps").addEventListener('click', prevent_admin_open, false);
   document.getElementById("admin_stamps").addEventListener('dblclick', admin_open, false);

   var content_height = $(".actionwindow-content").height() + 500;
   $("#actionwindow6", parent.window.document).css("height", content_height);
});


function employee_select(evt){
	evt.preventDefault(); 
        var selected = document.getElementById("employee").value;
	if(selected) {
	document.getElementById("stamps_listed").src = "./clockcard_get_stamps_employee.php?employee="+selected;
		}

}

function prevent_admin_open(evt){
	evt.preventDefault();
}

function admin_open(evt){
	evt.preventDefault();
	window.location.assign("./clockcard_admin_stamps.php")

}
