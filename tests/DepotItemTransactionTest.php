<?php

class DepotItemTransactionTest extends TestCase
{
    private $testId;
    private $url = '/api/v1/depot_item_transactions/';
    private $realId = 15;
    private $realDepotItemOperationId = 1;

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
                'depot_item_operation_id' => $this->realDepotItemOperationId,
                'operation' => 'basic',
                'status' => 'hold',
                'delta' => 23,
                'date' => '12-12-2012'
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
        $this->put($this->url . $testId, ['status' => 'hold'])->seeJsonContains(['status' => 'hold']);
    }

    /**
     * @depends testStore
     */
    public function testDelete($testId)
    {
        $this->delete($this->url . $testId)->assertResponseStatus(204);
    }
}
