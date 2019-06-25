<?php

namespace Drupal\social_api\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Class SocialPost
 */
class SocialApi extends ContentEntityBase implements ContentEntityInterface {
  use EntityChangedTrait;

  /**
   * The unique salt generated for drupal installation.
   *
   * @var string
   */
  protected $key;

  /**
   * Constructor.
   * Inittializes a salt value to key.
   */
  public function __construct() {
    $this->key = $this->getSalt();
  }

  /**
  * Sets the access token.
  *
  * @param string $token
  *   The serialized access token.
  *
  * @return \Drupal\social_auth\Entity\SocialAuth
  *   Drupal Social Auth Entity.
  */
 public function setToken($token) {
   $token = $this->encryptToken($token);
   $this->set('token', $token);
   return $this;
 }

 /**
  * Returns the serialized access token.
  *
  * @return string
  *   The serialized access token.
  */
 public function getToken() {
   $token = $this->get('token')->value;
   return $this->decryptToken($token);
 }

 /**
  * Returns the encrypted token.
  *
  * @param string $token
  *   Tokens provided by social provider.
  *
  * @return string
  *   The encrypted token.
  */
 protected function encryptToken($token) {
   $key = $this->key;

   // Remove the base64 encoding from our key.
   $encryption_key = base64_decode($key);

   // Generate an initialization vector.
   $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

   // Encrypt the data using AES 256 encryption in CBC mode
   // using our encryption key and initialization vector.
   $encrypted = openssl_encrypt($token, 'aes-256-cbc', $encryption_key, 0, $iv);

   // The $iv is just as important as the key for decrypting,
   // so save it with our encrypted data using a unique separator (::).
   return base64_encode($encrypted . '::' . $iv);
 }

 /**
  * Decrypt the encrypted token.
  *
  * @param string $token
  *   Encrypted token stored in database.
  *
  * @return string
  *   Token in JSON format.
  */
 protected function decryptToken($token) {
   $key = $this->key;

   // Remove the base64 encoding from our key.
   $encryption_key = base64_decode($key);

   // To decrypt, split the encrypted data from our IV -
   // our unique separator used was "::".
   list($encrypted_data, $iv) = explode('::', base64_decode($token), 2);
   return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
 }

 /**
  * Get salt for this drupal installation.
  *
  * @return string
  *   Hash salt.
  */
 public function getSalt() {
   $hash_salt = Settings::getHashSalt();

   if (empty($hash_salt)) {
     return FALSE;
   }
   return $hash_salt;
 }

}
