<?php

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

function get_usedram2() {

  $sum1 = get_usedram(kb) / get_totalram(kb);
  $sum2 = $sum1 * 100;
  $sum3 = round_up($sum2, 2);

  return $sum3 . '%';

}

function get_cpu_usage(){

    $load = sys_getloadavg();
    return $load[0];

}

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

function get_diskusedspace2() {

  $sum1 = get_diskusedspace(kb) / get_disktotalspace(kb);
  $sum2 = $sum1 * 100;
  $sum3 = round_up($sum2, 2);

  return $sum3 . '%';

}

function round_up ( $value, $precision ) {
  $pow = pow ( 10, $precision );
  return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
}
