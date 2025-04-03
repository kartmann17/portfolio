<?php

namespace App\Services;

use App\Models\EmailModel;
use App\Repository\EmailRepository;


class SendEmailService
{

    public function saveMessage($data)
{
    header('Content-Type: application/json');

    // // Vérification du reCAPTCHA
    // $secretKey = "YOUR_SECRET_KEY";
    // $recaptchaResponse = $_POST['g-recaptcha-response'];

    // // Vérification du CAPTCHA
    // $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    // $responseKeys = json_decode($response, true);

    // if (intval($responseKeys["success"]) !== 1) {
    //     // Si la vérification échoue
    //     http_response_code(400);
    //     echo json_encode(["status" => "error", "message" => "La vérification CAPTCHA a échoué."]);
    //     exit();
    // }

    // Vérification des champs obligatoires
    if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Les champs nom, email et message sont obligatoires."]);
        exit();
    }

    // Validation de l'email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Email invalide."]);
        exit();
    }

    // Préparation des données
    $data = [
        'name' => $data['name'],
        'email' => $data['email'],
        'object_message' => $data['object_message'] ?? null,
        'message' => $data['message'],
        'paiement' => $data['paiement'] ?? null,
        'offre' => $data['offre'] ?? null
    ];

    $emailModel = new EmailModel();
    $emailModel->hydrate($data);

    // Enregistrement en base
    if ($emailModel = (new EmailRepository())->create($data)) {
        // Envoi de l'email
        $this->sendEmail($data['email']);

        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "Votre message a été enregistré avec succès."]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement du message."]);
    }

    exit();
}


private function sendEmail($email)
{
    $to = $email;
    $subject = 'Confirmation de réception - Kréyatik Studio';

    $body = "
    <br><br>
    <table style='font-size: 0.9rem; color: #333; font-family: Arial, sans-serif; margin-top: 20px;'>
        <tr>
            <td style='padding-right: 15px;'>
                <img src='https://kreyatikstudio.fr/assets/images/logo.png' alt='Logo Kréyatik' width='80' style='border-radius: 6px;'>
            </td>
            <td>
                <strong style='font-size: 1rem; color: #0099CC;'>Kréyatik Studio</strong><br>
                Création de sites web sur-mesure<br>
                <a href='https://kreyatikstudio.fr' style='color: #FF6B6B; text-decoration: none;'>www.kreyatikstudio.fr</a><br>
                <span style='color: #777;'>📞 +33 6 12 34 56 78</span><br>
                <span style='color: #777;'>✉️ contact@kreyatikstudio.fr</span>
            </td>
        </tr>
    </table>

    <div style='font-family: Arial, sans-serif; color: #333;'>
        <div style='text-align: center; margin-bottom: 20px;'>
            <img src='https://kreyatikstudio.fr/assets/images/logo.png' alt='Kréyatik Studio' style='max-width: 150px;'>
        </div>

        <h2 style='color: #0099CC;'>Merci pour votre message !</h2>

        <p>Bonjour,</p>

        <p>Nous avons bien reçu votre demande.</p>

        <p>Notre équipe va l'étudier avec attention et reviendra vers vous dans un délai de <strong>24 heures maximum</strong>.</p>

        <p>En attendant, vous pouvez consulter nos offres ici :
            <br><a href='https://kreyatikstudio.fr/NosOffres' style='color: #FF6B6B;'>Voir les offres Kréyatik Studio</a>
        </p>

        <p>À très bientôt,<br>L’équipe Kréyatik Studio</p>

        <hr style='margin: 30px 0;'>
        <small style='font-size: 0.8rem;'>Ce message est généré automatiquement, merci de ne pas y répondre.</small>
    </div>
    ";

    $adminEmail = 'kreyatik@gmail.com'; 

    $emailService = new EmailService();
    try {

        $emailService->sendEmail($to, $subject, $body, null, null, null, $adminEmail);
    } catch (\Exception $e) {
        error_log("Erreur lors de l'envoi de l'email: " . $e->getMessage());
    }
}
}
