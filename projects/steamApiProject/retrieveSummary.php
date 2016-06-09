<?php
// http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=59FDE012EC6DDA7CBF79F156CD6F6167&steamids=76561198037206821&format=xml


$apiKey = "59FDE012EC6DDA7CBF79F156CD6F6167";

$userID = $_GET['id'];
if($userID == ""){
	$userID = "HardCookStove"; // Default username
}

$generalInfoLink = "http://steamcommunity.com/id/".$userID."/?xml=1";

$infoFile = simplexml_load_file($generalInfoLink);
$userRealID = $infoFile->steamID64;


$playerSummariesLink = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$apiKey."&steamids=".$userRealID."&format=xml";

$summaryFile = simplexml_load_file($playerSummariesLink);
$summaryFile = $summaryFile->players[0]->player;


function clean_cdata($str) {
    return preg_replace('#(^\s*<!\[CDATA\[|\]\]>\s*$)#sim', '', (string)$str);
}
?>

<style>
.circle {
	margin-top:40px;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	float: left;
	margin-right: 20px;
}
</style>

<div class="row"> <!-- HEADER -->
	
	<div class="medium-3 columns">
		<img src=<?=$summaryFile->avatarfull;?>>
	</div>
	
	<div class="medium-9 columns">
		
		<div class="row">
			<div class="medium-12 columns">
				
				<div class="steamNameHeader">
					<?
					$playState = $infoFile->onlineState;
					if($playState == "online"){
						?><div class="circle" style="background:green"></div><?
					}else{
						?><div class="circle" style="background:red"></div><?
					}
					?>
					
					<h1><?=$summaryFile->personaname;?> (<?=$infoFile->realname?>)</h1>
				</div>
					
			</div>
		</div>
		
		<div class="row">
			<div class="medium-12 columns">
				<h3><?=clean_cdata($infoFile->summary);?></h3>
			</div>
		</div>
		
	</div>
	
</div>

<hr style="margin-left:auto; margin-right:auto; width:60%;">

<div class="row"> <!-- CONTENT -->
	<div class="medium-12 columns">
		
		

	</div>
</div>