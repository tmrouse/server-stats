<?php
/*
-----------------------------------------------------------------------------
--          Statsy - A PHP tool to get stats about your server             --
-----------------------------------------------------------------------------
--                                                                         --
--  Auther: Tom Rouse                                                      --
--                                                                         --
--  Licence: MIT                                                           --
--                                                                         --
--  Github/Docs: https://github.com/Tms157/Statsy                          --
--                                                                         --
--  Description: Easy to use php tool for getting                          --
--  information about your server.                                         --
--                                                                         --
--                                                                         --
-----------------------------------------------------------------------------


Available Stats:

-- Random Stats --

 - Ip: get_ip()
 - Uptime: uptime($args)

 -- Memory Stats --

 - Total Mem: get_total_mem($args)
 - Available Mem: get_available_mem($args)
 - Cached Mem: get_cached_mem($args)
 - Swap Mem: get_swap_mem($args)
 - Buffer Mem: get_buffer_mem($agrs)
 - Shmem: get_shmem_mem($args)
 - SReclaimable: get_sreclaimable_mem($args)
 - SUnreclaim: get_sunreclaim_mem($args)
 - Free Mem: get_free_mem($args)
 - Real Free Mem: get_realfree_mem($args)
 - Used Mem: get_used_mem($args)
 - Used Mem %: get_used_mem2()

 -- CPU --

 - CPU Model: get_cpuinfo(model)
 - CPU Cores: get_cpuinfo(cores)
 - CPU Clock Speed: get_cpuinfo(speed)
 - CPU Cache: get_cpuinfo(cache)
 - Get CPU Load as %: get_cpu_load()

 -- Disk --

- Get Total disk space: get_disk_total($arg)
- Get Free Disk Space: get_disk_free($arg)
- Get Used Disk: get_disk_used($arg)
- Get Used Disk as %: get_disk_used2()

 -- Tools --
 - Round up: round_up()
 - Conversion: convert($input, $conversion)

 You can also use the array to call in the stats see docs for more information.

*/


//-------------------------------------------
//-    Function for getting the server IP   -
//-------------------------------------------
function get_ip() {
  $ip =  $_SERVER['SERVER_ADDR'];
  return $ip;
}


//-------------------------------------------
//-           Function for uptime           -
//-------------------------------------------
function get_uptime($arg) {

  $str   = @file_get_contents('/proc/uptime');
  $num   = floatval($str);

  $secs  = fmod($num, 60); $num = intdiv($num, 60);
  $mins  = $num % 60;      $num = intdiv($num, 60);
  $hours = $num % 24;      $num = intdiv($num, 24);
  $days  = $num;

  if ($arg == 'secs') {
    return $days . "&nbsp" . "Days" . "&nbsp" .$hours . "&nbsp" . "Hours" . "&nbsp" . $mins . "&nbsp" . "Mins" . "&nbsp" . round_up($secs, 0) . "&nbsp" . "Secs" . "&nbsp";
  }

  else if ($arg == 'mins') {
    return $days . "&nbsp" . "Days" . "&nbsp" .$hours . "&nbsp" . "Hours" . "&nbsp" . $mins . "&nbsp" . "Mins" . "&nbsp";
  }

  else if ($arg == 'hours') {
    return $days . "&nbsp" . "Days" . "&nbsp" .$hours . "&nbsp" . "Hours" . "&nbsp";
  }

  else if ($arg == 'days') {
    return $days . "&nbsp" . "Days" . "&nbsp";
  }

}

//--------------------------------------------
//-        Function to get total mem         -
//--------------------------------------------
function get_total_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $memtotal = $file_line[0];
  $memtotal = filter_var($memtotal, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$memtotal;
  }
  else if ($args == 'mb') {
    $memtotal_mb = convert($memtotal, 'mb');
    return $memtotal_mb;
  }
  else if ($args == 'gb') {
    $memtotal_gb = convert($memtotal, 'gb');
    return $memtotal_gb;
  }

}

//--------------------------------------------
//-      Function to get Mem Available       -
//--------------------------------------------
function get_available_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $memavailable = $file_line[2];
  $memavailable = filter_var($memavailable, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$memavailable;
  }
  else if ($args == 'mb') {
    $memavailable_mb = convert($memavailable, 'mb');
    return $memavailable_mb;
  }
  else if ($args == 'gb') {
    $memavailable_gb = convert($memavailable, 'gb');
    return $memavailable_gb;
  }

}


