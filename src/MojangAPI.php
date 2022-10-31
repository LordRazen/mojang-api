<?php

/**
 * Class  includes several methods to check the Mojang API
 * It also includes methods to fetch images from the Mojang Server, even if that's not really an API use ;-)
 *
 * @package		    Minecraft Heads
 * @author			LordRazen <http://www.minecraft-heads.com>	
 * @copyright		Copyright (C) 2020. All Rights Reserved
 */

namespace Minecraft;

class MojangAPI
{
    # Mojang API and URLs
    const MOJANG_UUID_FROM_USERNAME    = 'https://api.mojang.com/users/profiles/minecraft/';
    const MOJANG_VALUE_FROM_UUID       = 'https://sessionserver.mojang.com/session/minecraft/profile/';
    const MOJANG_NAMES_FROM_UUID_PART1 = 'https://api.mojang.com/user/profiles/';
    const MOJANG_NAMES_FROM_UUID_PART2 = '/names';
    const MOJANG_SKIN_URL              = 'http://textures.minecraft.net/texture/';

    /**
     * Get UUID from Playername
     *
     * @param String Playername
     * @return mixed false|String $uuid
     */
    public static function getUuidFromName(String $playername): mixed
    {
        $request = self::MOJANG_UUID_FROM_USERNAME . $playername . '?at=' . time();
        $response = json_decode(@file_get_contents($request), true);

        # Search for result
        if (!is_array($response))
            return false;

        if (!array_key_exists('id', $response))
            return false;

        return $response['id'];
    }

    /**
     * Get Value from UUID
     *
     * @param String $uuid
     * @return mixed false|String $value
     */
    public static function getValueFromUUID(String $uuid): mixed
    {
        $request = self::MOJANG_VALUE_FROM_UUID . $uuid;
        $response = json_decode(@file_get_contents($request), true);

        # Search for result
        if (!is_array($response))
            return false;

        if (!array_key_exists('properties', $response))
            return false;

        if (!array_key_exists('0', $response['properties']))
            return false;

        if (!array_key_exists('value', $response['properties'][0]))
            return false;

        return $response['properties'][0]['value'];
    }

    /**
     * Tests if a Skinfile on the Mojang servers exists, based on the $skinfileUrl
     * Technically this method dont use the Mojang API, it just validates an image from the Mojang Servers.
     *
     * @param String $skinfileUrl (partial or full)
     * @return bool $result
     */
    public static function validateSkinFileExists(String $skinfile): bool
    {
        if (!is_int(strpos($skinfile, self::MOJANG_SKIN_URL)))
            $skinfile = self::MOJANG_SKIN_URL . $skinfile;

        $header = @get_headers($skinfile);
        return (!$header || $header[0] == 'HTTP/1.1 404 Not Found')
            ? false
            : true;
    }

    /**
     * Method fetch a Skinfile based on the skinfileUrl from the Mojang servers.
     * Technically this method dont use the Mojang API, it just fetch an image from the Mojang Servers.
     *
     * @param String $skinfileUrl (partial or full)
     * @return mixed false|GdImage $skin
     */
    public static function getSkinFile(String $url): mixed
    {
        # Add MOJANG_SKIN_URL base if necessary
        if (!is_int(strpos($url, self::MOJANG_SKIN_URL)))
            $url = self::MOJANG_SKIN_URL . $url;

        # Image exists
        if (self::validateSkinFileExists($url)) {
            $skinfile = imagecreatefromstring(@file_get_contents($url));
            imagealphablending($skinfile, false);
            imagesavealpha($skinfile, true);
            return $skinfile;
        }
        # Image doesnt exist
        return false;
    }

    // /**
    //  * Get all playernames from a UUID
    //  * 
    //  * MOJANG STOPPED THIS API! DEPRECATED METHOD!
    //  * 
    //  * @deprecated
    //  * @param String $uuid (Trimmed)
    //  * @return mixed false|array $playernames
    //  */
    // public static function getAllNamesFromUUID(String $uuid): mixed
    // {
    //     $request = self::MOJANG_NAMES_FROM_UUID_PART1 . $uuid . self::MOJANG_NAMES_FROM_UUID_PART2;
    //     $response = json_decode(@file_get_contents($request));

    //     # No response, return false
    //     if ($response == NULL)
    //         return false;

    //     # Return playernames
    //     $playernames = array();
    //     foreach ($response as $playername) {
    //         if (empty($playername->changedToAt)) {
    //             $playernames[0] = $playername->name;
    //         } else {
    //             # Cut of last three characters from timestamp. The timestamp is in Milliseconds, but seconds are needed
    //             $playernames[substr($playername->changedToAt, 0, -3)] = $playername->name;
    //         }
    //     }

    //     return $playernames;
    // }
}
