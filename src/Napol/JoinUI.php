<?php

namespace Napol;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Napol\JoinUITask;
use pocketmine\utils\TextFormat;

class JoinUI extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getServer()->getLogger()->info("§aJoinUI §eเปิดทำงานแล้ว!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->configmakerthingy();
        $this->saveDefaultConfig();
        $this->reloadConfig();
    }

    public function onDisable() : void{
        $this->getServer()->getLogger()->alert(TextFormat::RED . "§aJoinUI §cปิดทำงานแล้ว!");
    }

    public function configmakerthingy() : void{
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        $this->getServer()->getScheduler()->scheduleDelayedTask(new JoinUITask($this, $player), 40);
    }
}
