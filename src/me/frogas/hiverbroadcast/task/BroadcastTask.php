<?php

namespace me\frogas\hiverbroadcast\task;

use pocketmine\Player;
use pocketmine\scheduler\Task;
use me\frogas\hiverbroadcast\HiverBroadcast;
use me\frogas\hiverbroadcast\sounds\NotificationSound;

class BroadcastTask extends Task {
	
	private $plugin;
	
	public function __construct(HiverBroadcast $plugin){
		$this->plugin = $plugin;
	}
	
	public function getLoader(){
		return $this->plugin;
	}
	
	public function onRun(int $tick){
		foreach($this->getLoader()->getServer()->getLevels() as $level){
			foreach($level->getEntities() as $player){
				if($player instanceof Player){
					if($this->getLoader()->broadcast["broadcast-type"] == "message"){
				        $this->getLoader()->getServer()->broadcastMessage($this->getLoader()->getPrefix() . $this->getLoader()->getMessage(array_rand($this->getLoader()->broadcast["messages"])));
				        if($this->getLoader()->broadcast["sound"] == true){
				            $player->getLevel()->addSound(new NotificationSound($player->x, $player->y, $player->z), [$player]);
				            return true;
				        }
				        return true;
				    }
				    if($this->getLoader()->broadcast["broadcast-type"] == "title"){
				        $this->getLoader()->getServer()->broadcastTitle($this->getLoader()->getPrefix() . $this->getLoader()->getMessage(array_rand($this->getLoader()->broadcast["messages"])), "");
				        if($this->getLoader()->broadcast["sound"] == true){
				            $player->getLevel()->addSound(new NotificationSound($player->x, $player->y, $player->z), [$player]);
				            return true;
				        }
				        return true;
				    }
				    if($this->getLoader()->broadcast["broadcast-type"] == "popup"){
				        $this->getLoader()->getServer()->broadcastPopup($this->getLoader()->getPrefix() . $this->getLoader()->getMessage(array_rand($this->getLoader()->broadcast["messages"])));
				        if($this->getLoader()->broadcast["sound"] == true){
				            $player->getLevel()->addSound(new NotificationSound($player->x, $player->y, $player->z), [$player]);
				            return true;
				        }
				        return true;
				    }
				    if($this->getLoader()->broadcast["broadcast-type"] == "tip"){
				        $this->getLoader()->getServer()->broadcastTip($this->getLoader()->getPrefix() . $this->getLoader()->getMessage(array_rand($this->getLoader()->broadcast["messages"])));
				        if($this->getLoader()->broadcast["sound"] == true){
				            $player->getLevel()->addSound(new NotificationSound($player->x, $player->y, $player->z), [$player]);
				            return true;
				        }
				        return true;
				    }
		        }
		    }
		}
	}
}
