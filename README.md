# PHP_Teamspeak3_Steam_Screenshots
This Script changes automatically the Banner of your TeamSpeak 3 Server with a Screenshot from a Steam users profile

What do this Script?
  This Script selects random from an array (which contains the Steam user ids) the Steam id. Then the Script selects again random a screentshot only from the LAST 50 scoring screenshots (if you have 300 screenshots it selects only the last 50, the other 250 are not getting selected) and set this Picture as the Teamspeak 3 gfx url. you can also enable a function in which one the selected username is getting pasted into a channel (see Pictures).

Requirements:
- you need 2 other php libraries
  - Teamspeak 3 PHP-Framwork: http://addons.teamspeak.com/directory/addon/integration/TeamSpeak-3-PHP-Framework.html
  - ganon: https://github.com/msmuenchen/ganon
In the Script is exactly explained how to use these two libraries.
- you need a Teamspeak 3 Query Account which can change the [virtualserver_hostbanner_gfx_url, virtualserver_hostbanner_url, channel_name and channel_description]. In my case i used the "serveradmin" Query.

This Script works with PHP 5. I don't know if PHP Versions lesser than 5 also functioning.

This script is very useful if you want to share your Experience with other People.

Sorry for my bad english and please excuse my language mistakes.

<img src="http://cdn.akamai.steamstatic.com/steamcommunity/public/images/avatars/0a/0a88c525a74ada123137db58881a322175eda8bf_full.jpg">
