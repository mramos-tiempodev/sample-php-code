<?php
namespace UnitTest\Wall\Controller;

use PHPUnit_Framework_MockObject_MockObject;
use User\Model\UserGraphTable;
use Wall\Controller\IndexControllerFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var IndexControllerFactory */
    private $sut;

    /** @var ServiceLocatorInterface|PHPUnit_Framework_MockObject_MockObject */
    private $serviceLocator;

    /** @var UserGraphTable|PHPUnit_Framework_MockObject_MockObject */
    private $userGraphTable;

    protected function setUp()
    {
        parent::setUp();

        $this->userGraphTable = $this->getMockBuilder('User\Model\UserGraphTable')
            ->disableOriginalConstructor()
            ->getMock();
        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->sut = new IndexControllerFactory();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sut);
        unset($this->serviceLocator);
        unset($this->userGraphTable);
    }

    public function testCreateService()
    {
        $this->serviceLocator->expects($this->any())
            ->method('getServiceLocator')
            ->will($this->returnValue($this->serviceLocator));

        $this->serviceLocator->expects($this->any())
            ->method('')
            ->will($this->returnValueMap(array(
                array('Tecaz.UserGraphTable', $this->userGraphTable )
            )));

        $actual = $this->sut->createService($this->serviceLocator);

        $this->assertInstanceOf('Wall\Controller\IndexController', $actual);
    }
}
 