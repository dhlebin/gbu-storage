<?php

class ItemTest extends TestCase
{
    private $testItemId;
    private $realGroupId = 36;
    private $realUnitId = 3;

    protected function setUp()
    {
        $this->testItemId = null;
        parent::setUp();
    }

    public function testIndex()
    {
        $this->get('/api/v1/items')->seeJson(['alias' => 'wer']);
    }

    public function testStore()
    {
        $response = $this->call(
            'POST',
            '/api/v1/items',
            [
                'alias' => 'testtttt',
                'name' => 'name',
                'description' => 'desc',
                'group_id' => $this->realGroupId,
                'is_available' => 1,
                'unit_id' => $this->realUnitId
            ]
        );
        
        $content = json_decode($response->content());
        if (isset($content->data))
            $this->testItemId = $content->data->id;

        $this->assertEquals(201, $response->status());
        return $this->testItemId;
    }

    /**
     * @depends testStore
     */
    public function testOneItem($testItemId)
    {
        $this->get('/api/v1/items/' . $testItemId)->seeJsonContains(['id' => $testItemId]);
    }

    /**
     * @depends testStore
     */
    public function testPut($testItemId)
    {
        $this->put('/api/v1/items/' . $testItemId, ['alias' => 'three'])->seeJsonContains(['id' => $testItemId]);
    }

    /**
     * @depends testStore
     */
    public function testDelete($testItemId)
    {
        $this->delete('/api/v1/items/' . $testItemId)->assertResponseStatus(204);
    }
}
