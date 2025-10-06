<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'nERP',
        'tagline' => 'Web3 ERP without servers',
        'locale_code' => 'en-US',
        'language_label' => 'Language',
        'theme' => [
            'toggle' => 'Toggle theme',
            'label' => 'Theme',
            'light' => 'Light',
            'dark' => 'Dark',
        ],
        'noscript' => 'JavaScript is disabled. Some features may be limited.',
    ],
    'meta' => [
        'title' => 'nERP — Web3 ERP without servers | Pilot program',
        'description' => 'Build ERP in 1 day. Encryption, Web3, pay only per action. Join the 10 companies in our pilot.',
        'keywords' => 'Web3 ERP, nERP, serverless ERP, pilot program, encryption, pay per action',
        'og_title' => 'nERP — Web3 ERP without servers',
        'og_description' => 'Launch nERP in one day. Encryption, Web3 and pay-as-you-go.',
        'og_image_alt' => 'nERP flow diagram with encrypted data',
    ],
    'schema' => [
        'webpage_name' => 'nERP — serverless ERP',
        'webpage_description' => 'Web3 ERP with local encryption and pay-per-action billing. Pilot in one day.',
        'faq' => [
            [
                'question' => 'How fast can we launch nERP?',
                'answer' => 'We connect the first workflow in one day: align goals, grant access and onboard the team.',
            ],
            [
                'question' => 'How are the data protected?',
                'answer' => 'Data are encrypted end-to-end, keys remain with your team and nodes only see encrypted blocks.',
            ],
            [
                'question' => 'How many pilot slots are available?',
                'answer' => 'We onboard only 10 companies at once to keep the support personal and focused.',
            ],
        ],
    ],
    'language_switcher' => [
        'label' => 'Switch language',
    ],
    'nav' => [
        'toggle' => 'Menu',
        'hero' => 'Home',
        'pilot' => 'Pilot',
        'how' => 'How it works',
        'comparison' => 'Before & After',
        'apply' => 'Apply',
    ],
    'hero' => [
        'title' => 'ERP without servers or long rollouts. Go live in 1 day.',
        'lead' => 'Web3. Encryption. Pay only when your team acts.',
        'primary_cta' => 'Join the pilot program',
        'highlights_label' => 'Highlights',
        'highlights' => [
            'Web3 architecture',
            'End-to-end encryption',
            'Pay-per-action billing',
        ],
    ],
    'pilot' => [
        'title' => 'Pilot program',
        'subtitle' => 'We invite only 10 companies to join the pilot.',
        'benefits' => [
            [
                'title' => 'Priority support',
                'desc' => 'Dedicated team on duty 7 days a week to launch workflows without blockers.',
            ],
            [
                'title' => 'Custom terms',
                'desc' => 'We tailor flows, integrations and billing to your success metrics.',
            ],
            [
                'title' => 'Shape the tokenomics',
                'desc' => 'Co-create the product economy and secure a stake in the pilot model.',
            ],
        ],
    ],
    'infographic' => [
        'title' => 'How nERP works',
        'steps' => [
            [
                'title' => 'Data',
                'desc' => 'Import from CRM, warehouse, production or spreadsheets.',
            ],
            [
                'title' => 'Encryption',
                'desc' => 'Local encryption with role-based key distribution.',
            ],
            [
                'title' => 'nERP node',
                'desc' => 'Processing and routing without maintaining servers.',
            ],
            [
                'title' => 'Outcome',
                'desc' => 'Ready workflows, reporting and pay-per-action billing.',
            ],
        ],
    ],
    'comparison' => [
        'title' => 'Before vs After',
        'before' => [
            'title' => 'Traditional ERP',
            'points' => [
                'Months of roll-out and server procurement',
                'Vendor-controlled data storage',
                'High license fees and seat-based billing',
            ],
        ],
        'after' => [
            'title' => 'nERP',
            'points' => [
                'Launch in one day without servers',
                'End-to-end encryption with your keys',
                'Pay only for actual user actions',
            ],
        ],
    ],
    'urgency' => [
        'title' => 'Apply before the deadline',
        'text' => 'Applications are open until :date. Seats are limited.',
        'date' => '30 June 2024',
        'deadline_label' => 'Deadline: :date',
    ],
    'form' => [
        'title' => 'Apply for the pilot',
        'description' => 'Tell us what you want to automate and we will prepare a launch plan.',
        'fields' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'How should we address you?',
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'email@example.com',
            ],
            'company' => [
                'label' => 'Company (optional)',
                'placeholder' => 'Your company name',
            ],
            'automation' => [
                'label' => 'What do you want to automate?',
                'placeholder' => 'Describe the processes and the success metrics',
            ],
        ],
        'checkbox_label' => 'I want to join the pilot program',
        'submit' => 'Send application',
        'success' => 'Thank you! We will contact you shortly.',
        'error' => 'Something went wrong. Please try again.',
    ],
    'final_cta' => [
        'title' => 'Ready to launch ERP without servers?',
        'lead' => 'Connect your team to the secure nERP node and pay only for real actions.',
    ],
    'cta_repeat' => 'Join the pilot program',
    'floating_cta' => 'Join the pilot program',
    'footer' => [
        'copyright' => '© :year nERP',
        'links' => [
            [
                'href' => 'mailto:pilot@nerp.app',
                'label' => 'pilot@nerp.app',
            ],
            [
                'href' => 'https://t.me/nerp_app',
                'label' => 'Telegram',
            ],
            [
                'href' => 'https://x.com/nerp_app',
                'label' => 'X (Twitter)',
            ],
        ],
    ],
];
