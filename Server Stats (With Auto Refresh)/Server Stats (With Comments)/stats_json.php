<?php

include 'serverstats.php';

//-------------------------------------------
//-     Array to for json converstion       -
//-------------------------------------------
//If you want to change the output of the data from kb, mb and gb change the args below in the array:

$function_array = array('cpuusage' => get_cpu_usage(),

                        'usedram' => get_usedram(mb),
                        'freeram' => get_freeram(mb),
                        'usedram2' => get_usedram2(),

                        'diskfreespace' => get_diskfreespace(mb),
                        'diskusedspace' => get_diskusedspace(mb),
                        'diskusedspace2' => get_diskusedspace2(),

                        'uptimedays' => get_uptime(days),
                        'uptimehours' => get_uptime(hours),
                        'uptimemins' => get_uptime(mins),
                        'uptimesecs' => get_uptime(secs),
                        );

echo json_encode($function_array);
