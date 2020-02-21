<?php


namespace Learning\Student\Api\Data;


use phpDocumentor\Reflection\Types\Integer;

interface StudentInterface
{
    const NAME = 'name';

    /**
     * @param string $name
     * @return StudentInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param int $id
     * @return StudentInterface
     */
    public function setStudentId($id);

    /**
     * @return int
     */
    public function getStudentId();

    /**
     * @param string $class
     * @return StudentInterface
     */
    public function setClass($class);

    /**
     * @return string
     */
    public function getClass();

    /**
     * @param string $university
     * @return StudentInterface
     */
    public function setUniversity($university);

    /**
     * @return string
     */
    public function getUniversity();
}