<?php

namespace summerville;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerAfkEvent;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use summerville\jojoe77777\FormAPI\CustomForm;

class main extends PluginBase{

    public function onEnable(){
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch($command->getName()){
            case "afk":
                if($sender instanceof Player){
                    $this->openAfkForm($sender);
                    $sender->sendMessage("§aPlease choose.");
                }else{
                    $sender->sendMessage(".");
                }
                break;
        }
        return true;
    }
    
    public function openAfkForm($player){
        $afk = new CustomForm(function(Player $player, $data){
            var_dump($data);
            $outcome = $data[1];
            switch($outcome){
            	case 1:
                    if($outcome === true){
                    	foreach($this->getServer()->getOnlinePlayers() as $p){
                    	    $p->sendMessage("§a ". $player->getName() ." is afk!");
                        }
                    }
                    if($outcome === null){
                    	foreach($this->getServer()->getOnlinePlayers() as $p){
                    	    $p->sendMessage("§a ". $player->getName() ." is no longer afk!");
                        }
                    }
                    break;
                    return;
            }
        });
        
        $afk->setTitle("Afk");
        $afk->addLabel("No Longer Afk / Afk");
        $afk->addToggle("Afk");
        $player->sendForm($afk);
    }
}