<?php

namespace Jason8831\Chat;

use Jason8831\Chat\Events\PlayerChatEvents;
use Jason8831\Chat\Events\PlayerJoinEvents;
use Jason8831\Chat\Events\PlayerQuitEvents;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{

    public Config $config;

    /**
     * @var Main
     */
    private static $instance;

    public function onEnable(): void
    {

        self::$instance = $this;

        $this->getLogger()->info("§f[§l§4Advenced Chat Webhooks§r§f]: activée");
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents(new PlayerChatEvents(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerJoinEvents(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerQuitEvents(), $this);
    }

    public static function getInstance(): self{
        return self::$instance;
    }
}