//--------------------------------------------
//-        Function to get Cached Mem        -
//--------------------------------------------
function get_cached_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $memcached = $file_line[4];
  $memcached = filter_var($memcached, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$memcached;
  }
  else if ($args == 'mb') {
    $memcached_mb = convert($memcached, 'mb');
    return $memcached_mb;
  }
  else if ($args == 'gb') {
    $memcached_gb = convert($memcached, 'gb');
    return $memcached_gb;
  }

}


//--------------------------------------------
//-         Function to get Swap Mem        -
//--------------------------------------------
function get_swap_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $memswap = $file_line[14];
  $memswap = filter_var($memswap, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$memswap;
  }
  else if ($args == 'mb') {
    $memswap_mb = convert($memswap, 'mb');
    return $memswap_mb;
  }
  else if ($args == 'gb') {
    $memswap_gb = convert($memswap, 'gb');
    return $memswap_gb;
  }

}


//--------------------------------------------
//-        Function to get Buffer Mem        -
//--------------------------------------------
function get_buffer_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $membuffer = $file_line[3];
  $membuffer = filter_var($membuffer, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$membuffer;
  }
  else if ($args == 'mb') {
    $membuffer_mb = convert($membuffer, 'mb');
    return $membuffer_mb;
  }
  else if ($args == 'gb') {
    $membuffer_gb = convert($membuffer, 'gb');
    return $membuffer_gb;
  }

}


//--------------------------------------------
//-      Function to get Shmem Mem     -
//--------------------------------------------
function get_shmem_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $shmem = $file_line[20];
  $shmem = filter_var($shmem, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$shmem;
  }
  else if ($args == 'mb') {
    $shmem_mb = convert($shmem, 'mb');
    return $shmem_mb;
  }
  else if ($args == 'gb') {
    $shmem_gb = convert($shmem, 'gb');
    return $shmem_gb;
  }

}

//--------------------------------------------
//-     Function to get SReclaimable Mem     -
//--------------------------------------------
function get_sreclaimable_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $sreclaimable = $file_line[22];
  $sreclaimable = filter_var($sreclaimable, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$sreclaimable;
  }
  else if ($args == 'mb') {
    $sreclaimable_mb = convert($sreclaimable, 'mb');
    return $sreclaimable_mb;
  }
  else if ($args == 'gb') {
    $sreclaimable_gb = convert($sreclaimable, 'gb');
    return $sreclaimable_gb;
  }

}

//--------------------------------------------
//-      Function to get SUnreclaim Mem     -
//--------------------------------------------
function get_sunreclaim_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $sunreclaim = $file_line[23];
  $sunreclaim = filter_var($sunreclaim, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return (int)$sunreclaim;
  }
  else if ($args == 'mb') {
    $sunreclaim_mb = convert($sunreclaim, 'mb');
    return $sunreclaim_mb;
  }
  else if ($args == 'gb') {
    $sunreclaim_gb = convert($sunreclaim, 'gb');
    return $sunreclaim_gb;
  }

}

//--------------------------------------------
//-         Function to get Free Mem         -
//--------------------------------------------
// From the meminfo file
function get_free_mem($args) {

  $file = file('/proc/meminfo');
  $file_line = array();

  $file_line = $file;

  $memfree = $file_line[1];
  $memfree = filter_var($memfree, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);

  if ($args == 'kb') {
    return  (int)$memfree;
  }
  else if ($args == 'mb') {
    $memfree_mb = convert($memfree, 'mb');
    return $memfree_mb;
  }
  else if ($args == 'gb') {
    $memfree_gb = convert($memfree, 'gb');
    return $memfree_gb;
  }

}


//--------------------------------------------
//-         Function to get Used Mem         -
//--------------------------------------------
// Formular = MemTotal - MemFree - Buffers - Cached - SReclaimable - Shmem
function get_used_mem($args) {

  $totalmem = get_total_mem('kb');
  $freemem = get_free_mem('kb');
  $buffers = get_buffer_mem('kb');
  $cachedmem = get_cached_mem('kb');
  $sreclaimable = get_sreclaimable_mem('kb');
  $shmem = get_shmem_mem('kb');

  $usedmem = $totalmem - $freemem - $buffers - $cachedmem - $sreclaimable + $shmem;

  if ($args == 'kb') {
    return (int)$usedmem;
  }
  else if ($args == 'mb') {
    $usedmem_mb = convert($usedmem, 'mb');
    return $usedmem_mb;
  }
  else if ($args == 'gb') {
    $usedmem_gb = convert($usedmem, 'gb');
    return $usedmem_gb;
  }

}


