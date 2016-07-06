<?php

class UnitTest extends TestCase
{
    private $testId;
    private $url = '/api/v1/units/';
    private $realId = 10;

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
                'name' => 'name',
                'designation' => 'text',
                'decimal_symbol_count' => 1,
                'min_value' => 2,
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
        $this->put($this->url . $testId, ['min_value' => 123])->seeJsonContains(['min_value' => 123]);
    }

    /**
     * @depends testStore
     */
    public function testDelete($testId)
    {
        $this->delete($this->url . $testId)->assertResponseStatus(204);
    }
}
