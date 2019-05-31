<?php


use Drupal\Tests\UnitTestCase;
use PHPUnit\Framework\TestCase;
use Drupal\social_api\Utility\SocialApiImplementerInstaller;
use Drupal\social_api\Annotation\Network;
use Drupal\Drupal\social_api\User\UserAuthenticator;


use Drupal\social_api\SocialApiDataHandler;

use Symfony\Component\HttpFoundation\Session\SessionInterface;




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
  protected $config;
  protected $session;
  protected $form = array();


  public function __construct()
   {
       parent::__construct();
   }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    $this->session = $this->getMock(SessionInterface::class);
    // enable any other required module
    parent::setUp();
    // $this->socialPostEntityDeleteForm = $this->getMock($SocialPostEntityDeleteForm::class, ['getRedirectUrl']);
  }


// test for \Annotation\Network
  public function testForAnnotationNetwork () {
    // mock object to our interface
    $net = new Network($this->form);
    $this->assertTrue($net instanceof Network);
  }

// test for \Utility\SoaiclApiImplementerInstaller
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
  $collection = new SocialApiImplementerInstaller();
  // Act.
  $collection->checkLibrary($this->machine_name, $this->name, $this->library, $this->min_version, $this->max_version);

}



}


 ?>
