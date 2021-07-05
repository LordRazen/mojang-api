# mojang-api
A PHP Library for requests to the Mojang API or the Mojang Skinservers.

Include the MojangAPI:
`use Minecraft\MojangAPI;`  

Get UUID from Playername
`MojangAPI::getUuidFromName('LordRazen);`
result: 8d0a41175a764b72a7dc67b555119fef
`MojangAPI::getUuidFromName('ThisIsNotAPlayerName);`
result: false

MojangAPI::getValueFromUUID();

MojangAPI::validateSkinFileExists();

MojangAPI::getSkinFile();

MojangAPI::getAllNamesFromUUID();