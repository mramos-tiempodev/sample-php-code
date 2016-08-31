<?php
namespace User\Model;

use Neoxygen\NeoClient\Formatter\Response;

class UserGraphTable extends AbstractGraphTable
{

    /**
     * @param string $username
     * @return Response
     */
    public function getByUsername($username = '')
    {
        $username = 'MATCH (n) RETURN n';
        return $this->getAdapter()->query($username);
    }
}
