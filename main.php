<?php
//paste here the path to TeamSpeak3.php file
require_once("libraries/TeamSpeak3/TeamSpeak3.php");
//paste here the path to ganon.php file
include('ganon/ganon.php');

$server = array(
	//Insert here the TeamSpeak 3 Server + Query data
        "tsip" => "127.0.0.1",
        "tsport" => "9987",
        "ts_query_admin" => "serveradmin",
        "ts_query_password" => "youramazingpassword",
        "ts_query_port" => "10011",
		 
	"channel_id_enabled" => true,
	"channel_id" => 5,
	//If you dont know what this, then dont change it
	"virtualserver_id" => 1
    );
    
TeamSpeak3::init();
$ts3_ServerInstance = TeamSpeak3::factory("serverquery://".$server["ts_query_admin"].":".$server["ts_query_password"]."@".$server["tsip"].":".$server["ts_query_port"]."/");

//Here is a list of Steam user ids. Just fill the array in with your ids. Example url which contains the user id: http://steamcommunity.com/profiles/76561198093851700
$user = array("76561198093851700", "76561198102720386");


define('STEAM_USER', $user[rand(0,count($user))]);
define('LIST_URL', "http://steamcommunity.com/profiles/".STEAM_USER."/screenshots/?appid=0&sort=newestfirst&browsefilter=myfiles&view=grid");

$html = file_get_dom(LIST_URL);

foreach($html('.profile_media_item') as $element) {
    $nodes = $element('.imgWallHoverDescription q');
    if (count($nodes)>0) $title = $nodes[0]->getInnerText();
    else $title = "null";
	
    $nodes = $element('img');
    if (count($nodes)>0) $thumb = $nodes[0]->src;
    else $thumb = "";
    $nodes = $element('div.imgWallItem');
    $nodeID = $nodes[0]->id;
	
    $itemID = str_replace('imgWallItem_','',$nodeID);
    $link = "http://steamcommunity.com/sharedfiles/filedetails/?id=" . $itemID;
    $array[] = $link;
}

$list = json_encode($array);
$rand = mt_rand(0,49);

$html = file_get_dom(json_decode($list)[$rand]);
foreach($html('.screenshotEnlargeable') as $element) {
	$source[] = $element->src;
}

$user = json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=E4F5AC80D6C4873D39078E03352657A8&steamids=" .STEAM_USER));
$Name = $user->response->players[0]->personaname;

$source[] = $title;
$source[] = $Name;

$list = json_decode(json_encode($source));
try{
	foreach($ts3_ServerInstance as $ts3_VirtualServer)
	{
		//The Server with the id 1 is gets addressed
		if($ts3_VirtualServer->getId() == $server["virtualserver_id"]){
			
			$ts3_VirtualServer["virtualserver_hostbanner_gfx_url"] = $list[0];
			$ts3_VirtualServer->virtualserver_hostbanner_url = $list[0];
			if($server["channel_id_enabled"] == true){
				try{
					$channel = $ts3_VirtualServer->channelGetById($server["channel_id"]);
					$channel["channel_name"] = "[cspacer0]Picture by " .$Name;
					//The channel description is also changed because Mobile users can not see the hostbanner. But they can look into the channel description in which they can see the hostbanner image.
					$channel["channel_description"] = "[img]".$list[0]."[/img]";
				}catch(TeamSpeak3_Adapter_ServerQuery_Exception $ze){}
			}
		}
			
	}
	}catch(TeamSpeak3_Adapter_ServerQuery_Exception $ze){}
?>
