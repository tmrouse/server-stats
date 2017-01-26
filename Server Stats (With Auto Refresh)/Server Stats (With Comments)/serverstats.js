$(document).ready(function() {


  //------------------------------------------------
  //- Function to get the data form the json file  -
  //------------------------------------------------
  //The function below gets the data from the stats_json.php file allowing you to choose where you want each tis to go on your page
  //By default all data that is useful to be on auto refresh is in here if you do not want something you can delete it by just removeing
  //the var for it and the relavent $("").html(nameofvar); parts.
  //Dont forget to switch out the elemetnts where you want your data to be shown
  //
function getdata(){

//Make sure the server address below maches where your stats_json.php file is. Below is just as example:
$.get( "https://server.tomrouse.me/inc/stats_json.php", function( data ) {

  var obj = jQuery.parseJSON( data );

  var cpuusage = obj.cpuusage;

  var usedram = obj.usedram;
  var freeram = obj.freeram;
  var usedram2 = obj.usedram2;

  var diskfreespace = obj.diskfreespace;
  var diskusedspace = obj.diskusedspace;
  var diskusedspace2 = obj.diskusedspace2;

  var uptimedays = obj.uptimedays;
  var uptimehours = obj.uptimehours;
  var uptimemins = obj.uptimemins;
  var uptimesecs = obj.uptimesecs;
  
//make sure to change these so that they are shown where you want them:
  $(".result0").html(cpuusage);

  $(".result1").html(usedram);
  $(".result2").html(freeram);
  $(".result3").html(usedram2);

  $(".result4").html(diskfreespace);
  $(".result5").html(diskusedspace);
  $(".result6").html(diskusedspace2);

  $(".result7").html(uptimedays);
  $(".result8").html(uptimehours);
  $(".result9").html(uptimemins);
  $(".result10").html(uptimesecs);

});
}

//To change the ammount of time between each reload please use function below [], 2000);] its in miliseconds so 2000 is every 2 seconds be default
//Change this to what ever you want:
setInterval(getdata, 2000);

});
