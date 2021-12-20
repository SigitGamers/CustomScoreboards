<?php

/**
 * _____ ____  ______ ____ ________
 */ ____\|  | | -----\|  | |__  __|
 *\____ \|  | | |__| ||  |   |  |
 */_____/|__| |______||__|   |__|
 */
   
namespace SigitGamers\CustomScoreboard;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\utils\Config;
use pocketmine\utils\Color;
use SigitGamers\CustomScoreboard\Task\ScoreTask;
use SigitGamers\CustomScoreboard\Scoreboards\Scoreboard;

use pocketmine\scheduler\Task;

class Main extends PluginBase implementasi Listener{

  public static $instance;
  private static $score;
  
  public function onEnable(): void {
    self::$instance = $this;
    foreach(["confirm.yml"] as $config){
       $this->saveRecources($config);
    }
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info("§aEnable!");
    self::$score = new Scoreboard();
    
    $this->getScheduler()->schedulerDelayedTask(new ScoreTask($this), (20));
  }
  
    /**
     * @return Loader
     */
    public static function getInstance() : Main{
        return self::$instance;
    }

    public function getScoreboardData(): array
    {
        $cf = (new Config($this->getDataFolder()."config.yml",Config::YAML));
        return $cf->getAll();
    }
    
    public static function getScore(){
        return self::$score;
    }
    
    public function onDisable(): void{
       $this->getLogger()->info("§cDisable!");
    }
}