//--------------------------------------------
//-      Function to get real Free Mem       -
//--------------------------------------------
function get_realfree_mem($args) {

  $totalmem = get_total_mem('kb');
  $usedmem = get_used_mem('kb');

  $realfreemem = $totalmem - $usedmem;

  if ($args == 'kb') {
    return (int)$realfreemem;
  }
  else if ($args == 'mb') {
    $realfreemem_mb = convert($realfreemem, 'mb');
    return $realfreemem_mb;
  }
  else if ($args == 'gb') {
    $realfreemem_gb = convert($realfreemem, 'gb');
    return $realfreemem_gb;
  }

}

//-------------------------------------------
//-        Function Used Ram Space (%)      -
//-------------------------------------------
function get_used_mem2() {

  $getused = get_used_mem('kb') / get_total_mem('kb');
  $sum = $getused * 100;
  $sum2 = round_up($sum, 2);

  return $sum2;

}


//-------------------------------------------
//-      Function for CPU information       -
//-------------------------------------------
//Function to get different data about cpu
function get_cpuinfo($arg) {

  //'model' This gives you the model of the CPU
  if ($arg == 'model') {
    $file = file('/proc/cpuinfo');
    $cpu_model_line = $file[4];
    $cpumodel = strtr ($cpu_model_line, array ('model name	: ' => ''));

    return $cpumodel;
  }

  //'cores' This gives you the amount of cores on the cpu
  else if ($arg == 'cores') {
    $file = file('/proc/cpuinfo');
    $cpu_cores_line = $file[12];
    $cpucores = strtr ($cpu_cores_line, array ('cpu cores	: ' => ''));

    return (int)$cpucores;
  }

  //'speed' This gives you the clock speed of the cpu
  else if ($arg == 'speed') {
    $file = file('/proc/cpuinfo');
    $cpu_speed_line = $file[7];
    $cpuspeed = strtr ($cpu_speed_line, array ('cpu MHz		: ' => ''));
    $cpuspeed_rounded = round_up($cpuspeed, 2);

    return $cpuspeed_rounded;
  }

  //'cache' This gives you amount of cache the cpu has
  else if ($arg == 'cache') {
    $file = file('/proc/cpuinfo');
    $cpu_cache_line = $file[8];
    $cpucache = strtr ($cpu_cache_line, array ('cache size	: ' => ''));

    return $cpucache;
  }

}

//-------------------------------------------
//-    Function for CPU Being Used As %     -
//-------------------------------------------
function get_cpu_load(){

    $load = sys_getloadavg();
    return $load[0];

}

//-------------------------------------------
//-        Function Total Disk Space        -
//-------------------------------------------
function get_disk_total($arg) {

  $kb = disk_total_space("/");
  $mb = convert($kb, 'mb');
  $gb = convert($mb, 'gb');

  if ($arg == 'kb') {
    return (int)$kb;
  }
  else if ($arg == 'mb') {
    return $mb;
  }
  else if ($arg == 'gb') {
    return $gb;
  }

}


//-------------------------------------------
//-        Function Disk Free Space        -
//-------------------------------------------
function get_disk_free($arg) {

  $kb = disk_free_space("/");
  $mb = convert($kb, 'mb');
  $gb = convert($mb, 'gb');

  if ($arg == 'kb') {
    return (int)$kb;
  }
  else if ($arg == 'mb') {
    return $mb;
  }
  else if ($arg == 'gb') {
    return $gb;
  }

}


//-------------------------------------------
//-         Function Used Disk Space        -
//-------------------------------------------
function get_disk_used($arg) {

  $total = get_disk_total('kb');
  $free = get_disk_free('kb');

  $kb = $total - $free;
  $mb = convert($kb, 'mb');
  $gb = convert($mb, 'gb');

  if ($arg == 'kb') {
    return (int)$kb;
  }
  else if ($arg == 'mb') {
    return $mb;
  }
  else if ($arg == 'gb') {
    return $gb;
  }

}


