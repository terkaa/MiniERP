var work_elements = [];

$(document).ready(function () {

	var date_elements = [];
        var machine_elements = [];
        
        
        work_elements = document.getElementsByClassName('work_selection');
	date_elements = document.getElementsByClassName('day');
        var machines = 4;

        for(var i = 0; i < date_elements.length; i++){
          var machine_no = document.getElementById('machine_no'+i).value;
	  get_work(date_elements[i].value,machine_no,i);  
}

 var content_height = $(".actionwindow-content").height() + 50;
  $("#actionwindow5", parent.window.document).css("height", content_height);
 

//Dragia

$('.event').on("dragstart", function (event) {
        var dt = event.originalEvent.dataTransfer;
        dt.setData('Text', $(this).attr('id'));
    });
    $('table td').on("dragenter dragover drop", function (event) {
        event.preventDefault();
        if (event.type === 'drop') {
            var destination = this.id.substring(14);
	    var date = $("#day"+destination).val();
	    var machine_no = $("#machine_no"+destination).val();
            var source_cell_no = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id')).substring(7);
	    var key = document.getElementById('work_id'+source_cell_no).innerHTML;
            var source_machine_no = $("#machine_no"+source_cell_no).val();
            var source_date = $("#day"+source_cell_no).val();
                        
            de = $('#').detach();
            if (event.originalEvent.target.tagName === "SPAN") {
                 de.insertBefore($(event.originalEvent.target));
            }
            else {
		var tausta  = $(this).attr('bgcolor');
		if(tausta != 'pink'){
                de.appendTo($(this));
		drag_work(key,machine_no,date,destination,source_cell_no,source_machine_no,source_date);}
		else{
		   alert('varattu');}
	            }
        };
    });
				
	
})

function get_work(date,machine,cell) {    
    var id = document.getElementById('id_code').innerHTML;
    $.ajax( {
    type:'POST',
    url:"work_get.php",
    data: { 'date':date,'machine':machine,'id':id }
    })
    .success (function(data) {insert_data(data,cell);})
    .error   (function()     { alert("Error")   ; })
    .complete(function()     {})
    };


function insert_data(data,cell) {
	var jsonData = JSON.parse(data);
        if(jsonData.processes[0].key != 0){
		document.getElementById('work_loaded_id'+cell).style.backgroundColor = "pink";
		}
        else{
		document.getElementById('work_loaded_id'+cell).style.backgroundColor = "lightgreen";
		document.getElementById('work_id'+cell).innerHTML = '';
		}
        for(var i = 0; i < jsonData.processes.length; i++){
        	//alert(jsonData.processes[0].full_id);
		var opt = document.createElement('option');
		opt.value = jsonData.processes[i].key;
    		opt.innerHTML = jsonData.processes[i].full_id+' '+jsonData.processes[i].description;
    		work_elements[cell].appendChild(opt); 
		work_elements[cell].addEventListener('change', work_change, false);
		if ('work_id' in jsonData.processes[i]){ 
			document.getElementById('work_id'+cell).innerHTML = jsonData.processes[i].work_id;}

}
}

function delete_data(date,machine_no,cell_no){
	var obj = work_elements[cell_no];   
	if (obj == null) return;
	if (obj.options == null) return;
	obj.options.length = 0;	 
        get_work(date,machine_no,cell_no)

}

function work_change(evt) {
    var machine_no = document.getElementById('machine_no'+this.id).value;
    var date = document.getElementById('day'+this.id).value;
    var cell_no = this.id;
    var key = document.getElementById('work_id'+this.id).innerHTML;
    if(document.getElementById('work_id'+this.id).innerHTML != ''){
	if(this.value == 0){
    	$.ajax( {
    	type:'POST',
    	url:"./work_delete.php",
    	data: { key:key}
    	})
    	.success (function(data) {delete_data(date,machine_no,cell_no)})
    	.error   (function(data)     { })
    	.complete(function(data)     { })
	}
	else{
	$.ajax( {
   	type:'POST',
    	url:"./work_change.php",
    	data: { key:key,work_id:this.value}
    	})
   	.success (function(data) {delete_data(date,machine_no,cell_no)})
    	.error   (function(data)     { })
    	.complete(function(data)     { })
}
    		
}
    else{
  	$.ajax( {
 	type:'POST',
  	url:"./work_add.php",
  	data: { work_id:this.value,date:date,machine:machine_no}
  	})
  	.success (function(data) {delete_data(date,machine_no,cell_no)})
  	.error   (function(data)     {alert("error"); })
  	.complete(function(data)     { })
	}
    
}

function drag_work(key,machine_no,date,destination_cell_no,source_cell_no,source_machine_no,source_date){
	$.ajax( {
   	type:'POST',
    	url:"./work_drag.php",
    	data: { key:key,machine:machine_no,date:date}
    	})
   	.success (function(data) {delete_data(date,machine_no,destination_cell_no),delete_data(source_date,source_machine_no,source_cell_no)})
    	.error   (function(data)     { })
    	.complete(function(data)     { })
}




