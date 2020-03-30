<?php
namespace Magestore\ProductManager\Api\Data;

/**
 * Interface CustomerInterface
 *
 * @package Magestore\ProductManager\Api\Data
 */
interface CustomerInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const CUSTOMER_ID = "entity_id";

    const NAME = "name";

    const EMAIL = "email";

    const BILLING_TELEPHONE = "billing_telephone";
    /**#@+*/

    /**
     * Get customer's id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set customer's id
     *
     * @param int $id
     * @return $this
     */
    public function setCustomerId(int $id);

    /**
     * Get customer's name
     *
     * @return string
     */
    public function getName();

    /**
     * Set customer's name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * Get customer's billing telephone
     *
     * @return string
     */
    public function getBillingTelephone();

    /**
     * Set customer's billing telephone
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setBillingTelephone(string $phoneNumber);

    /**
     * Get customer's email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set customer's email
     *
     * @param string email
     * @return $this
     */
    public function setEmail(string $email);
}