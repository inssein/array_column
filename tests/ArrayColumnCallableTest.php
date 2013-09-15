<?php
class ArrayColumnCallableTest extends \PHPUnit_Framework_TestCase
{
    protected $recordSet;

    public function testFirstNameColumnFromRecordSet()
    {
        $expected = array('John', 'Sally', 'Jane');

        $this->assertEquals(
            $expected,
            array_column(
                $this->recordSet,
                function (stdClass $row) {
                    return $row->first_name;
                }
            )
        );
    }

    public function testIdColumnFromRecordSet()
    {
        $expected = array(1, 2, 3);
        $this->assertEquals(
            $expected,
            array_column(
                $this->recordSet,
                function (stdClass $row) {
                    return $row->id;
                }
            )
        );
    }

    public function testLastNameColumnKeyedByIdColumnFromRecordSet()
    {
        $expected = array(1 => 'Doe', 2 => 'Smith', 3 => 'Jones');
        $this->assertEquals(
            $expected,
            array_column(
                $this->recordSet,
                function (stdClass $row) {
                    return $row->last_name;
                },
                function (stdClass $row) {
                    return $row->id;
                }
            )
        );
    }

    public function testLastNameColumnKeyedByFirstNameColumnFromRecordSet()
    {
        $expected = array('John' => 'Doe', 'Sally' => 'Smith', 'Jane' => 'Jones');
        $this->assertEquals(
            $expected,
            array_column(
                $this->recordSet,
                function (stdClass $row) {
                    return $row->last_name;
                },
                function (stdClass $row) {
                    return $row->first_name;
                }
            )
        );
    }

    protected function setUp()
    {
        $this->recordSet = array(
            $this->getMockObject(1, 'John', 'Doe'),
            $this->getMockObject(2, 'Sally', 'Smith'),
            $this->getMockObject(3, 'Jane', 'Jones')
        );
    }

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @return Object
     */
    protected function getMockObject($id, $firstName, $lastName)
    {
        $obj = new stdClass();
        $obj->id = $id;
        $obj->first_name = $firstName;
        $obj->last_name = $lastName;

        return $obj;
    }
} 