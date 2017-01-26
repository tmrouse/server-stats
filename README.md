# Server-Stats
PHP Tool to easily get server information

Server Stats is a group of premade easy to use custom functions that can return various types of information about your server. It can be used as static information or can be set up to auto refresh data whatever is needed for your project.

In the "Server Stats" folder you will find the file you need to use server stats without live refreshing

In the "Server Stats (With live refreshing)" folder you will find the files you need to use server stats with live refreshing (3 in total)

Both are very easy to use, server stats requres no setup at all apart from including the file. Server stats with refreshing requires a little setup but is very simple and explaied below.

Server stats can also be used remotley useing auto refresh. But please note only functions added to the array in stats_json can be used remotley so if you want to use a function remotley thats not in there it will need to be added but this is very easy to do.

(Will be updateing with wiki guides and rewwriting this read me soon)

## What information can i get with Server-Stats
With Server-stats you can get the folling information:

- Uptime - (Days, Hours, Mins, Secs)                                                             
- Total RAM - (Ammount in Kilobytes, MegaBytes, Gigabytes)                                  
- Available - RAM (Ammount in Kilobytes, MegaBytes, Gigabytes)                              
- Free RAM - (Ammount in Kilobytes, MegaBytes, Gigabytes)                                   
- Used RAM - (Ammount inKilobytes, MegaBytes, Gigabytes or %)                              
- CPU Useage - (As a %)                                                         
- CPU Info - (model, clock speed, cache ammount, cores)                
- Total Disk - Space (Ammount in Kilobytes, MegaBytes, Gigabytes)                           
- Total Free Disk Space - (Ammount Kilobytes, MegaBytes, Gigabytes)                      
- Disk Space Used - (Ammount Kilobytes, MegaBytes, Gigabytes or %)

##How To Use (with auto refresh)
To use Server Stats with auto refresh you will need the 3 files provided in the "Server Stats (With auto refresh)" folder. 
- serverstats.php
- stats_json.php
- serverstats.js

You will also need jqery installed. 

####Step 1 Configure the stats_json.php File
To do this you will need to change the values in the args to what memory size you want to use. By defualt they are all st to MB but can be KB, MB or GB if you want to find out more about this look as the normal setup for Server Stats without auto refresh below. However for the most part this file does not need to be changed inless you want to change the values given out from KB, MB, GB.

Heres an example of all the values being GB: 

```php
$function_array = array('cpuusage' => get_cpu_usage(),

                        'usedram' => get_usedram(gb), //This value has been changed from mb to gb
                        'freeram' => get_freeram(gb), //This value has been changed from mb to gb
                        'usedram2' => get_usedram2(), //This function does not use any args

                        'diskfreespace' => get_diskfreespace(gb), //This value has been changed from mb to gb
                        'diskusedspace' => get_diskusedspace(gb), //This value has been changed from mb to gb
                        'diskusedspace2' => get_diskusedspace2(), //This function does not use any args

                        'uptimedays' => get_uptime(days), //This value sould not be changed at all
                        'uptimehours' => get_uptime(hours), //This value sould not be changed at all
                        'uptimemins' => get_uptime(mins), //This value sould not be changed at all
                        'uptimesecs' => get_uptime(secs), //This value sould not be changed at all
                        );

```
You can also remove any of the above entreies into the array if you know you whont be useing them and want to make the file smaller. However this is not really nessary.

####Step 2 Configure the serverstats.js File
This is the most inporant part first we need to set the location of the stats_json file. The example below shows the setup for my server please change this to the relavent link on your own server where the stats_json file is located

```js
$.get( "https://server.tomrouse.me/inc/stats_json.php", function( data ) {
```

The next step is 100% optional and should only be done if you really care about useing less banwidth (even know this does not use much anyway) This is removeing the commands from the call to get the information. the example below shows the defualt file you can edit this and remove the var's that you whont be useing.

```js
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
```
The final step is to set the element that will be used to show the data the example below shows i have set each value to show in a element with the class of 'result0' - 'result10':

```js
  $(".result1").html(usedram); // For this is will display the used ram value in the html elment with the class result1
  $(".result2").html(freeram); // For this is will display the free ram value in the html elment with the class result2
  $(".result3").html(usedram2); // For this is will display the used ram % value in the html elment with the class result3

  $(".result4").html(diskfreespace); // For this is will display the disk free space value in the html elment with the class result4
  $(".result5").html(diskusedspace); // For this is will display the disk used space value in the html elment with the class result5
  $(".result6").html(diskusedspace2); // For this is will display the disk used space % value in the html elment with the class result6

  $(".result7").html(uptimedays); // For this is will display the uptime in days value in the html elment with the class result7
  $(".result8").html(uptimehours); // For this is will display the uptime in hours value in the html elment with the class result8
  $(".result9").html(uptimemins); // For this is will display the uptime in mins value in the html elment with the class result9
  $(".result10").html(uptimesecs); // For this is will display the uptime in secs value in the html elment with the class result10
```
Its very easy to change the ones i have added or add your own as all the var's are already made you just need to pick where to use them.

