<?php
namespace UnitTest\Wall\Controller;

use PHPUnit_Framework_MockObject_MockObject;
use User\Model\UserGraphTable;
use Wall\Controller\IndexController;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Stdlib\ResponseInterface;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var IndexController */
    private $sut;

    /** @var UserGraphTable|PHPUnit_Framework_MockObject_MockObject */
    private $userGraphTable;

    /** @var Request */
    private $request;

    /** @var RouteMatch */
    private $routeMatch;

    /** @var MvcEvent */
    private $event;

    protected function setUp()
    {
        parent::setUp();

        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'Wall\Controller\Index'));
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);

        $this->userGraphTable = $this->getMockBuilder('User\Model\UserGraphTable')
            ->disableOriginalConstructor()
            ->getMock();

        $this->sut = new IndexController($this->userGraphTable);
        $this->sut->setEvent($this->event);
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
        unset($this->userGraphTable);
        unset($this->request);
        unset($this->routeMatch);
        unset($this->event);
    }

    public function testGetList()
    {
        $result = $this->sut->dispatch($this->request);
        $this->sut->getList();
        /** @var ResponseInterface $response */
        $response = $this->sut->getResponse();
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testCreate()
    {
        $result = $this->sut->dispatch($this->request);
        $this->sut->create('');
        /** @var ResponseInterface $response */
        $response = $this->sut->getResponse();
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $result = $this->sut->dispatch($this->request);
        $this->sut->update('', '');
        /** @var ResponseInterface $response */
        $response = $this->sut->getResponse();
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testDelete()
    {
        $result = $this->sut->dispatch($this->request);
        $this->sut->delete('');
        /** @var ResponseInterface $response */
        $response = $this->sut->getResponse();
        $this->assertEquals(405, $response->getStatusCode());
    }

    /**
     * @expectedException \Exception
     */
    public function testGetExpectedException()
    {
        $result = $this->sut->dispatch($this->request);

        $this->userGraphTable->expects($this->any())
            ->method('getByUsername')
            ->will($this->returnValue(false));

        $this->sut->get('');
    }

    public function testGet()
    {
        $this->userGraphTable->expects($this->any())
            ->method('getByUsername')
            ->will($this->returnValue(array('var' => 'test')));

        $result = $this->sut->get('');

        $this->assertInstanceOf('Zend\View\Model\JsonModel', $result);
    }
}
 