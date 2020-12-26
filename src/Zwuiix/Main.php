<?php

namespace Zwuiix;

use pocketmine\level\{Position, Level};
use pocketmine\math\Vector3;
use pocketmine\entity\projectile\SplashPotion;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\inventory\BaseInventory;
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\Armor;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\Block;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\ItemFactory;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\entity\Human;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\entity\{Effect, EffectInstance};
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\scheduler\Task;
use pocketmine\level\sound\AnvilBreakSound;
use pocketmine\level\sound\PopSound;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\inventory\CraftingManager;
use pocketmine\inventory\ShapedRecipe;
use pocketmine\nbt\JsonNbtParser;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\BatchPacket;
use pocketmine\network\mcpe\protocol\CraftingDataPacket;
use pocketmine\timings\Timings;
use pocketmine\event\player\PlayerKickEvent;

class Main extends PluginBase implements Listener {

    public static $instance;

    public function onEnable() {

        self::$instance = $this;

        $this->saveDefaultConfig();
        $this->reloadConfig();

        $this->getServer()->getPluginManager()->registerEvents($this,$this);

        $this->saveResource("config.yml");

    }

    public function onnLoad(){
      $this->reloadConfig();
    }

    public static function getInstance() : Main {

        return self::$instance;

    }

    public function onDamage(EntityDamageByEntityEvent $event) : void {

      $entity = $event->getEntity();
      $damager = $event->getDamager();

      if ($entity instanceof Player) {
          
          $event->setAttackCooldown($this->getConfig()->get("Attackcooldowwn"));
          $event->setKnockBack($this->getConfig()->get("Knockback"));


      }



  }
}