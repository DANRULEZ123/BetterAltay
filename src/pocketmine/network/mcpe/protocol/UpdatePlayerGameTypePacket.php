<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol;

#include <rules/DataPacket.h>

use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\types\GameMode;

class UpdatePlayerGameTypePacket extends DataPacket/* implements ClientboundPacket*/
{
	public const NETWORK_ID = ProtocolInfo::UPDATE_PLAYER_GAME_TYPE_PACKET;

	/**
	 * @see GameMode
	 */
	private int $gameMode;
	private int $playerEntityUniqueId;
	private int $tick;


	public static function create(int $gameMode, int $playerEntityUniqueId, int $tick) : self{
		$result = new self;
		$result->gameMode = $gameMode;
		$result->playerEntityUniqueId = $playerEntityUniqueId;
		$result->tick = $tick;
		return $result;
	}

	public function getGameMode() : int{ return $this->gameMode; }

	public function getPlayerEntityUniqueId() : int{ return $this->playerEntityUniqueId; }

	public function getTick() : int{ return $this->tick; }

	protected function decodePayload() : void{
		$this->gameMode = $this->getVarInt();
		$this->playerEntityUniqueId = $this->getEntityUniqueId();
		$this->tick = $this->getUnsignedVarLong();
	}

	protected function encodePayload() : void{
		$this->putVarInt($this->gameMode);
		$this->putEntityUniqueId($this->playerEntityUniqueId);
		$this->putUnsignedVarLong($this->tick);
	}

	public function handle(NetworkSession $session) : bool{
		return $session->handleUpdatePlayerGameType($this);
	}
}
