<?php
namespace User\Model;

use Common\Database\TecazAdapterInterface;

abstract class AbstractGraphTable
{

    public function __construct(TecazAdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /** @var TecazAdapterInterface */
    private $adapter;

    /**
     * @return TecazAdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param TecazAdapterInterface $adapter
     */
    public function setAdapter(TecazAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
} 