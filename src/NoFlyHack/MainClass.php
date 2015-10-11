<?php

namespace NoFlyHack;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
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
        if ($player->getY() < 24 and $player->getGamemode() != 1 and $player->getGamemode() != 3 and $player->onGround == false){
            $this->players[$name] += 1;
        }else{
            $this->players[$name] = 0;
        }
        if($this->players[$name] > 48){
            $player->kick("Fly detected.".TextFormat::RED." \nPlease disable all mods.");
        }
    }

	
}
