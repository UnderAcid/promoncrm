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
            'mezen' => 'Mezen',
        ],
        'noscript' => 'JavaScript is disabled. Some functionality may be limited.',
    ],
    'meta' => [
        'title' => 'nERP — Web3 ERP Builder | nerp.app',
        'description' => 'Assemble CRM, HR, and inventory workflows in a single day. nERP on nerp.app keeps data encrypted locally, scales through nodes, and charges only for real actions.',
        'keywords' => 'Web3 ERP, CRM builder, HR automation, decentralized inventory, encrypted data, micro payments, nerp.app',
        'og_title' => 'nERP — Web3 ERP Builder at nerp.app',
        'og_description' => 'Build CRM, HR, and inventory in one day. Your data stays with you, payments only for activity on nerp.app.',
    ],
    'nav' => [
        'for' => 'Who it is for',
        'why' => 'Why nERP',
        'how' => 'How it works',
        'pricing' => 'Pricing',
        'partners' => 'Partners',
        'faq' => 'FAQ',
    ],
    'hero' => [
        'tags' => ['Web3.0', 'Encryption', 'No tiers'],
        'title' => 'Web3.0 ERP builder nERP',
        'lead' => 'Build CRM, HR, and inventory in one day on nerp.app. Data is encrypted locally and stays with you. Scale the node network and only pay for actions performed.',
        'primary_cta' => 'Join the pilot',
        'secondary_cta' => 'Watch overview',
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
        'cta' => 'Request pilot access',
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
        'primary_cta' => 'Discuss the pilot',
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
    'pilots' => [
        'title' => 'Join the nERP pilots',
        'subtitle' => 'We are onboarding limited pilots on nerp.app: get the product team on your side, migrate data safely, and validate micropayment economics.',
        'points' => [
            [
                'icon' => 'rocket',
                'title' => 'Launch in two weeks',
                'desc' => 'We assemble CRM/HR/Inventory modules, map workflows, and sign the pilot SLA.',
            ],
            [
                'icon' => 'shield',
                'title' => 'Secure migration',
                'desc' => 'Local encryption, rollback planning, and staging snapshots before going live.',
            ],
            [
                'icon' => 'sparkles',
                'title' => 'Direct product team',
                'desc' => 'Gain direct access to the nERP team and the nerp.app roadmap.',
            ],
        ],
        'form' => [
            'title' => 'Apply for access',
            'name' => 'Your name',
            'email' => 'Work email',
            'company' => 'Company or project',
            'message' => 'Which processes do you want to run in the pilot?',
            'submit' => 'Submit request',
            'success' => 'Thank you! The nERP team will reach out within 24 hours.',
            'error' => 'Please check the form — required fields are missing.',
            'errors' => [
                'name' => 'Enter your name.',
                'email' => 'Add a valid work email.',
                'company' => 'Tell us about your company or project.',
                'message' => 'Describe the workflows for the pilot.',
            ],
        ],
    ],
    'logos' => [
        'eyebrow' => 'Pilots and integrations',
        'brands' => ['Astra', 'Orion', 'Mercury', 'Helix', 'Nord', 'Sigma'],
        'quote' => '“We assembled CRM+HR in two days with no server or integrator required. Paying per action keeps budgets transparent.”',
        'quote_author' => 'Acme LLC',
    ],
    'cta' => [
        'title' => 'Ready to launch on nerp.app?',
        'subtitle' => 'A pilot proves Web3 ERP security and micropayment economics for your workflows.',
        'primary_cta' => 'Become an nERP pilot',
        'secondary_cta' => 'Explore the architecture',
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
            ['label' => 'Privacy', 'href' => 'https://nerp.app/legal'],
            ['label' => 'Docs', 'href' => 'https://nerp.app/docs'],
            ['label' => 'Contact', 'href' => 'mailto:team@nerp.app'],
        ],
    ],
    'language_switcher' => [
        'label' => 'Interface language',
    ],
    'floating_cta' => 'Apply for the pilot',
];
