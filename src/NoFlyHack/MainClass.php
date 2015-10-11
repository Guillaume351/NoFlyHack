<?php

namespace NoFlyHack;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class MainClass extends PluginBase implements Listener{
    public $players = [];

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
    	}
    
    	public function onPlayerJoin(PlayerJoinEvent $event){
	   $this->players[$event->getPlayer()->getName()] = 0;
    	}

	public function PlayerMove(PlayerMoveEvent $event){
	        $player = $event->getPlayer();
	        $name = $player->getName();
	        if(round($event->getTo()->getY() - $event->getFrom()->getY(),3) == 0.375) {
	            $this->players[$name] ++;
	        }else{
	            $this->players[$name] = 0;
	        }
	        if($this->players[$name] === 3){
	            $this->getServer()->broadcastMessage(TextFormat::RED.$name. TextFormat::YELLOW." banned for ".TextFormat::RED."FLY HACK");
	            $event->getPlayer()->kick("Fly detected.".TextFormat::RED."  You have been IP banned.");
	            $this->getServer()->getIPBans()->addBan($player->getAddress());
	        }
	}
}