If you want more information on how each function works look below!

##How To Use (Without auto refresh) 
To use Server Stats just use it as a php include on your project and then you can call in the functions.

```php
<?php include_once 'directory/from/file/you/want/to/use/it/on/Server-Stats.php' ?>
```
##Function Names

Uptime:
```php
get_uptime($arg)
```
Ram:
```php
get_totalram($arg)
get_availableram($arg)
get_freeram($arg)
get_usedram($arg)
get_usedram2()
```

CPU:
```php
get_cpu_usage()
get_cpuinfo($arg)
```

HHD/SSD
```php
get_disktotalspace($arg)
get_diskfreespace($arg)
get_diskusedspace($arg)
get_diskusedspace2()
```

###Useing Each Function
To use the function just call then whereever you need them, if you wanna echo the number out make sure you use ```php echo ``` before the function call. An example of useing one of the function and adding some text with it would be  ```php echo get_usedram(gb) . ' ' . 'Ram Being Used'; ``` This would show '[yourram] GB Ram Being Used'

####get_uptime($arg)
This function will return the uptime of the server (Please bare in mind the time is relative to eachother)
get_uptime($arg) can be used as follows, days will return the ammount of days the server has been up, hours will return the ammount of hours the server has been up relative to days, mins will return the ammount of mins the server has been up relative to hours and secs will return the ammount of secs the server has been up relavent to mins.
```php
get_uptime(days)
get_uptime(hours)
get_uptime(mins)
get_uptime(secs)
```
Example: Uptime: 1 Day 3 Hours 10 Mins 57.78 Secs
To get this you would use this:
```php
echo 'Uptime:' . ' ' . get_uptime(days) . ' ' . 'Day' . ' ' . get_uptime(hours) . ' ' . 'Hours' . ' ' . get_uptime(mins) . ' ' . 'Mins' . ' ' . round_up(get_uptime(secs), 2) . ' ' . 'Secs';
```

####get_totalram($arg)
This function will return the tatal ammount of RAm installed on the server.
get_totalram($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_totalram(kb) 
get_totalram(mb)
get_totalram(gb)
```

####get_availableram($arg)
This function will return the available ram.
get_availableram($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_availableram(kb) 
get_availableram(mb)
get_availableram(gb)
```

####get_freeram($arg)
This function will get the free RAm that is free to be used.
get_freeram($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_freeram(kb) 
get_freeram(mb)
get_freeram(gb)
```

####get_usedram($arg)
This function will return the used ram.
get_usedram($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_usedram(kb) 
get_usedram(mb)
get_usedram(gb)
```

####get_usedram2()
This function will return used RAm as a %
get_usedram2() can be used as follows and will return the used ram as a %
```php
get_usedram2() 
```

####get_cpu_usage()
This function will return the CPU load as a %
get_cpu_usage() can be used as follows and will return the cpu load as a %
```php
get_cpu_usage()
```

####get_cpuinfo($arg)
This function will return diffrent information about the CPU.
get_cpuinfo($arg) can be used as follows, model will return the CPU model, cores will return the ammount of cores the CPU has, speed will return the clock speed, cache will return the CPU cache ammount
```php
get_cpuinfo(model)
get_cpuinfo(cores)
get_cpuinfo(speed)
get_cpuinfo(cache)
```

####get_disktotalspace($arg)
This function will return the total disk space
get_disktotalspace($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_disktotalspace(kb)
get_disktotalspace(mb)
get_disktotalspace(gb)
```

####get_diskfreespace($arg)
This function will return the free disk space
get_diskfreespace($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_diskfreespace(kb)
get_diskfreespace(mb)
get_diskfreespace(gb)
```

####get_diskusedspace($arg)
This function will return the used disk space
get_diskusedspace($arg) can be used as follows, kb will return the value in kilobytes, mb will return the value in megabytes and gb will return the value in gigabytes.
```php
get_diskusedspace(kb)
get_diskusedspace(mb)
get_diskusedspace(gb)
```

####get_diskusedspace2()
This function will return the used disk space as a %
get_diskusedspace2() can be used as follows and will return the used disk space as a %
```php
get_diskusedspace2() 
```
####round_up($value, $precision)
This function will round a numer up to however many decibels you choose all function already have this in them and return the value to 2 decibels points however if you want to round the uptime this will be needed.
EXAMPLE rounding up secs on uptime: 
```php
round_up(get_uptime(secs), 2) 
```
