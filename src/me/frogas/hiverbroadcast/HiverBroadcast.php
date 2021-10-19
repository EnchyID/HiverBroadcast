<?php

namespace me\frogas\hiverbroadcast;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use me\frogas\hiverbroadcast\task\BroadcastTask;

class HiverBroadcast extends PluginBase implements Listener {
	
	public $broadcast = [];
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("Enable by @Frogas");
		$this->saveResource("broadcast.yml");
		$this->broadcast_data = new Config($this->getDataFolder() . "broadcast.yml", Config::YAML);
		$this->broadcast = $this->broadcast_data->getAll();
		$this->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), $this->broadcast["delay"]);
	}
	
	public function getPrefix(){
        return $this->broadcast["prefix"] . " ";
	}
	
	public function getMessage(int $numeric){
		return $this->setReplace($this->broadcast["messages"][$numeric]);
	}
	
	public function setReplace(string $text){
		$text = str_replace("[G]", "§a", $text);
		$text = str_replace("[B]", "§l", $text);
		$text = str_replace("[C]", "§c", $text);
		$text = str_replace("[F]", "§f", $text);
		$text = str_replace("[R]", "§r", $text);
		$text = str_replace("[E]", "§e", $text);
		$text = str_replace("[D]", "§d", $text);
		$text = str_replace("[A]", "§b", $text);
		$text = str_replace("[O]", "§o", $text);
		$text = str_replace("[N]", "§n", $text);
		$text = str_replace("[L]", "§n", $text);
		return $text;
	}
}
