<?php
namespace Wall\Controller;

use Exception;
use User\Model\UserGraphTable;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Neoxygen\NeoClient\Request\Response as Neo4JResponse;

class IndexController extends AbstractRestfulController
{
    /** @var UserGraphTable */
    private $userGraphTable;

    public function __construct(UserGraphTable $userGraphTable)
    {
        $this->setUserGraphTable($userGraphTable);
    }

    public function getList()
    {
        $this->methodNotAllowed();
    }

    public function create($data)
    {
        $this->methodNotAllowed();
    }

    public function update($id, $data)
    {
        $this->methodNotAllowed();
    }

    public function delete($id)
    {
        $this->methodNotAllowed();
    }

    /**
     * @param mixed $username
     *
     * @return JsonModel
     * @throws Exception
     */
    public function get($username)
    {
        /** @var Neo4JResponse $userData */
        $userData = $this->getUserGraphTable()->getByUsername($username);
        //$content = $userData->getRows();
        if ($userData !== false) {
            return new JsonModel(array('data' => $userData));
        } else {
            throw new Exception('User not found', 404);
        }
    }

    private function methodNotAllowed()
    {
        $this->response->setStatusCode(Response::STATUS_CODE_405);
    }

    /**
     * @return UserGraphTable
     */
    private function getUserGraphTable()
    {
        return $this->userGraphTable;
    }

    /**
     * @param UserGraphTable $userGraphTable
     */
    private function setUserGraphTable($userGraphTable)
    {
        $this->userGraphTable = $userGraphTable;
    }
}
