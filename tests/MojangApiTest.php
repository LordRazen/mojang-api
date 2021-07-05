<?php

/**
 * Test of MojangAPI Class
 *
 * @package		    Minecraft Heads
 * @author			LordRazen <http://www.minecraft-heads.com>	
 * @copyright		Copyright (C) 2020. All Rights Reserved
 */

use Minecraft\MojangAPI;
use PHPUnit\Framework\TestCase;

class MojangApiTest extends TestCase
{
    /**
     * Test getUuidFromName
     * The return value can be a UUID or false
     *
     * @test
     * @dataProvider dataSetUuidName
     */
    public function testGetUuidFromName(String $playername, $result)
    {
        $response = MojangAPI::getUuidFromName($playername);

        if ($result !== false) {
            # Response should be a UUID object
            $this->assertIsString($response);
            $this->assertEquals($response, $result);
        } else {
            # Respone is false since no real name was given
            $this->assertEquals(false, $result);
        }
    }

    public function dataSetUuidName()
    {
        return [
            ['LordRazen', '8d0a41175a764b72a7dc67b555119fef'],
            ['Notch', '069a79f444e94726a5befca90e38aaf5'],
            ['abcdefghijklmnpqrst', false]
        ];
    }

    /**
     * Test getValueFromUUID
     *
     * @test
     * @dataProvider dataSetNameValue
     */
    public function testGetValueFromUUID(array $data)
    {
        $response = MojangAPI::getValueFromUUID($data['uuid']);

        if ($data['isUuid']) {
            # Response should be a Value object
            $this->assertIsString($response);
        } else {
            # Response is no value
            $this->assertFalse($response);
        }
    }

    public function dataSetNameValue()
    {
        return [
            [
                [
                    'uuid' => '57f8712e-1ccf-4da8-b08f-addae6642c3d',
                    'isUuid' => true
                ]
            ],
            [
                [
                    'uuid' => 'thisisnouuid',
                    'isUuid' => false
                ]
            ]
        ];
    }

    /**
     * Test getSkinFile()
     * Test validateSkinFileExists() (implizit)
     *
     * @test
     * @dataProvider dataSetSkinFiles
     */
    public function testGetSkinFile(String $skinfileUrl, bool $expected)
    {
        $result = MojangAPI::getSkinFile($skinfileUrl);

        # Expected true -> String should be returned
        if ($expected) {
            $this->assertIsResource($result);
        }
        # Expected false -> Boolean false should be returned
        else {
            $this->assertFalse($result);
        }
    }

    /**
     * Test validateSkinFileExists()
     *
     * @test
     * @dataProvider dataSetSkinFiles
     */
    public function testValidateSkinFileExists(String $skinfileUrl, bool $expected)
    {
        $result = MojangAPI::validateSkinFileExists($skinfileUrl);
        $this->assertEquals($result, $expected);
    }

    public function dataSetSkinFiles()
    {
        return [
            ['d5c6dc2bbf51c36cfc7714585a6a5683ef2b14d47d8ff714654a893f5da622', true],
            ['dasgibtsnicht', false]
        ];
    }

    /**
     * Test getAllNamesFromUUID()
     *
     * @test
     * @dataProvider dataSetNames
     */
    public function testGetAllNamesFromUUID(String $uuid, String $names)
    {
        $result = MojangAPI::getAllNamesFromUUID($uuid);
        $this->assertEquals(json_encode($result), $names);
    }

    public function dataSetNames()
    {
        return [
            ['8d0a41175a764b72a7dc67b555119fef', '["LordRazen"]'],
            ['dcd9538627ff49f793dabeb125058df2', '{"0":"BadLady1998","1512312932":"MissPrincess98","1586369437":"Missi98"}']
        ];
    }
}
