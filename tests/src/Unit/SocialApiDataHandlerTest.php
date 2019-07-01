<?php

use Drupal\social_api\SocialApiDataHandler;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Drupal\Tests\UnitTestCase;

/**
 * Defines SocialApiDataHandler class.
 *
 * @Annotation
 */
class SocialApiDataHandlerTest extends UnitTestCase {

  /**
   * Interface for the session.
   *
   * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
   */
  protected $session;
 
  /**
   * Variables are written to and read from session via this class.
   *
   * @var \Drupal\social_api\SocialApiDataHandler
   */
  protected $socialApiDataHandler;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->session = $this->getMock(SessionInterface::class);

    $this->socialApiDataHandler = $this->getMockBuilder(SocialApiDataHandler::class)
      ->setConstructorArgs([$this->session])
      ->setMethods(NULL)
      ->getMockForAbstractClass();
  }

  /**
   * Tests for class SocialApiDataHandler.
   */
  public function testSocialApiDataHandler() {
    $key = "drupal";
    $value = "drupal123";

    $this->socialApiDataHandler->set($key, $value);

    $this->socialApiDataHandler->setSessionPrefix('1234');

    $this->session->expects($this->any())
      ->method('get')
      ->willReturn($this->socialApiDataHandler->getSessionPrefix() . $key);

    $this->assertEquals('1234_', $this->socialApiDataHandler->getSessionPrefix());
    $this->assertEquals('1234_drupal', $this->socialApiDataHandler->get($key));
  }

}
