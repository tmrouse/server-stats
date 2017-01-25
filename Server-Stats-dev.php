<?php
//-----------------------------------------------------------------------------
//--                             PHP Server Stats                            --
//--  Auther: Tom Rouse                                                      --
//--                                                                         --
//--  Licence: MIT                                                           --
//--                                                                         --
//--  Description: Easy to use php tool for getting                          --
//--  information about your server.                                         --
//--                                                                         --
//-- What information can you get?                                           --
//--    - Uptime                                                             --
//--    - Total RAM (Ammount in kb, mb, gb)                                  --
//--    - Available RAM (Ammount in kb, mb, gb)                              --
//--    - Free RAM (Ammount in kb, mb, gb)                                   --
//--    - Used RAM (Ammount in kb, mb, gb or %)                              --
//--    - CPU Useage                                                         --
//--    - CPU Info (model, clock speed, cache ammount, cores)                --
//--    - Total Disk Space (Ammount in kb, mb, gb)                           --
//--    - Total Free Disk Space (Ammount in kb, mb, gb)                      --
//--    - Disk Space Used (Ammount in kb, mb, gb or %)                       --
//--                                                                         --
//-----------------------------------------------------------------------------


//-------------------------------------------
//-           Function for uptime           -
//-------------------------------------------
// - Server uptime -
//Please bare in mind all values are relative to each other
//if you use hours thats relative to days ect so it whont
//give total time in days e.g:
// echo get_uptime(days) . get_uptime(hours) . get_uptime(mins) . get_uptime(secs)
//The above line will give you: days hours mins secs output
//Useage:
//get_uptime(days) - This returns the uptime in days
//get_uptime(hours) - This returns the uptime in hours relative to days
//get_uptime(mins) - This returns the uptime in mins relative to hours
//get_uptime(secs) - This returns the uptime in seconds relative to mins
function get_uptime($arg) {

  $str   = @file_get_contents('/proc/uptime');
  $num   = floatval($str);

  $secs  = fmod($num, 60); $num = intdiv($num, 60);
  $mins  = $num % 60;      $num = intdiv($num, 60);
  $hours = $num % 24;      $num = intdiv($num, 24);
  $days  = $num;

  if ($arg == 'secs') {
    return $secs;
  }

  else if ($arg == 'mins') {
    return $mins;
  }

  else if ($arg == 'hours') {
    return $hours;
  }

  else if ($arg == 'days') {
    return $days;
  }

}

//-------------------------------------------
//-          Function For Total Ram         -
//-------------------------------------------
// - Total RAM on the server -
//This will return the total memery installed on the server
//Useage:
//get_totalram(kb) - Returns the total RAM in Kilo Bytes
//get_totalram(mb) - Returns the total RAM in Mega Bytes
//get_totalram(gb) - Returns the total RAM in Giga Bytes
function get_totalram($arg) {

  $fh = fopen('/proc/meminfo','r');
  $mem = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
      $mem = $pieces[1];
      break;
    }
  }
  fclose($fh);

  $mb = $mem / 1024;
  $gb = $mb / 1024;
   if ($arg == 'kb') {
     return $mem . ' ' . 'KB';
   }

   else if ($arg == 'mb') {
     $mb = $mem / 1024;
     $mb_rounded = round_up($mb, 2);
     return $mb_rounded . ' ' . 'MB';
   }

   else if ($arg == 'gb') {
     $gb = $mb / 1024;
     $gb_rounded = round_up($gb, 2);
     return $gb_rounded . ' ' . 'GB';
   }

}

//-------------------------------------------
//-    Function For Total Ram Available     -
//-------------------------------------------
// - Total available memeroy on the server -
//This will return the total RAM available on the server
//Useage:
//get_get_availableram(kb) - Returns the total available RAM in Kilo Bytes
//get_get_availableram(mb) - Returns the total available RAM in Mega Bytes
//get_get_availableram(gb) - Returns the total available RAM in Giga Bytes
function get_availableram($arg) {

  $fh = fopen('/proc/meminfo','r');
  $mem = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemAvailable:\s+(\d+)\skB$/', $line, $pieces)) {
      $mem = $pieces[1];
      break;
    }
  }
  fclose($fh);

  $mb = $mem / 1024;
  $gb = $mb / 1024;
   if ($arg == 'kb') {
     return $mem . ' ' . 'KB';
   }

   else if ($arg == 'mb') {
     $mb = $mem / 1024;
     $mb_rounded = round_up($mb, 2);
     return $mb_rounded . ' ' . 'MB';
   }

   else if ($arg == 'gb') {
     $gb = $mb / 1024;
     $gb_rounded = round_up($gb, 2);
     return $gb_rounded . ' ' . 'GB';
   }

}

