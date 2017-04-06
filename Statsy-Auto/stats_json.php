<?php

include 'statsy.php';

//-------------------------------------------------------------------------------
//-    To change what memeroy size is returned edit the arrays args below       -
//-------------------------------------------------------------------------------

function data() {

  //mem array
  $mem = array(
    'total' => get_total_mem('mb'),
    'available' =>  get_available_mem('mb'),
    'cached' => get_cached_mem('mb'),
    'swap' => get_swap_mem('mb'),
    'buffer' => get_buffer_mem('mb'),
    'shmem' => get_shmem_mem('mb'),
    'sreclaimable' => get_sreclaimable_mem('mb'),
    'sunreclaim' => get_sunreclaim_mem('mb'),
    'free' => get_free_mem('mb'),
    'realfree' => get_realfree_mem('mb'),
    'used' => get_used_mem('mb'),
    'percent' => get_used_mem2()
  );

  //disk array
  $disk = array(
    'total' => get_disk_total('mb'),
    'free' => get_disk_free('mb'),
    'used' => get_disk_used('mb'),
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

echo json_encode(data());
