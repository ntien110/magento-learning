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
     * Set student name
     *
     * @param string $name
     * @return StudentInterface
     */
    public function setName($name);

    /**
     * Student name
     *
     * @return string
     */
    public function getName();

    /**
     * Set student ID
     *
     * @param int $id
     * @return StudentInterface
     */
    public function setStudentId($id);

    /**
     * Student ID
     *
     * @return int
     */
    public function getStudentId();

    /**
     * Set student class
     *
     * @param string $class
     * @return StudentInterface
     */
    public function setClass($class);

    /**
     * Student class
     *
     * @return string
     */
    public function getClass();

    /**
     * Set student university
     * @param string $university
     * @return StudentInterface
     */
    public function setUniversity($university);

    /**
     * Student university
     *
     * @return string
     */
    public function getUniversity();
}
