<?php

class ItemAttributeTest extends TestCase
{
    private $testId;
    private $realUnitId = 3;
    private $url = '/api/v1/item_attributes';

    protected function setUp()
    {
        $this->testId = null;
        parent::setUp();
    }

    public function testIndex()
    {
        $this->get($this->url)->seeJson(['unit_id' => $this->realUnitId]);
    }

    public function testStore()
    {
        $response = $this->call(
            'POST',
            $this->url,
            [
                'alias' => 'testttt',
                'name' => 'name',
                'type' => 'text',
                'unit_id' => $this->realUnitId
            ]
        );

        $content = json_decode($response->content());
        if (isset($content->data))
            $this->testId = $content->data->id;

        $this->assertEquals(201, $response->status());
        return $this->testId;
    }

    /**
     * @depends testStore
     */
    public function testOneItem($testId)
    {
        $this->get('/api/v1/items/' . $testId)->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     */
    public function testPut($testId)
    {
        $this->put('/api/v1/items/' . $testId, ['alias' => 'three'])->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     */
    public function testDelete($testId)
    {
        $this->delete('/api/v1/items/' . $testId)->assertResponseStatus(204);
    }
}
