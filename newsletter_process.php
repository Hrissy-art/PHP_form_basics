<?php

require_once 'functions.php';
require_once 'functions/newsletter.php';

// Return early pattern

if (!isset($_POST['email'])) {
    redirect('newsletter.php');
}

$email = $_POST['email'];
$emailsFilePath = __DIR__ . '/emails.txt';
$spamDomainsFilePath = __DIR__ . '/spam_domains.txt';

// 2 - Validations

// S'assurer que l'email n'est pas vide: 
if (empty($email)) {
    redirect("newsletter.php?error=" . EMAIL_EMPTY);
}

// Valider le format de l'adresse email
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    redirect("newsletter.php?error=" . EMAIL_INVALID . "&email=$email");
}

// Éviter les doublons
$emails = file($emailsFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (in_array($email, $emails)) {
    redirect("newsletter.php?error=" . EMAIL_DUPLICATE . "&email=$email");
}

// Vérifier que le domaine n'est pas un spam
$emailDomain = ltrim(strstr($email, '@'), '@');
$spamDomains = file($spamDomainsFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (in_array($emailDomain, $spamDomains)) {
    redirect("newsletter.php?error=" . EMAIL_SPAM . "&email=$email");
}

registerEmail($emailsFilePath, $email);
redirect('subscription_confirm.php?email=' . $email);