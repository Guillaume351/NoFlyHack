<?php

namespace NoFlyHack;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class MainClass extends PluginBase implements Listener{
    public $players = [];
    
    public function onLoad(){}

    public function onEnable(){
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
}

    public function onDisable(){}

    public function onPlayerJoin(PlayerJoinEvent $event){
        $this->players[$event->getPlayer()->getName()] = 0;
}

    public function PlayerMove(PlayerMoveEvent $event){
        if ($event->getPlayer()->getY() < 24  and $event->getPlayer()->getGamemode() != 1  and$event->getPlayer()->onGround == false){
            $this->players[$event->getPlayer()->getName()] += 1;
        }else{
            $this->players[$event->getPlayer()->getName()] = 0;
        }
        if($this->players[$event->getPlayer()->getName()] > 48){
            $event->getPlayer()->kick("Fly detected.".TextFormat::RED." \nPlease disable all mods.");
        }
}

	
}
