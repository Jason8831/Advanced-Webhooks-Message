<?php

namespace Jason8831\Chat\Events;

use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;
use Jason8831\Chat\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;

class PlayerQuitEvents implements Listener
{

    public function OnQuit(PlayerQuitEvent $event){
        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $event->setQuitMessage(" ");


        $message = str_replace("{player}", $player->getDisplayName(), $config->get("DescriptionLeave"));

        $newWebwoooks = new Webhook($config->get("LinkWebHooksLeave"));
        $newMessage = new Message();
        $embed = new Embed();

        $embed->setTitle($config->get("TitleLeave"));
        $embed->setDescription($message);
        $embed->setColor($config->get("ColorLeave"));
        $embed->setFooter($config->get("FooterLeave"));
        $embed->setThumbnail($config->get("ImageLeave"));
        $newMessage->addEmbed($embed);
        $newWebwoooks->send($newMessage);
    }

}