//-------------------------------------------
//-          Function For Free Ram          -
//-------------------------------------------
// - Total memeroy thats not being used by anything -
//This will return the free RAM on the server
//Useage:
//get_freeram(kb) - Returns the free RAM in Kilo Bytes
//get_freeram(mb) - Returns the free RAM in Mega Bytes
//get_freeram(gb) - Returns the free RAM in Giga Bytes
function get_freeram($arg) {

  $fh = fopen('/proc/meminfo','r');
  $mem = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
      $mem = $pieces[1];
      break;
    }
  }
  fclose($fh);

  $mb = $mem / 1024;
  $gb = $mb / 1024;
   if ($arg == 'kb') {
     return $mem . ' ' . 'KB';
   }

   else if ($arg == 'mb') {
     $mb = $mem / 1024;
     $mb_rounded = round_up($mb, 2);
     return $mb_rounded . ' ' . 'MB';
   }

   else if ($arg == 'gb') {
     $gb = $mb / 1024;
     $gb_rounded = round_up($gb, 2);
     return $gb_rounded . ' ' . 'GB';
   }

}

//-------------------------------------------
//-      Function For Ram Being Used        -
//-------------------------------------------
// - Total memeroy thats being used -
//This will return the memeroy thats being used on the server
//Useage:
//get_usedram(kb) - Returns RAM being used in Kilo Bytes
//get_usedram(mb) - Returns RAM being used in Mega Bytes
//get_usedram(gb) - Returns RAM being used in Giga Bytes
function get_usedram($arg) {

  if ($arg == kb) {
    $totalram = get_totalram(kb);
    $freeram = get_freeram(kb);
    $sum = $totalram - $freeram;
    return $sum . ' ' . 'KB';
  }

  else if ($arg == mb) {
    $totalram = get_totalram(mb);
    $freeram = get_freeram(mb);
    $sum = $totalram - $freeram;
    return $sum . ' ' . 'MB';

  }

  else if ($arg == gb) {
    $totalram = get_totalram(gb);
    $freeram = get_freeram(gb);
    $sum = $totalram - $freeram;
    return $sum . ' ' . 'GB';
  }

}

//-------------------------------------------
//-     Function For Ram Being Used (%)     -
//-------------------------------------------
//Total memeroy thats being used shown as a %
//Useage:
//get_freeram2() - Returns the free memery as a %
function get_usedram2() {

  $sum1 = get_usedram(kb) / get_totalram(kb);
  $sum2 = $sum1 * 100;
  $sum3 = round_up($sum2, 2);

  return $sum3 . '%';

}


//-------------------------------------------
//-      Function For CPU Being Used        -
//-------------------------------------------
//Total % of cpu being used
//Useage
//get_cpu_usage() - Returns the % of cpu being used
function get_cpu_usage(){

    $load = sys_getloadavg();
    return $load[0];

}

//-------------------------------------------
//-      Function For CPU information       -
//-------------------------------------------
//Function to get diffrent data about cpu
//Useage
//get_cpuinfo(model) - Returns the model of the CPU
//get_cpuinfo(cores) - Returns the ammount of cores the cpu has
//get_cpuinfo(speed) - Returns the clockspeed of the cores
//get_cpuinfo(cache) - Returns the cache ammount for the cpu
function get_cpuinfo($arg) {

  //'model' This gives you the model of the CPU
  if ($arg == 'model') {
    $file = file('/proc/cpuinfo');
    $cpu_model_line = $file[4];
    $cpumodel = strtr ($cpu_model_line, array ('model name	: ' => ''));

    return $cpumodel;
  }

  //'cores' This gives you the ammount of cores on the cpu
  else if ($arg == 'cores') {
    $file = file('/proc/cpuinfo');
    $cpu_cores_line = $file[12];
    $cpucores = strtr ($cpu_cores_line, array ('cpu cores	: ' => ''));

    return $cpucores;
  }

  //'speed' This gives you the clock speed of the cpu
  else if ($arg == 'speed') {
    $file = file('/proc/cpuinfo');
    $cpu_speed_line = $file[7];
    $cpuspeed = strtr ($cpu_speed_line, array ('cpu MHz		: ' => ''));
    $cpuspeed_rounded = round_up($cpuspeed, 2);

    return $cpuspeed_rounded;
  }

  //'cache' This gives you ammount of cahe the cpu has
  else if ($arg == 'cache') {
    $file = file('/proc/cpuinfo');
    $cpu_cache_line = $file[8];
    $cpucache = strtr ($cpu_cache_line, array ('cache size	: ' => ''));

    return $cpucache;
  }



}


