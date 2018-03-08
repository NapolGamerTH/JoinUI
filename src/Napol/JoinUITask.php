<?php

namespace Napol;

use Napol\JoinUI;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class JoinUITask extends PluginTask{

    private $plugin;
    private $player;

    public function __construct(JoinUI $plugin, Player $player){
        parent::__construct($plugin);
        $this->plugin = $plugin;
        $this->player = $player;
    }

    public function onRun(int $currentTick){
        $player = $this->player;
        $this->mainForm($player);
    }

    public function mainForm($player) : void{
        $content = $this->plugin->getConfig()->get("Content");
        $button = $this->plugin->getConfig()->get("Button");
        $form = $this->plugin->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, array $data){
            if (isset($data[0])) {
                switch ($data[0]) {
                    case 0:
                        $player->sendMessage("§f-> §aขอบคุณที่อ่านนะครับ §f:)");
                }
                return true;
            }
            return false;
        });
        $form->setTitle(TextFormat::RESET . TextFormat::GREEN . "§f-=:> §cMC§f-§6Car§erot§aCraft§f - §eSurvival§f <:=-");
        $form->setContent($content);
        $form->addButton($button);
        $form->sendToPlayer($player);
    }
}
