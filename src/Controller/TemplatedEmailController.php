<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class TemplatedEmailController extends AbstractController
{
/**
* @Route("/email")
*/
public function sendEmail(MailerInterface $mailer,string $emails, string $mailObject, string $text)
{
$email = new Email();
$email->from("samy.bury@gmail.com")
    ->to($emails)
    ->priority(Email::PRIORITY_HIGH)
    ->subject($mailObject)
    ->text($text);

$mailer->send($email);


}
}
?>