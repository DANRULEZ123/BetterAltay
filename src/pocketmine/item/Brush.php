<?php

namespace pocketmine\item;

use pocketmine\block\Block;
use pocketmine\Player;

class Brush extends Item {

    public function __construct(int $meta = 0){
        parent::__construct(self::BRUSH, $meta, "Brush");
    }

    public function getMaxStackSize(): int {
        return 1;
    }
    // Add functionality for brushing suspicious sand and gravel (future implementation.)
}
