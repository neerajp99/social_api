<?php


use Drupal\Tests\UnitTestCase;
use PHPUnit\Framework\TestCase;
use Drupal\social_api\Utility\SocialApiImplementerInstaller;
use Drupal\social_api\Annotation\Network;




/**
 * Simple test to ensure that asserts pass.
 *
 * @group social_api
 */

class UserAccessControlHandlerTest extends UnitTestCase {
  /**
   * Checks the library required by an implementer.
   *
   * @param string $machine_name
   *   The module machine name.
   *
   * @param string $name
   *   The module name.
   * @param string $library
   *   The library machine name.
   * @param float $min_version
   *   The min version required.
   * @param float $max_version
   *   The max version required.
   *
   * @return array
   *   Requirements messages.
   */
  public $machine_name;
  public $name;
  public $library;
  public $min_version;
  public $max_version;


  public function __construct()
   {
       parent::__construct();
   }
  /**
   * {@inheritdoc}
   */
  public function setUp() {

    // enable any other required module
    parent::setUp();
    // $this->socialPostEntityDeleteForm = $this->getMock($SocialPostEntityDeleteForm::class, ['getRedirectUrl']);
  }



  // public function testForAnnotationNetork () {
  //   // mock object to our interface
  //   $mock = $this->getMock('Drupal\social_api\Annotation\Network');
  //   // check if the mock object belongs to our interface
  //   $this->assertTrue($mock instanceof Network);
  // }

   public function testSimpleMockDisplayManager() {
   // mock object to our interface
   $mock = $this->getMock('Drupal\social_api\Utility\SocialApiImplementerInstaller');
   // check if the mock object belongs to our interface
   $this->assertTrue($mock instanceof SocialApiImplementerInstaller);

   /**
   * @expectedException \AssertionError
   * @expectedExceptionMessage Input must be a string.
   */
   $mock->expects($this->any())
          ->method('checkLibrary')
          ->will($this->returnValue('checkccheck'));

}


public function testToCamelCaseInvalidInput() {
  // Arrange.
  // $collection = new SocialApiImplementerInstaller();
  $collection = new SocialApiImplementerInstaller($machine_name, $name, $library, $min_version, $max_version);
  // Act.
  $collection->checkLibrary($machine_name, $name, $library, $min_version, $max_version);

}

}


 ?>