//-------------------------------------------
//-        Function Total Disk Space        -
//-------------------------------------------
//Function to get total space on disk
//This will return the total disk space available on the server
//Useage:
//get_disktotalspace(kb) - Returns the total disk space in Kilo Bytes
//get_disktotalspace(mb) - Returns the total disk space in Mega Bytes
//get_disktotalspace(gb) - Returns the total disk space in Giga Bytes
function get_disktotalspace($arg) {

  $bytes = disk_total_space("/");
  $kb = $bytes / 1024;
  $mb = $kb / 1024;
  $gb = $mb / 1024;

  if ($arg == 'kb') {
    $kb = round_up($kb, 2);
    $kb_rounded = $kb;
    return $kb_rounded;
  }

  else if ($arg == 'mb') {
    $mb = round_up($mb, 2);
    $mb_rounded = $mb;
    return $mb_rounded;
  }

  else if ($arg == 'gb') {
    $gb = round_up($gb, 2);
    $gb_rounded = $gb;
    return $gb_rounded;
  }

}



//-------------------------------------------
//-        Function Disk Free Space        -
//-------------------------------------------
//Function to get the free space on disk
//This will return the free disk space available on the server
//Useage:
//get_diskfreespace(kb) - Returns the free disk space in Kilo Bytes
//get_diskfreespace(mb) - Returns the free disk space in Mega Bytes
//get_diskfreespace(gb) - Returns the free disk space in Giga Bytes
function get_diskfreespace($arg) {

  $bytes = disk_free_space("/");
  $kb = $bytes / 1024;
  $mb = $kb / 1024;
  $gb = $mb / 1024;

  if ($arg == 'kb') {
    $kb = round_up($kb, 2);
    $kb_rounded = $kb;
    return $kb_rounded;
  }

  else if ($arg == 'mb') {
    $mb = round_up($mb, 2);
    $mb_rounded = $mb;
    return $mb_rounded;
  }

  else if ($arg == 'gb') {
    $gb = round_up($gb, 2);
    $gb_rounded = $gb;
    return $gb_rounded;
  }

}



//-------------------------------------------
//-         Function Used Disk Space        -
//-------------------------------------------
//Function to see how much disk space is used
//This will return the used disk space available on the server
//Useage:
//get_diskusedspace(kb) - Returns the used disk space in Kilo Bytes
//get_diskusedspace(mb) - Returns the used disk space in Mega Bytes
//get_diskusedspace(gb) - Returns the used disk space in Giga Bytes
function get_diskusedspace($arg) {

  $kb = get_disktotalspace(kb) - get_diskfreespace(kb);
  $mb = $kb / 1024;
  $gb = $mb / 1024;

  if ($arg == 'kb') {
    $kb = round_up($kb, 2);
    $kb_rounded = $kb;
    return $kb_rounded;
  }

  else if ($arg == 'mb') {
    $mb = round_up($mb, 2);
    $mb_rounded = $mb;
    return $mb_rounded;
  }

  else if ($arg == 'gb') {
    $gb = round_up($gb, 2);
    $gb_rounded = $gb;
    return $gb_rounded;
  }

}

//-------------------------------------------
//-       Function Used Disk Space (%)      -
//-------------------------------------------
//Function to see how much disk space is used (shown in %)
//Useage
//get_diskusedspace2() - Returns the used disk space as a %
function get_diskusedspace2() {

  $sum1 = get_diskusedspace(kb) / get_disktotalspace(kb);
  $sum2 = $sum1 * 100;
  $sum3 = round_up($sum2, 2);

  return $sum3 . '%';

}

//-------------------------------------------
//-    Function For Other Functions     -
//-------------------------------------------
//Function to round numbers up
function round_up ( $value, $precision ) {
  $pow = pow ( 10, $precision );
  return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
}
