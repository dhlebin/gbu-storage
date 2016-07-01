<?php

class DepotItemTest extends TestCase
{
    private $testId;
    private $url = '/api/v1/depot_items/';
    private $realId = 1;
    private $realDepotId = 1;
    private $realItemId = 6;

    protected function setUp()
    {
        $this->testId = null;
        parent::setUp();
    }

    public function testIndex()
    {
        $this->get($this->url)->seeJson(['id' => $this->realId]);
    }

    public function testStore()
    {
        $response = $this->call(
            'POST',
            $this->url,
            [
                'depot_id' => $this->realDepotId,
                'item_id' => $this->realItemId,
                'amount' => 12,
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
    public function testGetById($testId)
    {
        $this->get($this->url . $testId)->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     */
    public function testPut($testId)
    {
        $this->put($this->url . $testId, ['id' => $testId])->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     */
    public function testDelete($testId)
    {
        $this->delete($this->url . $testId)->assertResponseStatus(204);
    }
}
