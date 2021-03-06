<?php

class DepotOrganizationRoleTest extends TestCase
{
    private $testId;
    private $url = '/api/v1/depot_organization_roles/';
    private $realId = 1;
    private $realDepotId = 1;

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
                'organization_id' => 12,
                'user_role_id' => 12,
                'role' => 'artisan'
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
