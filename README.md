# PHP_Teamspeak3_Steam_Screenshots
This Script changes automatically the Banner of your TeamSpeak 3 Server with a Screenshot from a Steam users profile

What do this Script?
  This Script selects random from an array (which contains the Steam user ids) the Steam id. Then the Script selects again random a screentshot only from the LAST 50 scoring screenshots (if you have 300 screenshots it selects only the last 50, the other 250 are not getting selected) and set this Picture as the Teamspeak 3 gfx url. you can also enable a function in which one the selected username is getting pasted into a channel (see Pictures).

Requirements:
- you need 2 other php libraries
  - Teamspeak 3 PHP-Framwork: http://addons.teamspeak.com/directory/addon/integration/TeamSpeak-3-PHP-Framework.html
  - ganon: https://github.com/msmuenchen/ganon <br>
In the Script is exactly explained how to use these two libraries.
- you need a Teamspeak 3 Query Account which can change the [virtualserver_hostbanner_gfx_url, virtualserver_hostbanner_url, channel_name and channel_description]. In my case i used the "serveradmin" Query.

This Script works with PHP 5. I don't know if PHP Versions lesser than 5 also functioning.

Now you can create a cronjob which one executes every 2 minutes the php file.<br>
Example: */2 * * * * php /home/cronscripts/main.php

Sorry for my bad english and please excuse my language mistakes.
<br>
<br>
<h2>Screenshot</h2>
<img src="https://github.com/Darthbob/PHP_Teamspeak3_Steam_Screenshots/blob/master/media/screenshot_1.png">
<br>
<h2>Video</h2>
<img src="https://github.com/Darthbob/PHP_Teamspeak3_Steam_Screenshots/blob/master/media/video.gif?raw=true">