//-------------------------------------------
//-       Function Used Disk Space (%)      -
//-------------------------------------------
function get_disk_used2() {

  $getused = get_disk_used('kb') / get_disk_total('kb');
  $sum = $getused * 100;
  $sum2 = round_up($sum, 2);

  return (int)$sum2;

}


//-------------------------------------------
//-        Function for Rounding up         -
//-------------------------------------------
//Function to round numbers up
function round_up ( $value, $precision ) {
  $pow = pow ( 10, $precision );
  return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
}

//-------------------------------------------
//-        Function for Converting          -
//-------------------------------------------
//Function to convert to mb, gb
function convert($input, $conversion) {

  if ($conversion == 'mb') {
    $converted = $input / 1024;
    return round_up($converted, 2);
  }

  else if ($conversion == 'gb') {
    $converted = $input / 1024 / 1024;
    return round_up($converted, 2);
  }

}

//-------------------------------------------
//-  Function putting all stuff into array  -
//-------------------------------------------
function get() {

  //mem array
  $mem = array(
    'totalkb' => get_total_mem('kb'),
    'totalmb' => get_total_mem('mb'),
    'totalgb' => get_total_mem('gb'),

    'availablekb' =>  get_available_mem('kb'),
    'availablemb' =>  get_available_mem('mb'),
    'availablegb' =>  get_available_mem('gb'),

    'cachedkb' => get_cached_mem('kb'),
    'cachedmb' => get_cached_mem('mb'),
    'cachedgb' => get_cached_mem('gb'),

    'swapkb' => get_swap_mem('kb'),
    'swapmb' => get_swap_mem('mb'),
    'swapgb' => get_swap_mem('gb'),

    'bufferkb' => get_buffer_mem('kb'),
    'buffermb' => get_buffer_mem('mb'),
    'buffergb' => get_buffer_mem('gb'),

    'shmemkb' => get_shmem_mem('kb'),
    'shmemmb' => get_shmem_mem('mb'),
    'shmemgb' => get_shmem_mem('gb'),

    'sreclaimablekb' => get_sreclaimable_mem('kb'),
    'sreclaimablemb' => get_sreclaimable_mem('mb'),
    'sreclaimablegb' => get_sreclaimable_mem('gb'),

    'sunreclaimkb' => get_sunreclaim_mem('kb'),
    'sunreclaimmb' => get_sunreclaim_mem('mb'),
    'sunreclaimgb' => get_sunreclaim_mem('gb'),

    'freekb' => get_free_mem('kb'),
    'freemb' => get_free_mem('mb'),
    'freegb' => get_free_mem('gb'),

    'realfreekb' => get_realfree_mem('kb'),
    'realfreemb' => get_realfree_mem('mb'),
    'realfreegb' => get_realfree_mem('gb'),

    'usedkb' => get_used_mem('kb'),
    'usedmb' => get_used_mem('mb'),
    'usedgb' => get_used_mem('gb'),

    'percent' => get_used_mem2()

  );

  //disk array
  $disk = array(
    'totalkb' => get_disk_total('kb'),
    'totalmb' => get_disk_total('mb'),
    'totalgb' => get_disk_total('gb'),

    'freekb' => get_disk_free('kb'),
    'freemb' => get_disk_free('mb'),
    'freegb' => get_disk_free('gb'),

    'usedkb' => get_disk_used('kb'),
    'usedmb' => get_disk_used('mb'),
    'usedgb' => get_disk_used('gb'),

    'percent' => get_disk_used2()

  );

  //cpu array
  $cpu = array(
    'model' =>  get_cpuinfo('model'),
    'cores' => get_cpuinfo('cores'),
    'clock' => get_cpuinfo('speed'),
    'cache' => get_cpuinfo('cache'),
    'load' => get_cpu_load()
  );

  //uptime array
  $uptime = array(
    'days' => get_uptime('days'),
    'hours' => get_uptime('hours'),
    'mins' => get_uptime('mins'),
    'secs' => get_uptime('secs')
  );

  //ip array
  $ip = array(
    'ip' => get_ip()
  );

  $array = array(
    'mem' => $mem,
    'disk' => $disk,
    'cpu' => $cpu,
    'uptime' => $uptime,
    'ip' => $ip,
  );

  return $array;

}
