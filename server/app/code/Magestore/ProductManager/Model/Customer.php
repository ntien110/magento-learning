<?php
namespace Magestore\ProductManager\Model;

use Magento\Framework\Model\AbstractModel;
use Magestore\ProductManager\Api\Data\CustomerInterface as CustomerInterface;
use Magestore\ProductManager\Model\ResourceModel\Customer as ResourceModel;
use Magestore\ProductManager\Model\ResourceModel\Customer\Collection as ResourceCollection;
use Magento\Framework\Registry as Registry;
use Magento\Framework\Model\Context as Context;

/**
 * Customer model
 */
class Customer extends AbstractModel implements CustomerInterface
{
    /**
     * Customer constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param ResourceModel $resource
     * @param ResourceCollection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ResourceModel $resource,
        ResourceCollection $resourceCollection,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->_getData($this::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId(int $id)
    {
        return $this->setData($this::CUSTOMER_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->_getData($this::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name)
    {
        return $this->setData($this::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getBillingTelephone()
    {
        return $this->_getData($this::BILLING_TELEPHONE);
    }

    /**
     * @inheritDoc
     */
    public function setBillingTelephone(string $phoneNumber)
    {
        return $this->setData($this::BILLING_TELEPHONE, $phoneNumber);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->_getData($this::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail(string $email)
    {
        return $this->setData($this::EMAIL, $email);
    }
}
