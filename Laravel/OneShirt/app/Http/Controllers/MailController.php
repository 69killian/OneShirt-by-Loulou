<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $mail = new PHPMailer(true);

        try {
            // Paramètres de configuration SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "martykillian7@gmail.com"; // Adresse e-mail de l'expéditeur
            $mail->Password = 'aqxkjugksblpvwpy'; // Mot de passe d'application GMAIL
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Paramètres du message
            $mail->setFrom($validatedData['email'], "{$validatedData['name']} {$validatedData['surname']}"); // Adresse e-mail de l'expéditeur
            $mail->addAddress("martykillian7@gmail.com"); // Adresse e-mail du destinataire
            $mail->isHTML(true);

            $mail->Subject = "Nouveau message de {$validatedData['name']} {$validatedData['surname']}";
            $mail->Body = "Ce message vous a été envoyé via la page contact du site OneShirt.com <br> Nom : <strong>{$validatedData['name']}</strong> <br> Prénom : <strong>{$validatedData['surname']}</strong><br> Mail : {$validatedData['email']}<br><br>Message : {$validatedData['message']}";

            // Permet à l'utilisateur de répondre à l'expéditeur directement depuis Gmail
            $mail->addReplyTo($validatedData['email']);

            // Envoi du message
            $mail->send();
            return response()->json(["message" => "Le message a été envoyé avec succès."], 200);
        } catch (Exception $e) {
            return response()->json(["error" => "Erreur d'envoi du message : {$mail->ErrorInfo}"], 500);
        }
    }
}
