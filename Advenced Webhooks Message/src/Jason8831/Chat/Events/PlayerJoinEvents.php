<?php

namespace Jason8831\Chat\Events;

use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;
use Jason8831\Chat\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

class PlayerJoinEvents implements Listener
{

    public function OnJoin(PlayerJoinEvent $event){

        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();

        if(!$player->hasPlayedBefore()){
            $message = str_replace("{player}", $player->getDisplayName(), $config->get("DescriptionNewJoin"));

        $newWebwoooks = new Webhook($config->get("LinkWebHooksNewJoin"));
        $newMessage = new Message();
            $embed = new Embed();

            $embed->setTitle($config->get("TitleNewJoin"));
            $embed->setDescription($message);
            $embed->setColor($config->get("ColorNewJoin"));
            $embed->setFooter($config->get("FooterNewJoin"));
            $embed->setThumbnail($config->get("ImageNewJoin"));
            $newMessage->addEmbed($embed);
            $newWebwoooks->send($newMessage);
        }else{
            $message = str_replace("{player}", $player->getDisplayName(), $config->get("DescriptionJoin"));

            $newWebwoooks = new Webhook($config->get("LinkWebHooksJoin"));
            $newMessage = new Message();
            $embed = new Embed();

            $embed->setTitle($config->get("TitleJoin"));
            $embed->setDescription($message);
            $embed->setColor($config->get("ColorJoin"));
            $embed->setFooter($config->get("FooterJoin"));
            $embed->setThumbnail($config->get("ImageJoin"));
            $newMessage->addEmbed($embed);
            $newWebwoooks->send($newMessage);
        }
    }

}