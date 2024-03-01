# mojang-api
A PHP Library for requests to the Mojang API or the Mojang Skinservers.  
Official Minecraft Wiki about the API: https://minecraft.fandom.com/de/wiki/Mojang_API

<br>

## Installation
`composer require lordrazen/mojang-api`

<br>

## Use the MojangAPI:
Get UUID from Playername:  
`MojangAPI::getUuidFromName('LordRazen);`  
Result: 8d0a41175a764b72a7dc67b555119fef  

Get Value from UUID:  
`MojangAPI::getValueFromUUID('8d0a41175a764b72a7dc67b555119fef');`  
Result: ewogICJ0aW1lc3RhbXAiIDogMT...

Check if Skinfile Exists:
http://textures.minecraft.net/texture/d5c6dc2bbf51c36cfc7714585a6a5683ef2b14d47d8ff714654a893f5da622  
`MojangAPI::validateSkinFileExists('d5c6dc2bbf51c36cfc7714585a6a5683ef2b14d47d8ff714654a893f5da622');`  
Result: bool

Get Skinfile from Mojang Skin Servers:  
`MojangAPI::getSkinFile('d5c6dc2bbf51c36cfc7714585a6a5683ef2b14d47d8ff714654a893f5da622');`  
Result: GdImage

## Former Features
Get All Names from UUID (deprecated since Mojang stopped the API support):
`MojangAPI::getAllNamesFromUUID('8d0a41175a764b72a7dc67b555119fef);`  
Result: ["LordRazen"]

<br>
<hr>
www.minecraft-heads.com

![Minecraft Heads Banner](https://images.minecraft-heads.com/banners/minecraft-heads_halfbanner_234x60.png)