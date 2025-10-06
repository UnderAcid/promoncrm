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
        'noscript' => 'JavaScript is disabled. Some features may work in a limited mode.',
    ],
    'meta' => [
        'title' => 'nERP — Web3 ERP without servers | Pilot program',
        'description' => 'Assemble an ERP in 1 day. Encryption, Web3, pay-per-action billing. Join the cohort of 10 pilot companies.',
        'keywords' => 'nERP, Web3 ERP, encryption, pilot program, pay per action',
        'og_title' => 'nERP — Web3 ERP without servers',
        'og_description' => 'Launch nERP in 1 day: encryption, Web3, pay-per-action billing. Only 10 seats in the pilot.',
        'og_image_alt' => 'nERP Web3 ERP infographic',
    ],
    'schema' => [
        'webpage_name' => 'nERP — Web3 ERP without servers',
        'webpage_description' => 'Build ERP without implementation projects: 1-day onboarding, Web3 encryption and pay-per-action pricing.',
        'faq' => [
            [
                'question' => 'How fast can we launch nERP?',
                'answer' => 'We connect a pilot in 1 day: provision the node, configure roles and enable the first workflow.',
            ],
            [
                'question' => 'What is included in the pilot program?',
                'answer' => 'Priority support, tailored commercial terms and co-design of the tokenomics.',
            ],
            [
                'question' => 'How does billing work?',
                'answer' => 'You pay only for real user actions. No servers to maintain and no yearly licenses.',
            ],
            [
                'question' => 'Is the data secure?',
                'answer' => 'Data is encrypted client-side. You keep the keys, the node sees encrypted blocks only.',
            ],
        ],
    ],
    'language_switcher' => [
        'label' => 'Switch language',
    ],
    'nav' => [
        'toggle' => 'Menu',
        'hero' => 'Overview',
        'pilot' => 'Pilot',
        'how' => 'How it works',
        'compare' => 'Before & After',
        'apply' => 'Apply',
    ],
    'hero' => [
        'title' => 'ERP without servers or integrations. Go live in 1 day.',
        'lead' => 'Web3. Encryption. Pay only for actions.',
        'primary_cta' => 'Join the pilot program',
        'secondary_cta' => 'Learn more',
    ],
    'landing' => [
        'hero_highlights' => ['Web3', 'Encryption', 'Pay-per-action'],
        'pilot' => [
            'title' => 'Pilot program',
            'description' => 'We are onboarding only 10 companies into the pilot.',
            'benefits' => [
                [
                    'title' => 'Priority support',
                    'desc' => 'A dedicated manager and engineers driving the pilot to measurable results.',
                ],
                [
                    'title' => 'Tailored terms',
                    'desc' => 'Flexible tokenomics and pricing aligned with your workflow.',
                ],
                [
                    'title' => 'Shape tokenomics',
                    'desc' => 'Co-create the product economics and roadmap together with us.',
                ],
            ],
        ],
        'flow' => [
            'title' => 'How nERP works',
            'steps' => [
                [
                    'label' => 'Data',
                    'desc' => 'Connect sources and define roles. No lengthy integrations required.',
                ],
                [
                    'label' => 'Encryption',
                    'desc' => 'Client-side keys and end-to-end protection. The node stores encrypted payloads only.',
                ],
                [
                    'label' => 'Node',
                    'desc' => 'A Web3 node keeps workflows, permissions, logs and pay-per-action billing.',
                ],
                [
                    'label' => 'Result',
                    'desc' => 'Your team works in one system and pays only for real usage.',
                ],
            ],
        ],
        'comparison' => [
            'title' => 'Before vs After',
            'before' => [
                'title' => 'Traditional ERP',
                'points' => [
                    'Months of deployment and server procurement.',
                    'Bundled licenses and upfront fees.',
                    'Complex integrations and maintenance.',
                    'No influence on product tokenomics.',
                ],
            ],
            'after' => [
                'title' => 'nERP',
                'points' => [
                    'Day-one start on managed nodes.',
                    'Billing tied to user actions only.',
                    'Flexible workflows and integrations on demand.',
                    'Direct impact on tokenomics and roadmap.',
                ],
            ],
        ],
        'deadline' => [
            'text' => 'Applications accepted until 30 September 2024. Seats are limited.',
            'caption' => 'We keep 10 slots to stay deeply engaged with each team.',
        ],
        'form' => [
            'title' => 'Apply for the pilot',
            'subtitle' => 'Tell us what you want to automate — we will respond with a pilot plan within one business day.',
            'action' => '/pilot-request.php',
            'fields' => [
                [
                    'name' => 'name',
                    'label' => 'Name',
                    'placeholder' => 'Jane Doe',
                    'required' => true,
                ],
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'placeholder' => 'name@company.com',
                    'required' => true,
                ],
                [
                    'name' => 'company',
                    'label' => 'Company (optional)',
                    'placeholder' => 'Example Inc.',
                ],
                [
                    'name' => 'goal',
                    'label' => 'What do you want to automate?',
                    'placeholder' => 'Describe the process or tasks',
                    'component' => 'textarea',
                    'required' => true,
                ],
            ],
            'checkbox' => 'I want to join the pilot program',
            'consent' => 'By submitting, you agree to the privacy policy.',
            'submit' => 'Submit application',
            'success' => 'Thank you! We will reach out shortly.',
            'error' => 'Could not send the form. Please try again or email pilot@nerp.app.',
        ],
        'final_cta' => [
            'title' => 'Ready to launch in 1 day?',
            'description' => 'We will onboard your team, configure roles and demonstrate pay-per-action economics.',
            'cta' => 'Join the pilot program',
        ],
    ],
    'footer' => [
        'copyright' => '© {year} nERP. All rights reserved.',
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
                'href' => '/policy',
                'label' => 'Privacy policy',
            ],
        ],
    ],
    'faq' => [
        'items' => [
            [
                'question' => 'Which processes can we automate?',
                'answer' => 'CRM, inventory, procurement, production, HR and bespoke workflows on the Web3 node.',
            ],
            [
                'question' => 'How is data transferred?',
                'answer' => 'Data is encrypted on the client side. You control the keys and access policies.',
            ],
            [
                'question' => 'How long does the pilot take?',
                'answer' => 'We connect the first loop in 1 day and expand according to the agreed roadmap.',
            ],
            [
                'question' => 'Can you integrate third-party services?',
                'answer' => 'Yes, we connect required services via API and reflect them in tokenomics.',
            ],
        ],
    ],
    'policy' => [
        'meta' => [
            'title' => 'nERP Privacy Policy | nerp.app',
            'description' => 'Learn which data nERP collects during Web3 ERP pilots, how encryption works, storage terms and how to request removal.',
            'keywords' => 'nERP privacy policy, data processing, nERP personal data',
            'og_title' => 'nERP data processing policy',
            'og_description' => 'Transparent breakdown of the data we need for pilots, how encryption works and how to request removal.',
            'og_image_alt' => 'nERP privacy: secure storage and checklist illustration',
        ],
        'eyebrow' => 'Transparency',
        'title' => 'nERP personal data processing policy',
        'intro' => 'We use data only to launch and improve pilot projects. This document explains what we collect, how we protect the information and which rights your team has.',
        'updated' => 'Updated: May 2025',
        'contact_title' => 'Contact us',
        'contact' => 'Email pilot@nerp.app or message Telegram @nerp_team — we reply within one business day.',
        'sections' => [
            [
                'title' => '1. Who we are',
                'paragraphs' => [
                    'nERP is a Web3 ERP constructor. We help teams launch pilot workflows on our secure nodes and smart contracts.',
                    'Data controller: Individual entrepreneur Daniil Papirny, operating under the nERP brand.',
                ],
            ],
            [
                'title' => '2. Data we process',
                'paragraphs' => [
                    'We only collect what is needed to prepare the pilot and gather product feedback.',
                ],
                'bullets' => [
                    'Contact details: name, business email, role, company.',
                    'Process description: current tools, pain points, pilot goals, target metrics.',
                    'Technical logs: anonymised demo/test events, IP addresses for anti-spam.',
                    'Billing preferences: comfortable token rate and chosen currency.',
                ],
            ],
            [
                'title' => '3. How we use the data',
                'paragraphs' => [
                    'The data allows us to align pilot scope, configure roles, prepare a commercial proposal and stay in touch during the project.',
                ],
                'bullets' => [
                    'Provisioning access to nERP nodes and dashboards.',
                    'Preparing the pilot roadmap and economics.',
                    'Aggregated effectiveness analytics only.',
                    'Product updates and marketing emails only with your explicit consent.',
                ],
            ],
            [
                'title' => '4. Storage and security',
                'paragraphs' => [
                    'All production data is encrypted client-side before it reaches nERP nodes.',
                    'Only the pilot team can access submissions. We rely on action logs and two-factor authentication.',
                    'Raw pilot data is stored no longer than 18 months after collaboration ends unless law requires otherwise.',
                ],
            ],
            [
                'title' => '5. Your rights',
                'paragraphs' => [
                    'You can manage your data at any time — just contact us.',
                ],
                'bullets' => [
                    'Request a copy or transfer of your data.',
                    'Rectify or supplement the information.',
                    'Erase the data when it is no longer needed for the pilot.',
                    'Withdraw consent from communications and analytics emails.',
                ],
            ],
            [
                'title' => '6. Sharing with third parties',
                'paragraphs' => [
                    'We do not sell or pass personal data without your permission.',
                    'Trusted vendors (cloud infrastructure, email providers) may be engaged under contract and follow our instructions only.',
                ],
            ],
        ],
    ],
    'floating_cta' => 'Apply now',
];
