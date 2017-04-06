$(document).ready(function() {

//--------------------------------------------------------
//-    Location of stats_json file (url or directory)    -
//--------------------------------------------------------
var stats_json_url = "https://www.examplesite.com/statsy-auto/stats_json.php";
//--------------------------------------------------------

//--------------------------------------------------------
//-      Delay Between Each Refresh (milisecsonds)       -
//--------------------------------------------------------
var auto_refresh_delay = 2000;
//--------------------------------------------------------

//--------------------------------------------------------
//-  Location of each stat on the page (Set class or id) -
//--------------------------------------------------------
//Mem
var total_mem_loc = ".enter-class-or-id";
var available_mem_loc = ".enter-class-or-id";
var cached_mem_loc = ".enter-class-or-id";
var swap_mem_loc = ".enter-class-or-id";
var buffer_mem_loc = ".enter-class-or-id";
var shmem_mem_loc = ".enter-class-or-id";
var sreclaimable_mem_loc = ".enter-class-or-id";
var sunreclaim_mem_loc = ".enter-class-or-id";
var free_mem_loc = ".enter-class-or-id";
var realfree_mem_loc = ".enter-class-or-id";
var used_mem_loc = ".enter-class-or-id";
var percent_mem_loc = ".enter-class-or-id"
//Disk
var total_disk_loc = ".enter-class-or-id";
var free_disk_loc = ".enter-class-or-id";
var used_disk_loc = ".enter-class-or-id";
var percent_disk_loc = ".enter-class-or-id";
//CPU
var cpu_model_loc = ".enter-class-or-id";
var cpu_cores_loc = ".enter-class-or-id";
var cpu_clock_loc = ".enter-class-or-id";
var cpu_cache_loc = ".enter-class-or-id";
var cpu_load_loc = ".enter-class-or-id";
//Uptime
var uptime_days_loc = ".enter-class-or-id";
var uptime_hours_loc = ".enter-class-or-id";
var uptime_mins_loc = ".enter-class-or-id";
var uptime_secs_loc = ".enter-class-or-id";
//IP
var ip_loc = ".enter-class-or-id";
//--------------------------------------------------------


//--------------------------------------------------------
//-    No need to config anything else in this file!     -
//--------------------------------------------------------

function get_autodata(){

$.get( stats_json_url, function(data) {

  var obj = jQuery.parseJSON(data);

  //Memeroy
  var total_mem = obj.mem.total;
  var available_mem = obj.mem.available;
  var cached_mem = obj.mem.cached;
  var swap_mem = obj.mem.swap;
  var buffer_mem = obj.mem.buffer;
  var shmem_mem = obj.mem.shmem;
  var sreclaimable_mem = obj.mem.sreclaimable;
  var sunreclaim_mem = obj.mem.sunreclaim;
  var free_mem = obj.mem.free;
  var realfree_mem = obj.mem.realfree;
  var used_mem = obj.mem.used;
  var percent_mem = obj.mem.percent;

  //Disk
  var total_disk = obj.disk.total;
  var free_disk = obj.disk.free;
  var used_disk = obj.disk.used;
  var percent_disk = obj.disk.percent;

  //Cpu
  var cpu_load = obj.cpu.load;

  //Uptime
  var uptime_days = obj.uptime.days;
  var uptime_hours = obj.uptime.hours;
  var uptime_mins = obj.uptime.mins;
  var uptime_secs = obj.uptime.secs;


  $(total_mem_loc).html(total_mem);
  $(available_mem_loc).html(available_mem);
  $(cached_mem_loc).html(cached_mem);
  $(swap_mem_loc).html(swap_mem);
  $(buffer_mem_loc).html(buffer_mem);
  $(shmem_mem_loc).html(shmem_mem);
  $(sreclaimable_mem_loc).html(sreclaimable_mem);
  $(sunreclaim_mem_loc).html(sunreclaim_mem);
  $(free_mem_loc).html(free_mem);
  $(realfree_mem_loc).html(realfree_mem);
  $(used_mem_loc).html(used_mem);
  $(total_mem_loc).html(total_mem);
  $(percent_mem_loc).html(percent_mem);

  $(total_disk_loc).html(total_disk);
  $(free_disk_loc).html(free_disk);
  $(used_disk_loc).html(used_disk);
  $(percent_disk_loc).html(percent_disk);

  $(cpu_load_loc).html(cpu_load);

  $(uptime_days_loc).html(uptime_days);
  $(uptime_hours_loc).html(uptime_hours);
  $(uptime_mins_loc).html(uptime_mins);
  $(uptime_secs_loc).html(uptime_secs);

});

}

function get_data(){

$.get( stats_json_url, function(data) {

  var obj = jQuery.parseJSON(data);

  //IP
  var ip = obj.ip.ip;

  //Cpu
  var cpu_model = obj.cpu.model;
  var cpu_cores = obj.cpu.cores;
  var cpu_clock = obj.cpu.clock;
  var cpu_cache = obj.cpu.cache;

  $(ip_loc).html(ip);

  $(cpu_model_loc).html(cpu_model);
  $(cpu_cores_loc).html(cpu_cores);
  $(cpu_clock_loc).html(cpu_clock);
  $(cpu_cache_loc).html(cpu_cache);

});

}

//Sets time between auto refresh
setInterval(get_autodata, auto_refresh_delay);
get_data();


});
