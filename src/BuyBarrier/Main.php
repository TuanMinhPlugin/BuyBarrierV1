<?php
namespace BuyBarrier;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
class Main extends PluginBase{
	
	public function onEnable(){
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		
		switch($cmd->getName()){
			
			case "buybarrier":
				if($sender instanceof Player){
					$economy = EconomyAPI::getInstance();
          $mymoney = $economy->myMoney($sender);
          $cash = 35000;
          if($mymoney >= $cash){
            $economy->reduceMoney($sender, $cash);
            $sender->sendMessage("you have successfully purchased 1 barrier");
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "give " . $sender->getName() . " 95");
            return true;
          } else {
            $sender->sendMessage("you have enough money");
				}
			}
			return true;
		}
	}
}