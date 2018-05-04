<?php
namespace niluap\core;

/**
 * Class Mail
 * @package niluap\core
 * Class to send a mail. When creating an new object of this class you just have to specify the mail address.
 * Then you can use the newMail() function
 */
class Mail {

    private $ownerMail;

    public function __construct(string $mail) {
        $this->ownerMail = $mail;
    }

    /**
     * @param $subject
     * @param $message
     * @param $headers
     * Send the mail and make an alert success.
     */
    public function newMail(string $subject, string $message, string $headers) {
        mail($this->ownerMail, $subject, $message, $headers);
        Alert::setAlert('Votre message a bien été envoyé !', 'success');
        header('Location: ' . Router::getUrl('contact'));
    }

}