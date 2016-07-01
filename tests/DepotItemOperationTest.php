<?php

class DepotItemOperationTest extends TestCase
{
    private $testId;
    private $url = '/api/v1/depot_item_operations/';
    private $realItemId = 1;
    private $realDepotId = 1;
    private $realDepotItemId = 1;
    private $realStatus = 'rejected';
    private $realType = 'move';

    protected function setUp()
    {
        $this->testId = null;
        parent::setUp();
    }

    public function testIndex()
    {
        $this->get($this->url)->seeJson(['status' => $this->realStatus]);
    }

    public function testStore()
    {
        $response = $this->call(
            'POST',
            $this->url,
            [
                'item_id' => $this->realItemId,
                'depot_id' => $this->realDepotId,
                'depot_item_id' => $this->realDepotItemId,
                'status' => $this->realStatus,
                'type' => $this->realType,
                'opposite_operation_id' => 3,
                'date_closed' => '12-12-2012'
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
        $this->put($this->url . $testId, ['status' => $this->realStatus])->seeJsonContains(['status' => $this->realStatus]);
    }
}
