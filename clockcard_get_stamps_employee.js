
$( document ).ready(function() {

    start_elements = document.getElementsByClassName('time-start');
    end_elements = document.getElementsByClassName('time-end');    
    time_diff_elements = document.getElementsByClassName('time-diff');
    weekday_elements = document.getElementsByClassName('weekdays');
    var total_time = 0;
    var days = ['SU','MA','TI','KE','TO','PE','LA'];

    for(var i = 0; i < end_elements.length; i++){
	var end_time = end_elements[i].innerText; 
	end_time = mysqlTimeStampToDate(end_time);
	var start_time = start_elements[i].innerText; 
	start_time = mysqlTimeStampToDate(start_time);
	var seconds = (end_time.getTime() - start_time.getTime()) / 1000;
        total_time = total_time + seconds;
	var timediff = secondsToHms(seconds);
//	alert(end_time);
	time_diff_elements[i].innerText = timediff;
	weekday_elements[i].innerText = start_time.getDate() + ' / ' + start_time.getMonth() + ' / ' + start_time.getFullYear() + ' ' + days[start_time.getDay()];
	end_elements[i].innerText = end_time.getHours() + ':' + end_time.getMinutes() + ':' + end_time.getSeconds();
	start_elements[i].innerText = start_time.getHours() + ':' + start_time.getMinutes() + ':' + start_time.getSeconds();

}
	document.getElementById('total_time').innerText =  secondsToHms(total_time);


});
        

  function mysqlTimeStampToDate(timestamp) {

    //function parses mysql datetime string and returns javascript Date object

    //input has to be in this format: 2007-06-05 15:26:02

    var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;

    var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');

    return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);

  }

function secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " tunti, " : " tuntia, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minuutti, " : " minuuttia, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " sekunti" : " sekuntia") : "";
    return hDisplay + mDisplay + sDisplay; 
}



