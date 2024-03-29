<?php

namespace core\classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{

    public function sendEmailNewAccount(string $email, string $name, string $token): bool
    {
        $url = BASE_URL . '?action=activate_account&token=' . $token;
        $mail = new PHPMailer(true);
        try {
            $this->configureEmail($mail);
            $this->configureTemplateNewAccount($mail, $email, $name, $url);
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendEmailRecoverPassword(string $email, string $name, string $token): bool
    {
        $url = BASE_URL . '?action=recover_account&token=' . $token;
        $mail = new PHPMailer(true);
        try {
            $this->configureEmail($mail);
            $this->configureTemplateRecoverPassword($mail, $email, $name, $url);
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function configureEmail(PHPMailer $mail): void
    {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_FROM;
        $mail->Password = EMAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
    }

    /**
     * @throws Exception
     */
    private function configureTemplateNewAccount(PHPMailer $mail, string $email, string $name, string $url): void
    {
        $mail->setFrom(EMAIL_FROM, APP_NAME);
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = APP_NAME . ' - Confirmação de E-mail';
        $html = '<p>Bem vindo ao ' . APP_NAME . '.</p>';
        $html .= '<p>Para entrar no jogo, você deve confirmar o e-mail.</p>';
        $html .= '<p>Clique abaixo para confirmar sua conta:</p>';
        $html .= "<p><a href='$url'>Confirmar a conta</a></p>";
        $html .= "<p>Se preferir copie e cole o link no navegador: $url</p>";
        $html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
        $mail->Body = $html;
    }

    /**
     * @throws Exception
     */
    private function configureTemplateRecoverPassword(PHPMailer $mail, string $email, string $name, string $url): void
    {
        $mail->setFrom(EMAIL_FROM, APP_NAME);
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = APP_NAME . ' - Recuperação de Senha';
        $html = '<p>Para recuperar sua senha siga as instruções abaixo.</p>';
        $html .= '<p>Clique abaixo para recuperar sua senha:</p>';
        $html .= "<p><a href='$url'>Recuperar a senha</a></p>";
        $html .= "<p>Se preferir copie e cole o link no navegador: $url</p>";
        $html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
        $mail->Body = $html;
    }
}