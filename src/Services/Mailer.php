<?php
declare(strict_types=1);

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class Mailer
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendOrderConfirmation(string $recipientEmail, array $orderData): void
    {
        $name = (string)$orderData['name'];
        $quantity = (int)$orderData['quantity'];
        $totalAmount = (string)$orderData['totalAmount'];
        $streetName = (string)$orderData['streetName'];
        $houseNumber = (int)$orderData['houseNumber'];
        $zipCode = (string)$orderData['zip'];
        $city = (string)$orderData['city'];
        $country = (string)$orderData['country'];

        $email = (new Email())
            ->from(new Address('bestellung@deinshop.local', 'Dein Shop')) // Guter Stil: Absendername hinzufügen
            ->to($recipientEmail)
            ->subject('Ihre Bestellung: Bio Bin')
            ->text(sprintf("
            Vielen Dank für Ihre Bestellung %s!
            Sie haben %d Mülltonnen für insgesamt %s bestellt.\n \n
            Lieferadresse: \n
            %s, %d
            %s, %s
            %s
            ", $name, $quantity, $totalAmount, $streetName, $houseNumber, $zipCode, $city, $country)
            );

        $this->mailer->send($email);
    }
}
