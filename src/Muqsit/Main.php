<?php
namespace Muqsit;

use pocketmine\{Server, scheduler\PluginTask, plugin\PluginBase, event\Listener, utils\Config};
use Muqsit\Task;

class Main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this), 1);
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
    $p->sendPopup(TF::GRAY."You are playing on " . $cfg->get("server-name") . $cfg->get("server-type");
    }
  }
}
