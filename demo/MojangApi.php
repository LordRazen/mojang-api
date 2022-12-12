<title>MojangAPI Demo </title>
<?php

use Minecraft\MojangAPI;

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

echo 'Get UUID from Playername:';
var_dump(MojangAPI::getUuidFromName('LordRazen'));

echo 'Get Value from UUID:';
var_dump(MojangAPI::getValueFromUUID('8d0a41175a764b72a7dc67b555119fef'));

echo 'Check if Skinfile Exists:';
var_dump(MojangAPI::validateSkinFileExists('d5c6dc2bbf51c36cfc7714585a6a5683ef2b14d47d8ff714654a893f5da622'));

echo 'Get Skinfile from Mojang Skin Servers:';
var_dump(MojangAPI::getSkinFile('d5c6dc2bbf51c36cfc7714585a6a5683ef2b14d47d8ff714654a893f5da622'));
