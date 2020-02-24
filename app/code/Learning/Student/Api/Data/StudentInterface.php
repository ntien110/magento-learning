<?php
namespace Learning\Student\Api\Data;

/**
 * Interface for student model
 *
 * @api
 * @since 0.0.1
 */
interface StudentInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const NAME = 'name';

    const STUDENT_ID = 'student_id';

    const CLASS_NAME = 'class';

    const UNIVERSITY = 'university';
    /**#@+*/

    /**
     * set student name
     *
     * @param string $name
     * @return StudentInterface
     */
    public function setName($name);

    /**
     * student name
     *
     * @return string
     */
    public function getName();

    /**
     * set student ID
     *
     * @param int $id
     * @return StudentInterface
     */
    public function setStudentId($id);

    /**
     * student ID
     *
     * @return int
     */
    public function getStudentId();

    /**
     * set student class
     *
     * @param string $class
     * @return StudentInterface
     */
    public function setClass($class);

    /**
     * student class
     *
     * @return string
     */
    public function getClass();

    /**
     * set student university
     * @param string $university
     * @return StudentInterface
     */
    public function setUniversity($university);

    /**
     * student university
     *
     * @return string
     */
    public function getUniversity();
}
