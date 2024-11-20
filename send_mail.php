<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $otherSubject = isset($_POST['otherSubject']) ? filter_var($_POST['otherSubject'], FILTER_SANITIZE_STRING) : '';
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Si "Autre" est sélectionné, utilisez le sujet personnalisé
    if ($subject === 'Autre') {
        $subject = $otherSubject;
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    // Préparation de l'email
    $to = "pokemin@alwaysdata.net";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Vous avez reçu un message via le formulaire de contact :\n\n";
    $body .= "Sujet : $subject\n";
    $body .= "Message :\n$message\n";
    $body .= "\n---\nEmail de l'expéditeur : $email";

    // Envoi de l'email
    if (mail($to, $subject, $body, $headers)) {
        echo "Votre message a été envoyé avec succès !";
        header('Location: /contact.html?message=ok');
        exit();
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
        header('Location: /contact.html?message=non-ok');
        exit();
    }
} else {
    echo "Méthode non autorisée.";
}
