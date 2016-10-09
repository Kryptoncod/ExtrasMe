<?php

return [

    'myCredit' => [
        'recharge' => [
            'title' => 'RECHARGER VOS CREDITS',
            'number' => 'NOMBRE DE CREDITS',
            'price' => 'PRIX',
            'pricePerPost' => 'PRIX PAR ANNOUNCE',
            'pay' => 'CONTINUER',
        ],

        'invoice' => [
            'title' => 'VOS FACTURES',
            'due' => 'VOS FACTURES EN COURS DE TRAITEMENT',
            'content' => 'Facture du ',
            'noDueInvoice' => 'Vous n\'avez pas de facture en cours de traitement',
            'past' => 'VOS ANCIENNES FACTURES',
            'download' => 'TELECHARGER',
            'noPastInvoice' => 'Vous n\'avez d\'ancienne facture',
        ],
    ],

    'confirmation' => [
        'title' => 'CONFIRMER VOTRE PAIEMENT',
        'select' => 'Vous avez séléctionné <span style="color: blue">:number</span> annonces en ligne pour <span style="color: blue">:price</span> CHF',
        'emailAddress' => 'E-MAIL : ',
        'password' => 'MOT DE PASSE : ',
        'pay' => 'PAYER MAINTENANT',
    ],

    'option' => [
        'title' => 'OPTION DE PAIEMENT',
        'content' => 'Conscient que le temps est extrêmement précieux dans le monde de l’hôtellerie et de la restauration nous mettons à votre disposition un service sur mesure pour que vous puissiez accomplir vos paiements en toute sécurité. <br/><br/>

        Nous vous proposons de payer vos forfaits de trois manières différentes. <br/><br/>

        Si vous souhaitez payer vos forfaits en paiement en ligne nous vous prions de cocher la case « Je paye en ligne » et de suivre les indications sur le site. Automatiquement, vous serez crédité sur votre profil du nombre d’annonce correspondant au forfait que vous avez choisis. <br/><br/>

        Si vous souhaitez payer vos forfaits par virement bancaire nous vous prions de cocher la case « Je paye par virement bancaire ». Vous trouverez notre IBAN. Une fois le virement reçus, nous créditerons sur votre profil le nombre d’annonce correspondant au forfait que vous avez choisis. <br/><br/>

        SI vous souhaitez payer en espèce nous vous prions de cocher la case « Je paye en espèce ».  Joignez-nous au téléphone au +41 79 732 16 09 ou par mail à contact@extrasme.com et informez nous d’un lieu et d’une heure de rendez-vous et nous serons présent pour collecter votre paiement. Nous pourrons ainsi créditer votre compte en ligne afin que vous commenciez au plus tôt de bénéficier de nos services.',
        'cash' => 'JE PAYE EN ESPECE',
        'online' => 'JE PAYE EN LIGNE',
        'transfer' => 'JE PAYE PAR VIREMENT BANCAIRE',
        'modalCash' => [
            'title' => 'Payement par espèce',
            'content' => 'Merci d’avoir choisi l’option de paiement en espèce. Nous reviendrons vers vous dans les plus brefs délais afin de collecter le montant correspondant au forfait de votre choix. Dans l’attente de cette collecte, nous vous mettons à disposition 1/5 des crédits du forfait que vous avez choisi afin que vous puissiez déjà utiliser nos services. Nous vous invitons à aller voir nos terms and conditions (a mettre en bleu et il clique dessus et arrive sur la page terms and conditions section paiement) pour les modalités et délais de paiement.',
            'validate' => 'Valider',
        ],
        'modalTransfer' => [
            'title' => 'Payement par virement',
            'content' => 'Merci d’avoir choisi l’option de paiement par virement bancaire. Une fois votre paiement reçu, nous ajouterons les crédits correspondant au forfait que vous avez choisi sur votre compte Extras Me. Dans l’attente de la réception de votre paiement, nous vous mettons à disposition 1/5 de ces crédits. Nous vous invitons à aller voir nos terms and conditions (a mettre en bleu et il clique dessus et arrive sur la page terms and conditions section paiement) pour les modalités et délais de paiements.',
            'validate' => 'Valider',
        ],
    ],

];
