<?php

namespace App\Http\Controllers\EmailService;

//require("vendor/autoload.php");

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Exception;

class EmailServiceController extends Controller
{


    public function sendRecoverPasswordEmail($email, $name, $url)
    {
        if (!isset($email) || !isset($name) || !isset($url)) {
            return false;
        }
        // Configure API key authorization: api-key
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

        // Uncomment below line to configure authorization using: partner-key
        // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

        $apiInstance = new \SendinBlue\Client\Api\SMTPApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(),
            $config
        );
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
        $sendSmtpEmail['sender'] = array('email' => 'general@artifactink.pt', 'name' => 'Artifact Ink');
        $sendSmtpEmail['to'] = array(array('email' => $email, 'name' => $name));
        $sendSmtpEmail['subject'] = 'Reset Password Request';
        
        $content = $this->htmlResetPasswordEmail();
        $htmlContent = sprintf($content, $name, $url, $url);

        $sendSmtpEmail['htmlContent'] = $htmlContent;
        $sendSmtpEmail['textContent'] = 'SENDINBLUE AUTO EMAIL';
        $sendSmtpEmail['params'] = array('name' => 'John', 'surname' => 'Doe');
        $sendSmtpEmail['headers'] = array('X-Mailin-custom' => 'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling SMTPApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            return false;
        }

        return true;
    }

    public function sendConfirmResetPasswordEmail($email, $name) {
        if (!isset($email) || !isset($name)) {
            return false;
        }
        // Configure API key authorization: api-key
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

        // Uncomment below line to configure authorization using: partner-key
        // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

        $apiInstance = new \SendinBlue\Client\Api\SMTPApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(),
            $config
        );
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
        $sendSmtpEmail['sender'] = array('email' => 'general@artifactink.pt', 'name' => 'Artifact Ink');
        $sendSmtpEmail['to'] = array(array('email' => $email, 'name' => $name));
        $sendSmtpEmail['subject'] = 'Reset Password Request';
        
        $content = $this->htmlConfirmResetPasswordEmail();
        $htmlContent = sprintf($content, $name);

        $sendSmtpEmail['htmlContent'] = $htmlContent;
        $sendSmtpEmail['textContent'] = 'SENDINBLUE AUTO EMAIL';
        $sendSmtpEmail['params'] = array('name' => 'John', 'surname' => 'Doe');
        $sendSmtpEmail['headers'] = array('X-Mailin-custom' => 'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling SMTPApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            return false;
        }

        return true;
    }

    public function sendNewsletterEmail($email) {
    
    }

    public function htmlResetPasswordEmail()
    {
        return "<html>

        <head>
            <title>Artifact Ink</title>
        
            <style>
                body {
                    background-color: #eeeeee;
                    text-align: center;
                }
        
                section.main {
                    margin: auto;
                    margin-top: 1em;
                    max-width: 800px;
                    background-color: white;
                    padding: 2em 0em;
                }
        
                article.content {
                    margin: auto;
                    padding: 0em 1em;
                    font-size: 18px;
                    color: #555555;
                    text-align: start;
                }
        
                article.content .highlight {
                    color: black;
                }
        
                div.button-container {
                    padding: 1em; text-align: center;
                }
        
                div.button-container a {
                    color: #F1F1F2;
                }
        
                .button {
                    text-decoration: none;
                    cursor: pointer;
                    border-radius: 0;
                    background-color: #8C4748;
                    color: #F1F1F2;
                    border-color: #8C4748;
                }
        
                .button:hover {
                    background-color: #731F20;
                    color: #F1F1F2;
                    border-color: #731F20;
                }
        
                .button:active,
                .button:focus {
                    background-color: #8C4748;
                    color:  #F1F1F2;
                    border-color: #8C4748;
                    box-shadow: 0 0 0;
                }
        
                .btn {
                    padding: .5rem 1rem;
                    font-size: 1.25rem;
                    line-height: 1.5;
                    border-radius: .25rem;
        
                    display: inline-block;
                    font-weight: 400;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    border: 1px solid transparent;
                    line-height: 1.5;
                    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                }
        
                p.trouble {
                    text-align:center; 
                    color: #555555; 
                    margin-top: 3em; 
                    font-size: 14px;
                }
            </style>
        </head>
        
        <body style=\"font-family: Cambria, Cochin, Georgia, Times, serif;\">
            <div>
            <nav>
                <img src=\"https://web.fe.up.pt/~up201705985/images/artifact_ink_logo_letters.png\" alt=\"Logo\" width=\"400\" style=\"display: block;margin-left: auto;margin-right: auto;\">
            </nav>
        
            <section class=\"main\">
                <article class=\"content\">
                    <h3 class=\"highlight\">Hi %s,</h3>
                    <p>You recently requested to reset your password for your Artifact Ink account.</p>
                    <p>Click the button bellow to reset it.</p>
                    <div class=\"button-container\">
                        <a class=\"btn button\" href=\"%s\">Reset Password</a>
                    </div>
                    <p>If you did not request a password reset, please ignore this email. This password reset is only valid for
                        the next 30 minutes.</p>
                    <p>Thanks,<br>The Artifact Ink Team</p>
                </article>
        
                <p class=\"trouble\">If you're having trouble clicking the button, please follow this link <br>%s</p>
            </section>
        </div>
        </body>
        </html>";
    }

    public function htmlConfirmResetPasswordEmail()
    {
        return "<html>

        <head>
            <title>Artifact Ink</title>
        
            <style>
                body {
                    background-color: #eeeeee;
                    text-align: center;
                }
        
                section.main {
                    margin: auto;
                    margin-top: 1em;
                    max-width: 800px;
                    background-color: white;
                    padding: 2em 0em;
                }
        
                article.content {
                    margin: auto;
                    padding: 0em 1em;
                    font-size: 18px;
                    color: #555555;
                    text-align: start;
                }
        
                article.content .highlight {
                    color: black;
                }
            </style>
        </head>
        
        <body style=\"font-family: Cambria, Cochin, Georgia, Times, serif;\">
            <div>
            <nav>
                <img src=\"https://web.fe.up.pt/~up201705985/images/artifact_ink_logo_letters.png\" alt=\"Logo\" width=\"400\" style=\"display: block;margin-left: auto;margin-right: auto;\">
            </nav>
        
            <section class=\"main\">
                <article class=\"content\">
                    <h3 class=\"highlight\">Hi %s,</h3>
                    <p>The password for your Artifact Ink account has been resetted.</p>
                    <p>Thanks,<br>The Artifact Ink Team</p>
                </article>
            </section>
        </div>
        </body>
        </html>";
    }
}