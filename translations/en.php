<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'nERP',
        'locale_code' => 'en-US',
        'language_label' => 'Language',
        'theme' => [
            'toggle' => 'Toggle theme',
            'light' => 'Light',
            'dark' => 'Dark',
            'mezen' => 'Mezen folk art',
        ],
        'noscript' => 'JavaScript is disabled. Some functionality may be limited.',
    ],
    'meta' => [
        'title' => 'nERP — Web3 ERP Builder | nerp.app',
        'description' => 'Visit nerp.app to assemble CRM, HR, and inventory workflows in a single day. The nERP Web3 ERP builder keeps data encrypted locally, scales via nodes, and charges only for real actions.',
        'keywords' => 'Web3 ERP, CRM builder, HR automation, decentralized inventory, encrypted data, micro payments',
        'og_title' => 'nERP — Web3 ERP Builder',
        'og_description' => 'Build CRM, HR, and inventory in one day. Your data stays with you, payments only for activity.',
    ],
    'nav' => [
        'for' => 'Who it is for',
        'why' => 'Why nERP',
        'how' => 'How it works',
        'pricing' => 'Pricing',
        'partners' => 'Partners',
        'pilots' => 'Pilot program',
        'faq' => 'FAQ',
    ],
    'hero' => [
        'tags' => ['Web3.0', 'Encryption', 'No tiers'],
        'title' => 'Web3.0 ERP builder',
        'lead' => 'Build CRM, HR, and inventory in one day. Data is encrypted locally and stays with you. Scale the node network and only pay for the actions performed.',
        'primary_cta' => 'Join the pilot',
        'secondary_cta' => 'Watch demo',
        'feature_cards' => [
            [
                'icon' => 'zap',
                'title' => 'Up and running in a day',
                'desc' => 'Modular blocks, no heavy integrations required.',
            ],
            [
                'icon' => 'lock',
                'title' => 'Zero vendor lock-in',
                'desc' => 'Secrets and keys always stay on your side.',
            ],
            [
                'icon' => 'wallet',
                'title' => 'No subscription tiers',
                'desc' => 'Micropayments only for actual operations.',
            ],
        ],
    ],
    'audience' => [
        'title' => 'Who nERP is for',
        'subtitle' => 'Pick a profile — content and examples will adapt.',
        'options' => [
            'business' => [
                'icon' => 'building',
                'title' => 'Businesses',
                'desc' => 'Launch CRM/HR/Inventory fast without long integrations.',
            ],
            'integrator' => [
                'icon' => 'plug',
                'title' => 'Integrators',
                'desc' => 'Embed and earn a share from every transaction.',
            ],
            'dev' => [
                'icon' => 'code',
                'title' => 'Developers',
                'desc' => 'Ship modules and monetise real usage.',
            ],
        ],
        'pitches' => [
            'business' => [
                'icon' => 'shield',
                'title' => 'Launch processes in hours',
                'desc' => 'Ready-made CRM/HR/Inventory blocks plus automated access policies. No server procurement.',
            ],
            'integrator' => [
                'icon' => 'coins',
                'title' => 'Share in transactions',
                'desc' => 'Connect clients to the network and earn up to 30% from micropayments per action.',
            ],
            'dev' => [
                'icon' => 'boxes',
                'title' => 'Module marketplace',
                'desc' => 'Publish features and get paid automatically based on usage.',
            ],
        ],
        'cta' => 'Apply for pilot access',
    ],
    'why' => [
        'title' => 'Why teams choose nERP',
        'blocks' => [
            [
                'icon' => 'layers',
                'title' => 'Blocks like LEGO®',
                'desc' => 'Mix CRM, HR, inventory, and custom workflows together.',
            ],
            [
                'icon' => 'shield',
                'title' => 'Encryption by default',
                'desc' => 'Keys stay with you. Nodes only see encrypted blocks.',
            ],
            [
                'icon' => 'cpu',
                'title' => 'Automated actions',
                'desc' => 'Microservices react to events and eliminate manual work.',
            ],
        ],
    ],
    'how' => [
        'title' => 'How it works',
        'items' => [
            [
                'title' => 'Connect an nERP node',
                'desc' => 'Deploy on your hardware or in the cloud. Data stays fully under your control.',
            ],
            [
                'title' => 'Select modules and roles',
                'desc' => 'Activate CRM, HR, inventory, then extend with custom blocks. Manage granular access.',
            ],
            [
                'title' => 'Launch your workflows',
                'desc' => 'Automation handles operations while you only pay for user actions.',
            ],
        ],
    ],
    'pricing' => [
        'title' => 'What nERP costs',
        'subtitle' => 'Only pay for actions performed. Adjust the calculator to estimate.',
        'team_size' => 'Team size',
        'actions_per_day' => 'Actions per person per day',
        'monthly_actions' => 'Actions per month',
        'nerp_total' => 'nERP spend',
        'usd_equivalent' => 'USD equivalent',
        'hint' => 'Numbers are indicative and depend on the modules you activate.',
        'locale' => 'en-US',
        'currency' => 'USD',
        'micro_fee' => 'Pay only for actions performed.',
        'primary_cta' => 'Book a pilot call',
    ],
    'partners' => [
        'title' => 'For partners and module authors',
        'cards' => [
            [
                'icon' => 'percent',
                'title' => '30% from transactions',
                'desc' => 'Lifetime revenue share from client activity.',
            ],
            [
                'icon' => 'boxes',
                'title' => 'Module marketplace',
                'desc' => 'Monetise features based on actual usage.',
            ],
            [
                'icon' => 'plug',
                'title' => 'Plug-and-play rollout',
                'desc' => 'Plug & play instead of lengthy integrations.',
            ],
        ],
    ],
    'logos' => [
        'eyebrow' => 'Pilots and integrations',
        'brands' => ['Astra', 'Orion', 'Mercury', 'Helix', 'Nord', 'Sigma'],
        'quote' => '“We assembled CRM+HR in two days with no server or integrator required. Paying per action keeps budgets transparent.”',
        'quote_author' => 'Acme LLC',
    ],
    'pilots' => [
        'title' => 'Join the nERP pilot program',
        'subtitle' => 'Leave a request to roll out your first workflows on nerp.app together with our team.',
        'form_title' => 'Pilot access request',
        'fields' => [
            'name' => 'Full name',
            'email' => 'Work email',
            'company' => 'Company or team',
            'message' => 'What processes do you want to launch first?',
        ],
        'placeholders' => [
            'name' => 'Jane Doe',
            'email' => 'team@company.com',
            'company' => 'Acme Inc.',
            'message' => 'CRM for pilots, HR automation, inventory for 3 hubs…',
        ],
        'submit' => 'Request pilot access',
        'success' => 'Thank you! We will contact you within one business day.',
        'errors' => [
            'general' => 'Could not save your request. Please try again later.',
            'required' => 'This field is required.',
            'email' => 'Enter a valid email address.',
        ],
    ],
    'cta' => [
        'title' => 'Ready to try it?',
        'subtitle' => 'Spin up an ERP in minutes and run your first workflow today.',
        'primary_cta' => 'Join the pilot',
        'secondary_cta' => 'Watch demo',
    ],
    'faq' => [
        'title' => 'Frequently asked questions',
        'items' => [
            [
                'question' => 'Who can see my data?',
                'answer' => 'Keys and access policies stay local. Nodes only view encrypted chunks.',
            ],
            [
                'question' => 'How is access managed?',
                'answer' => 'Granular policies at block level plus instant revocation without rewriting data.',
            ],
            [
                'question' => 'Is onboarding complex?',
                'answer' => 'Not at all. Pick modules, connect a node, and launch processes. Support lives inside the product.',
            ],
        ],
    ],
    'footer' => [
        'copyright' => '© :year nERP. All rights reserved.',
        'links' => [
            ['label' => 'Privacy', 'href' => '#'],
            ['label' => 'Docs', 'href' => '#'],
            ['label' => 'Contact', 'href' => '#'],
        ],
    ],
    'language_switcher' => [
        'label' => 'Interface language',
    ],
    'floating_cta' => 'Join the pilot',
];
