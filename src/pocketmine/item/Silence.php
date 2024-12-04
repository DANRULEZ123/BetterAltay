<?php

namespace pocketmine\item;

use pocketmine\block\Block;
use pocketmine\Player;

class Silence extends Item {

    public function __construct(int $meta = 0){
        parent::__construct(self::SILENCE_ARMOR_TRIM_SMITHING_TEMPLATE, $meta, "Silence Smithing Template");
    }

    public function getMaxStackSize(): int {
        return 64;
    }
}