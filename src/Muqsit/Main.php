<?php
namespace Muqsit;

use pocketmine\{Server, scheduler\PluginTask, plugin\PluginBase, event\Listener, utils\Config, utils\TextFormat as TF};
use Muqsit\Task;

class Main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this), 1);
    $this->saveDefaultConfig();
  }
}

class Task extends PluginTask{
  public function __construct($plugin){
    $this->plugin = $plugin;
    parent::__construct($plugin);
  }
  
  public function onRun($tick){
    $pl = $this->plugin->getServer()->getOnlinePlayers();
    $cfg = $this->plugin->getConfig();
    foreach($pl as $p){
    $p->sendPopup(TF::GRAY."You are playing on ".TF::BOLD.$cfg->get("server-name").TF::RESET." ".$cfg->get("server-type")."\n".TF::DARK_GRAY."[".TF::LIGHT_PURPLE.count($this->plugin->getServer()->getOnlinePlayers()).TF::DARK_GRAY."/".TF::LIGHT_PURPLE.$this->plugin->getServer()->getMaxPlayers().TF::DARK_GRAY."] | ".TF::YELLOW."$".$this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($p).TF::DARK_GRAY." | ".TF::BOLD.TF::AQUA."SHOP: ".TF::RESET.TF::GREEN."shop.cosmicpe.me");
    }
  }
}
