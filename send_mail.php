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

    // Préparation de l'email à l'administrateur
    $to_admin = "pokemin@alwaysdata.net";
    $headers_admin = "From: $email\r\n";
    $headers_admin .= "Reply-To: $email\r\n";
    $headers_admin .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body_admin = "Vous avez reçu un message via le formulaire de contact :\n\n";
    $body_admin .= "Sujet : $subject\n";
    $body_admin .= "Message :\n$message\n";
    $body_admin .= "\n---\nEmail de l'expéditeur : $email";

    // Préparation de l'email de réponse automatique
    $to_user = $email;
    $headers_user = "From: pokemin@alwaysdata.net\r\n";
    $headers_user .= "Reply-To: pokemin@alwaysdata.net\r\n";
    $headers_user .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body_user = "Bonjour,\n\n";
    $body_user .= "Merci d'avoir pris contact avec nous !\n\n";
    $body_user .= "Nous avons bien reçu votre message et nous reviendrons vers vous dans les plus brefs délais. Nous faisons tout notre possible pour répondre à vos demandes aussi rapidement que possible.\n\n";
    $body_user .= "En attendant, vous pouvez consulter notre FAQ ou visiter notre site pour plus d'informations : https://pokemin.alwaysdata.net/FAQ/\n\n";
    $body_user .= "Si votre demande est urgente, n'hésitez pas à nous par mail avec le sujet contenant << Urgent >>.\n\n";
    $body_user .= "Merci et à bientôt !\n\n";
    $body_user .= "Cordialement,\nL'équipe de PokeMin\npokemin@alwaysdata.net\nhttps://pokemin.alwaysdata.net";

    // Envoi de l'email à l'administrateur
    if (mail($to_admin, $subject, $body_admin, $headers_admin)) {
        // Envoi de l'email de réponse automatique à l'utilisateur
        if (mail($to_user, "Réponse automatique - Nous avons bien reçu votre message !", $body_user, $headers_user)) {
            echo "Votre message a été envoyé avec succès !";
            header('Location: /contact.html?message=ok');
            exit();
        } else {
            echo "Une erreur est survenue lors de l'envoi du message de confirmation.";
            header('Location: /contact.html?message=non-ok');
            exit();
        }
    } else {
        echo "Une erreur est survenue lors de l'envoi du message à l'administrateur.";
        header('Location: /contact.html?message=non-ok');
        exit();
    }
} else {
    echo "Méthode non autorisée.";
}
