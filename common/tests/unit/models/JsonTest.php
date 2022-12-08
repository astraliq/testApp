<?php
namespace common\tests\unit\models;

use common\fixtures\JsonFixture;
use common\models\JsonData;
use common\tests\UnitTester;

class JsonTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'json' =>[
                'class' => JsonFixture::class,
                'dataFile' => codecept_data_dir() . 'json.php',
            ]
        ]);
    }

    protected function _after()
    {
    }

    public function testCreateAllData()
    {
        $json = new JsonData([
            'user_id' => 5,
            'data' => '{"$jsonRequest": "123"}',
        ]);
        $this->assertTrue($json->save(), 'Json saved in db');
    }

    public function testCreateEmptyJson()
    {
        $json = new JsonData([
            'user_id' => 5,
            'data' => '{}',
        ]);
        $this->assertTrue($json->save(), 'Json saved in db');
    }

    public function testCreateNullJson()
    {
        $json = new JsonData([
            'user_id' => 5,
            'data' => null,
        ]);
        $this->assertFalse($json->save(), 'Json not saved in db');
    }

    public function testCreateEmptyUser()
    {
        $json = new JsonData([
            'user_id' => null,
            'data' => '{"$jsonRequest": 123}',
        ]);
        $this->assertFalse($json->save(), 'Json not saved in db');
    }

    public function testSaveAndFindJsonData()
    {
        $newJsonString = '{"jsonRequest": 123}';
        $jsonModel1 = new JsonData([
            'user_id' => 5,
            'data' => $newJsonString,
        ]);
        $jsonModel1->save();
        $jsonModel2 = JsonData::findOne(['id' => $jsonModel1->id]);
        $this->assertJsonStringEqualsJsonString($newJsonString, $jsonModel2->data, 'JsonModel save and find is OK');
    }

    public function testDeleteJsonData()
    {
        $jsonModel = JsonData::findOne(1);
        $this->assertNotNull($jsonModel, 'Json is find');
        $this->assertEquals(1, $jsonModel->delete(), 'Delete JSON is OK');
    }

    public function testUpdateJsonData()
    {
        $jsonModel = JsonData::findOne(1);
        $this->assertNotNull($jsonModel, 'Json is find');
        $jsonModel->data = '{"jsonRequest": "123"}';
        $this->assertTrue($jsonModel->save(), 'Json saved in db');
        $this->assertEquals(1, $jsonModel->delete(), 'Delete JSON is OK');
    }
}