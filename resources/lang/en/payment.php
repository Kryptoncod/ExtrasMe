<?php

return [

    'myCredit' => [
        'recharge' => [
            'title' => 'RECHARGE YOUR CREDITS',
            'number' => 'NUMBER OF CREDITS',
            'price' => 'PRICE',
            'pricePerPost' => 'PRICE PER POST',
            'pay' => 'PROCEED TO PAYMENT',
        ],

        'invoice' => [
            'title' => 'YOUR INVOICE',
            'due' => 'BELOW HERE ARE YOUR DUE INVOICE',
            'content' => 'Invoice of the ',
            'noDueInvoice' => 'You don\'t have due invoices.',
            'past' => 'YOUR PAST INVOICE',
            'download' => 'DOWNLOAD',
            'noPastInvoice' => 'You don\'t have past invoices.',
        ],
    ],

    'confirmation' => [
        'title' => 'CONFIRM YOUR PAYMENT',
        'select' => 'You have selected <span style="color: blue">:number</span> announces online for <span style="color: blue">:price</span> CHF',
        'emailAddress' => 'E-MAIL : ',
        'password' => 'PASSWORD : ',
        'pay' => 'PAY NOW',
    ],

    'option' => [
        'title' => 'PAYMENT OPTION',
        'content' => 'Aware that time is extremely valuable in the world of hotels and catering, we offer you a bespoke service for you to accomplish your payments safely.
        <br/><br/>
        We propose you to pay your packages in three different ways.
        <br/><br/>
        If you wish to pay your packages using online payment please select the "I pay online" and follow the instructions on the website. The number of ads matching the package you have chosen will be automatically credited to your profile.
        <br/><br/>
        If you wish to pay your packages by bank transfer please select the "I pay by bank transfer". You will then find our IBAN. Once the deposit received, we will credit your profile with the number of ads matching the package you have chosen.
        <br/><br/>
        If you wish to pay by cash please select the "I pay cash." Join us on the phone +41 79 732 16 09 or by e-mail at contact@extrasme.com and choose a place and a time of appointment and we will be present to collect your payment. We will then credit your online account so that you can start to benefit from our services as quickly as possible.',
        'cash' => 'I PAY IN CASH',
        'online' => 'I PAY ONLINE',
        'transfer' => 'I MAKE A TRANSFER',
        'modalCash' => [
            'title' => 'Payment by cash',
            'content' => 'Thank you for choosing the payment by cash option. We will contact you as soon as possible to collect the amount corresponding to the package you have picked. Pending this collection, we will give you access to 1/5 of the credits of the package so that you can already use our services. We invite you to visit our <span style="color:#90aaff;"> terms and conditions </span> for the payment forms and deadlines.',
            'validate' => 'Validate',
        ],
        'modalTransfer' => [
            'title' => 'Payment by transfer',
            'content' => 'Thank you for choosing the payment by bank transfer option. Once your payment received, we will add the credits corresponding to the package you have chosen on your Extras Me account. Pending the reception of your payment, we will give you access to 1/5 of these credits. We invite you to visit our <span style="color:#90aaff;">terms and conditions</span> for the payment forms and deadlines.',
            'validate' => 'Validate',
        ],
    ],

];
