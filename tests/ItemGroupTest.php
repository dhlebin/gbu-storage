<?php

class ItemGroupTest extends TestCase
{
    private $testId;
    private $realParentId = 36;
    private $realAlias = 'nerudka';
    private $url = '/api/v1/itemgroups/';

    protected function setUp()
    {
        $this->testId = null;
        parent::setUp();
    }

    public function testIndex()
    {
        $this->get($this->url)->seeJson(['alias' => $this->realAlias]);
    }

    public function testStore()
    {
        $response = $this->call(
            'POST',
            $this->url,
            [
                'alias' => 'testttt',
                'name' => 'name',
                'description' => 'text',
                'is_available' => 1,
                '_lft' => 1,
                '_rgt' => 2,
                'parent_id' => $this->realParentId
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
        $this->get($this->url . $testId)->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     */
    public function testPut($testId)
    {
        $this->put($this->url . $testId, ['alias' => 'three'])->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     */
    public function testDelete($testId)
    {
        $this->delete($this->url . $testId)->assertResponseStatus(204);
    }

    /**
     * @depends testStore
     * 
     */
    public function testParent($testId) 
    {
        $this->get($this->url . $testId . '/parent')->seeJsonContains(['id' => $testId]);
    }

    /**
     * @depends testStore
     *
     */
    public function testChildren($testId)
    {
        $this->get($this->url . $testId . '/children')->seeJsonContains([]);
    }

    /**
     * @depends testStore
     *
     */
    public function testAncestors($testId)
    {
        $this->get($this->url . $testId . '/ancestors')->seeJsonContains(['id' => $this->realParentId]);
    }
}
