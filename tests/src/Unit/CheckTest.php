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



  /**
   * __construct function
   */
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


  /**
   * testForAnnotationNetwork
   * @return assertions
   */
  public function testForAnnotationNetwork () {
    // assertion to check if the file exists
    $this->assertFileExists('../drupal8/modules/social_api/src/Annotation/Network.php');
    // mock object to our interface and checking for instances
    $net = new Network($this->form);
    $this->assertTrue($net instanceof Network);
    $WFC = new Network($this->form);
    $WF =  $this->getMock('Drupal\social_api\Annotation\Plugin');
    $this->assertTrue((new ReflectionClass($WF))->getParentClass()->getName() != $WFC);
    // assertArray and other methods are not working here.
  }

  /**
   * [testSimpleMockDisplayManager description]
   * @return [type] [description]
   */
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

  /**
   * [testToCamelCaseInvalidInput description]
   * @return [type] [description]
   */
  public function testToCamelCaseInvalidInput() {
    // Arrange.
    // $collection = new SocialApiImplementerInstaller();
    $collection = new SocialApiImplementerInstaller();

    // Act.
    $collection->checkLibrary($this->machine_name, $this->name, $this->library, $this->min_version, $this->max_version);

  }



}


 ?>
