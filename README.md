<p align="center">
  <img src ="https://tomrouse.me/images/Statsy_cropped.svg" width="350px" />
</p>

# Statsy

Statsy is a easy to use open source PHP tool for developers, that allows you to return various types of information about your server. It can be used to retrieve static information or can be set up to auto refresh data whatever is needed for your project however you can still use Statsy and Statsy Auto together at the same time. Statsy makes it very easy to create dashboards and server monitor apps.

To use statsy you can either call the function or get the information from an array. This allows you to do much more as all the data is in array making it easier to implement into your project and give you more flexibility.

## Table Of Content

* [What information can statsy get?](#what-information)
* [How to install/configure Statsy](#statsy-install)
* [How to install/configure Statsy Auto](#statsy-install-auto)
* [List of functions and how to call them](#functions-list)
* [Example](#example)
* [Why use Statsy?](#why-use)
* [Coming Soon](#coming-soon)
* [Contributors](#contributors)

## <a name="what-information"></a>What Information Can Statsy Get?


### Memory Stats
All memory stats can be returned as KiloBytes, MegaBytes or GigaBytes.

* [Total Memory](#total-mem)
* [Available Memory](#available-mem)
* [Cached Memory](#cached-mem)
* [Swap Memory](#swap-mem)
* [Buffer Memory](#buffer-mem)
* [Shmem Memory](#shmem-mem)
* [SReclaimable Memory](#sreclaimable-mem)
* [SUnreclaim Memory](#sunreclaim-mem)
* [Free Memory](#free-mem)
* [Real Free Memory](#real-free)
* [Used Memory](#used-mem)
* [Used Memory As Percent](#used-mem-percent)

### Disk Stats
All disk stats can be returned as KiloBytes, MegaBytes or GigaBytes.

* [Total Disk](#total-disk)
* [Free Disk](#free-disk)
* [Used Disk](#used-disk)
* [Used Disk as %](#used-disk-percent)

### CPU Stats

* [CPU Model](#cpu-model)
* [CPU Cores](#cpu-cores)
* [CPU Clock Speed](#cpu-speed)
* [CPU Cache](#cpu-cache)
* [CPU Load as %](#cpu-load)

### Misc

* [Server IP](#misc-ip)
* [Server Uptime](#misc-uptime)
* [Round Up Function](#round-up)
* [Convert Function](#convert)


## <a name="statsy-install"></a>How To Install Statsy

To install Statsy all you need to do is simply download the ``` statsy.php ``` file from the Statsy folder and include the file on whatever file you want to call the functions using the following code:
```php
<?php include 'directory-to-statsy-file/statsy.php'; ?>
```
Now your ready to start using statsy! [List of functions](#functions-list)

## <a name="statsy-install-auto"></a>How To Install Statsy Auto

Using Statsy Auto is a little different then the normal Statsy instead of just calling the function or using the array you will need to set the location where you want the information to be shown then its will automatically be pulled in and refreshed. When using the normal Statsy you will only need to call the function or use the array however Statsy and Statsy Auto can be used together at the same time.

### Step 1: Download The relevant Files And JQuery

To install Statsy Auto you will need to download the three files in the Statsy Auto folder ``` statsy.php ```, ``` statsy.js ```and ``` stats_json.php ```. You will also need to make sure you have JQuery installed (JQuery will not be needed much longer).

### Step 2: Configure the statsy.js file (Most important step)

To configure this file you just need to set the variables so that Statsy knows where to find the ``` stats_json.php ``` and also knows where to display the data on your page/pages.

First set the ``` var ``` for the ``` stats_json.php ``` file location this can be either a directory path or a URl, this is shown in the example below:

```javascript
var stats_json_url = "https://www.example.com/statsy/stats_json.php";
```

Next set the ``` var ``` for the auto refresh delay. This is set in miliseconds (1000 miliseconds = 1 second), This is shown in the example below where the delay is set to 2 seconds:

```javascript
var auto_refresh_delay = 2000;
```

Finally you just need to set where statsy wil display the information on your page by adding the class/ID names. The example below shows 2 examples one with a class nd one with an ID make sure to set all of the ``` vars ``` that you want to use.

```javascript
var total_mem_loc = ".example-class";
var available_mem_loc = "#example-id";
```

### Step 3: Configure the stats_json.php file (Only nessasarry if you want to customize the return kb, mb, gb)

To configure this file all you need to do is change the args in the arrays to whatever you want Statsy Auto to return the example below shows how it is setup by defualt this will return all values in megabytes:

```php
$mem = array(
    'total' => get_total_mem('mb'),
    'available' =>  get_available_mem('mb'),
    'cached' => get_cached_mem('mb'),
    'swap' => get_swap_mem('mb'),
    'buffer' => get_butffer_mem('mb'),
    'shmem' => get_shmem_mem('mb'),
    'sreclaimable' => get_sreclaimable_mem('mb'),
    'sunreclaim' => get_sunreclaim_mem('mb'),
    'free' => get_free_mem('mb'),
    'realfree' => get_realfree_mem('mb'),
    'used' => get_used_mem('mb'),
    'percent' => get_used_mem2()
  );

  $disk = array(
    'total' => get_disk_total('mb'),
    'free' => get_disk_free('mb'),
    'used' => get_disk_used('mb'),
    'percent' => get_disk_used2()
  );
```
There is no need to change anything else in this file inless you know what you are doing.This is all the configuration needed to use Statsy Auto.

## <a name="functions-list"></a>List Of Functions And How To Use Them
Below is a list of all the functions in Statsy and how to call them using the function or array. Both the array and function will return the same thing its just prefrence. When using Statsy Auto you can also use these functions at the same time if you want to.

## Memory

### <a name="total-mem"></a>Total Memory
Examples of how to get total memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_total_mem('kb');
get_total_mem('mb');
get_total_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['totalkb'];
get()['mem']['totalmb'];
get()['mem']['totalgb'];
```

### <a name="available-mem"></a>Available Memory
Examples of how to get available memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_available_mem('kb');
get_available_mem('mb');
get_available_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['availablekb'];
get()['mem']['availablemb'];
get()['mem']['availablegb'];
```


### <a name="cached-mem"></a>Cached Memory
Examples of how to get cached memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_cached_mem('kb');
get_cached_mem('mb');
get_cachede_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['cachedkb'];
get()['mem']['cachedmb'];
get()['mem']['cachedgb'];
```

### <a name="swap-mem"></a>Swap Memory
Examples of how to get swap memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_swap_mem('kb');
get_swap_mem('mb');
get_swap_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['swapkb'];
get()['mem']['swapmb'];
get()['mem']['swapgb'];
```

### <a name="buffer-mem"></a>Buffer Memory
Examples of how to get buffer memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_buffer_mem('kb');
get_buffer_mem('mb');
get_buffer_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['bufferkb'];
get()['mem']['buffermb'];
get()['mem']['buffergb'];
```


### <a name="shmem-mem"></a>Shmem Memory
Examples of how to get shmem memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_shmem_mem('kb');
get_shmem_mem('mb');
get_shmem_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['shmemkb'];
get()['mem']['shmemmb'];
get()['mem']['shmemgb'];
```


### <a name="sreclaimable-mem"></a>SReclaimable Memory
Examples of how to get SReclaimable memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_sreclaimable_mem('kb');
get_sreclaimable_mem('mb');
get_sreclaimable_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['sreclaimablekb'];
get()['mem']['sreclaimablemb'];
get()['mem']['sreclaimablegb'];
```

### <a name="sunreclaim-mem"></a>SUnreclaim Memory
Examples of how to get SUnreclaim memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_sunreclaim_mem('kb');
get_sunreclaim_mem('mb');
get_sunreclaim_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['sunreclaimkb'];
get()['mem']['sunreclaimmb'];
get()['mem']['sunreclaimgb'];
```

### <a name="free-mem"></a>Free Memory
Please bare in mind this is the free memory value from the /proc/meminfo/ file and is not the real free memory for that please see the [Real Free](#real-free) Function.

Examples of how to get free memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_free_mem('kb');
get_free_mem('mb');
get_free_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['freekb'];
get()['mem']['freemb'];
get()['mem']['freegb'];
```

### <a name="real-free"></a>Real Free Memory
The Real Free Memory function gets the correct amount of free memory by using the [Used Memory](#used-mem) function.

Examples of how to get SUnreclaim memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_realfree_mem('kb');
get_realfree_mem('mb');
get_realfree_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['realfreekb'];
get()['mem']['realfreemb'];
get()['mem']['realfreegb'];
```

### <a name="used-mem"></a>Used Memory
The formular statsy uses to get an accurate used memory value is <b>MemTotal - MemFree - Buffers - Cached - SReclaimable - Shmem</b>

Examples of how to get used memory to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_used_mem('kb');
get_used_mem('mb');
get_used_mem('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['mem']['usedkb'];
get()['mem']['usedmb'];
get()['mem']['usedgb'];
```

### <a name="used-mem-percent"></a>Used Memory As Percent
Examples of how to get used memory as a percent to display the value you will need to use ``` echo ```:

#### Call using function:
To return value as a percent:
```php
get_used_mem2()
```
#### Call using array:
To return value as a percent:
```php
get()['mem']['percent'];
```

## Disk

### <a name="total-disk"></a>Total Disk
Examples of how to get total disk to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_disk_total('kb');
get_disk_total('mb');
get_disk_total('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['disk']['totalkb'];
get()['disk']['totalmb'];
get()['disk']['totalgb'];
```

### <a name="free-disk"></a>Free Disk
Examples of how to get free disk to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_disk_free('kb');
get_disk_free('mb');
get_disk_free('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['disk']['freekb'];
get()['disk']['freemb'];
get()['disk']['freegb'];
```

### <a name="used-disk"></a>Used Disk
Examples of how to get used disk to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in kb, mb or gb:
```php
get_disk_used('kb');
get_disk_used('mb');
get_disk_used('gb');
```
#### Call using array:
To return value in kb, mb or gb:
```php
get()['disk']['usedkb'];
get()['disk']['usedmb'];
get()['disk']['usedgb'];
```

### <a name="used-disk-percent"></a>Used As Percent Disk
Examples of how to get used disk as percent to display the value you will need to use ``` echo ```:

#### Call using function:
To return value as a percent:
```php
get_disk_used2();
```
#### Call using array:
To return value as a percent:
```php
get()['disk']['percent'];
```

## CPU

### <a name="cpu-model"></a>CPU Model
Examples of how to get the CPU model to display the value you will need to use ``` echo ```:

#### Call using function:
```php
get_cpuinfo('model');
```
#### Call using array:
```php
get()['cpu']['model'];
```

### <a name="cpu-cores"></a>CPU Cores
Examples of how to get the amount of CPU cores to display the value you will need to use ``` echo ```:

#### Call using function:
```php
get_cpuinfo('cores');
```
#### Call using array:
```php
get()['cpu']['cores'];
```

### <a name="cpu-clock"></a>CPU Clock Speed
Examples of how to get the CPU clock speed to display the value you will need to use ``` echo ```:

#### Call using function:
To return value in MHz:
```php
get_cpuinfo('speed');
```
#### Call using array:
To return value in MHz:
```php
get()['cpu']['clock'];
```

### <a name="cpu-cache"></a>CPU Cache
Examples of how to get the CPU cache to display the value you will need to use ``` echo ```:

#### Call using function:
```php
get_cpuinfo('cache');
```
#### Call using array:
```php
get()['cpu']['cache'];
```

### <a name="cpu-load"></a>CPU Load
Examples of how to get the CPU load as a percent to display the value you will need to use ``` echo ```:

#### Call using function:
To return value as percent:
```php
get_cpu_load();
```
#### Call using array:
To return value as percent:
```php
get()['cpu']['load'];
```

## Misc

### <a name="misc-uptime"></a>Server Uptime
The uptime can be called in 4 ways. Examples of how to get the server uptime to display the value you will need to use ``` echo ```:

#### Call using function or array:
To return just the amount of days '2 Days':
```php
get_uptime('days');
get()['uptime']['days'];
```
To return just the amount of days and hours '2 Days 3 hours':
```php
get_uptime('hours');
get()['uptime']['hours'];
```
To return just the amount of days, hours and minutes '2 Days 3 hours 12 Mins':
```php
get_uptime('mins');
get()['uptime']['mins'];
```
To return just the full uptime days, hours, minutes and seconds '2 Days 3 hours 12 Mins 11 Secs':
```php
get_uptime('secs');
get()['uptime']['secs'];
```

### <a name="misc-ip"></a>CPU Load
Examples of how to get the server ip to display the value you will need to use ``` echo ```:

#### Call using function:
```php
get_ip();
```
#### Call using array:
```php
get()['ip']['ip'];
```

### <a name="round-up"></a>Round Up Function
This function is used to round up numbers and is very simple to use:
```php
round_up ( $value, $precision )
```
Example:
```php
round_up ( 12.385y2324323, 2 )
```

### <a name="convert"></a>Convert Function
This function is used by all other function to convert the memory types:
```php
convert($input, $converstion)
```
Example:
```php
convert(187374563765, 'mb')
```

## <a name="example"></a>Example
NOTE: The example below are for normal Statsy as for Statsy Auto you will config the JS file to tell Statsy where you want the data to show however Statsy and Statsy Auto can use used together at the same time.

Below is a small sample of what using some functions and arrays might look like being called in a html/php file:
```php
<div class="server-stats">

<p><?php echo get_ip(); ?></p>

<p><?php echo get_total_mem('gb'); ?></p>

<p><?php echo get_disk_total('gb'); ?></p>

<p><?php echo get()['mem']['used']; ?></p>

<p><?php echo get()['cpu']['cores']; ?></p>

</div>
```

## <a name="why-use"></a>Why use Statsy?
* Very easy to install and use!
* Makes it easy to get server information and stats
* Can be called in 3 different ways:
  * using functions
  * using arrays
  * using auto refresh
  * All of the above at the same time
* Makes it very easy to pull in mutiple server stats to one place
* Makes it very easy to make your own server monitor apps
* Its open source!

## <a name="coming-soon"></a>Coming Soon
Here are some fetures that will be coming soon to Statsy!

#### Complete rewrite of code into OOP
#### Available as a composer package
Smaller Things:
* Acess to log files
* Acess to network data
* No Jquery dependency
* Statsy dashbored templates
* Seprate cpu core Loads

If you have any ideas forimprovements please contact me here: tom.rouse123@gmail.com

## <a name="contributors"></a>Contributors
Arthor: Tom Rouse (Tms157)
