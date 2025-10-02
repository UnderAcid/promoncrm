<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'nERP',
        'locale_code' => 'en-US',
        'language_label' => 'Language',
        'theme' => [
            'toggle' => 'Toggle theme',
            'label' => 'Theme',
            'light' => 'Light',
            'dark' => 'Dark',
        ],
        'noscript' => 'JavaScript is disabled. Some functionality may be limited.',
    ],
    'meta' => [
        'title' => 'nERP — Web3 sheets for pilot teams | nerp.app',
        'description' => 'nERP is an MVP with encrypted Web3 sheets. Formulas, summaries, and collaboration are live, and we co-build new features with pilot companies.',
        'keywords' => 'nerp.app, Web3 sheets, encrypted spreadsheets, nERP pilot, decentralised data, anonymity, nERP tokens',
        'og_title' => 'nERP — Web3 sheets for pilot teams | nerp.app',
        'og_description' => 'Run encrypted nERP sheets and shape the roadmap with us: formulas, summaries, and pilot-friendly token terms.',
        'og_image_alt' => 'nERP illustration: encrypted node with distributed sheets',
    ],
    'nav' => [
        'for' => 'Who it is for',
        'why' => 'Why nERP',
        'pricing' => 'Pricing',
        'pilots' => 'Pilots',
        'toggle' => 'Menu',
    ],
    'hero' => [
        'tags' => ['MVP', 'Web3 sheet', 'nerp.app'],
        'title' => 'Encrypted Web3 sheets for pilots',
        'lead' => 'nERP is an early-stage Web3 platform that already feels like the spreadsheets your team uses: formulas, summaries, and collaborative views. The core is decentralised, data stays anonymous, and you remain in control.',
        'primary_cta' => 'Apply for pilot access',
        'secondary_cta' => 'See how it works',
        'feature_cards' => [
            [
                'icon' => 'table',
                'title' => 'Formulas & insights',
                'desc' => 'Build live sheets, calculate metrics, and share dashboards instantly.',
            ],
            [
                'icon' => 'lock',
                'title' => 'Data stays encrypted',
                'desc' => 'Run your own node, keep the keys, and stay anonymous by design.',
            ],
            [
                'icon' => 'sparkles',
                'title' => 'Co-build the roadmap',
                'desc' => 'Request the features you need — we build them together with pilot teams.',
            ],
        ],
    ],
    'audience' => [
        'title' => 'Who nERP is for',
        'subtitle' => 'We are looking for teams ready to co-create nERP and steer the roadmap.',
        'options' => [
            'operations' => [
                'icon' => 'settings',
                'title' => 'Operations teams',
                'desc' => 'Move live processes into secure sheets and validate hypotheses.',
            ],
            'finance' => [
                'icon' => 'coins',
                'title' => 'Finance leaders',
                'desc' => 'Plan the pilot budget and lock in token terms up front.',
            ],
            'founders' => [
                'icon' => 'users',
                'title' => 'Founders & owners',
                'desc' => 'Describe the workflow — we will tailor the MVP to your use case.',
            ],
        ],
        'pitches' => [
            'operations' => [
                'icon' => 'target',
                'title' => 'Process digital twin',
                'desc' => 'Bring your rituals into live sheets and measure impact right inside the pilot.',
            ],
            'finance' => [
                'icon' => 'wallet',
                'title' => 'Transparent token exchange',
                'desc' => 'Fund the roadmap now and secure discounted or free nERP access later.',
            ],
            'founders' => [
                'icon' => 'handshake',
                'title' => 'Feature co-development',
                'desc' => 'Share your business processes and we will ship the features at well below market rates.',
            ],
        ],
        'cta' => 'Discuss your pilot',
    ],
    'why' => [
        'title' => 'Why pilot teams pick nERP',
        'blocks' => [
            [
                'icon' => 'grid',
                'title' => 'Familiar experience',
                'desc' => 'Formulas, filters, aggregation, and summaries feel just like your favourite sheets.',
            ],
            [
                'icon' => 'shield',
                'title' => 'Decentralised & encrypted',
                'desc' => 'Each node is autonomous. Data is encrypted and access works without exposing identities.',
            ],
            [
                'icon' => 'compass',
                'title' => 'Roadmap built together',
                'desc' => 'We prioritise the platform based on real pilot scenarios and capture the agreement in writing.',
            ],
        ],
    ],
    'how' => [
        'title' => 'How a pilot runs',
        'items' => [
            [
                'title' => 'Map the workflows together',
                'desc' => 'Share the current sheets and rituals. We isolate the MVP core and confirm the scope.',
            ],
            [
                'title' => 'Configure secure sheets',
                'desc' => 'We set up formulas, permissions, reports, and flows tailored to your pilot team.',
            ],
            [
                'title' => 'Measure & evolve',
                'desc' => 'Launch the pilot, track metrics, and decide which features to build next.',
            ],
        ],
    ],
    'stack' => [
        'title' => 'The nERP technical core',
        'subtitle' => 'Our focus is resilience, security, and anonymity of pilot nodes.',
        'highlights' => [
            [
                'icon' => 'nodes',
                'title' => 'Local-first nodes',
                'desc' => 'Run nodes on your servers or private cloud. You keep the controls.',
            ],
            [
                'icon' => 'key',
                'title' => 'Encryption & audit',
                'desc' => 'Keys are distributed between participants. Every access is logged on smart contracts.',
            ],
            [
                'icon' => 'eye-off',
                'title' => 'Anonymity by default',
                'desc' => 'Personal data stays hidden. Reports only show what your scenario requires.',
            ],
        ],
        'integrations_title' => 'Integrations in the queue',
        'integrations_desc' => 'The core features are live today. External integrations ship together with pilot teams — tell us what matters to you.',
        'integrations_core' => 'nERP core',
        'integrations' => [
            ['name' => 'Messenger APIs', 'tag' => 'Planned', 'status' => 'On request', 'icon' => 'chat'],
            ['name' => 'Accounting suites', 'tag' => 'Exploring', 'status' => 'On request', 'icon' => 'ledger'],
            ['name' => 'Databases', 'tag' => 'Planned', 'status' => 'On request', 'icon' => 'database'],
        ],
        'footnote' => 'Missing a critical integration? Become a pilot — we will ship it together and capture the terms.',
    ],
    'pricing' => [
        'title' => 'Pilot engagement terms',
        'subtitle' => 'Two participation models. Final economics are agreed individually.',
        'notice' => 'Use the calculator to estimate pilot scale. Tell us about your team and we will lock the token or feature development terms together.',
        'team_size' => 'Team size',
        'actions_per_day' => 'Actions per person per day',
        'monthly_actions' => 'Actions per month',
        'nerp_total' => 'nERP spend (tokens)',
        'fiat_equivalent' => 'USD equivalent',
        'hint' => 'Team range goes from 1 to 1000 people. Numbers are indicative and depend on the modules you activate.',
        'locale' => 'en-US',
        'currency' => 'USD',
        'micro_fee' => 'Budget is tied to real actions inside the system.',
        'primary_cta' => 'Discuss pilot terms',
        'token_price_label' => 'Token estimate',
        'token_price_prefix' => '1 nERP ≈',
        'token_price_suffix' => '$',
        'token_price_presets_label' => 'Pick a rate',
        'token_price_presets_currency' => '$',
        'token_price_hint' => 'Token is not minted yet. Enter the rate you consider fair for your contribution.',
        'token_price_preview_prefix' => 'Preview: 1 nERP ≈',
        'token_price_usd' => 1.0,
        'token_price_min_usd' => 0.1,
        'token_price_max_usd' => 2.0,
        'token_price_step_usd' => 0.1,
        'token_price_decimals' => 2,
        'token_decimals' => 6,
        'fiat_per_usd' => 1.0,
        'operations_title' => 'Base operation costs',
        'operations_suffix' => 'nERP',
        'operations' => [
            [
                'title' => 'Read a block',
                'cost' => 0.000010,
            ],
            [
                'title' => 'Write a block',
                'cost' => 0.000100,
            ],
            [
                'title' => 'Store a block',
                'cost' => 0.000010,
                'postfix' => '· day⁻¹',
            ],
        ],
        'operation_fiat_prefix' => '≈',
    ],
    'partners' => [
        'title' => 'What pilots receive',
        'cards' => [
            [
                'icon' => 'tokens',
                'title' => 'nERP tokens for funding',
                'desc' => 'We secure a rate and allocate tokens for your financial contribution.',
            ],
            [
                'icon' => 'clipboard',
                'title' => 'Custom features for processes',
                'desc' => 'Share your workflows — we build the features at a fraction of market price.',
            ],
            [
                'icon' => 'flag',
                'title' => 'Priority support',
                'desc' => 'Direct line to the core team and influence over the roadmap.',
            ],
        ],
    ],
    'logos' => [
        'eyebrow' => 'Pilot scenarios',
        'intro' => 'We are onboarding the first companies now. These are the tracks ready to launch together.',
        'default' => 'process-lab',
        'pilots' => [
            [
                'id' => 'process-lab',
                'label' => 'Process Lab',
                'company' => 'Open slot',
                'quote' => 'Looking for a team ready to share processes and shape flexible sheets tailored to them.',
                'role' => 'COO',
                'metric' => 'Focus: internal ops',
            ],
            [
                'id' => 'finance-desk',
                'label' => 'Finance Desk',
                'company' => 'Open slot',
                'quote' => 'Ready to adapt reporting and formulas for a finance department willing to support us with tokens.',
                'role' => 'CFO',
                'metric' => 'Focus: budgets & analytics',
            ],
            [
                'id' => 'distributed-team',
                'label' => 'Distributed Team',
                'company' => 'Open slot',
                'quote' => 'Seeking a company that wants anonymous access and decentralised collaboration inside encrypted sheets.',
                'role' => 'Co-founder',
                'metric' => 'Focus: distributed teams',
            ],
        ],
    ],
    'cta' => [
        'title' => 'Ready to become a pilot?',
        'subtitle' => 'Tell us about your goals — we will prepare a tailored demonstration.',
        'primary_cta' => 'Submit request',
        'secondary_cta' => 'Request a demo',
    ],
    'faq' => [
        'title' => 'Frequently asked questions',
        'items' => [
            [
                'question' => 'Who can see my data?',
                'answer' => 'Keys and access policies stay with your team. Nodes only process encrypted chunks and anonymised metadata.',
            ],
            [
                'question' => 'Do you have modules and integrations?',
                'answer' => 'Not yet. We focus on reliable sheets and collaboration. Integrations ship with pilot teams once the need is confirmed.',
            ],
            [
                'question' => 'How long does a pilot take?',
                'answer' => 'Typically 3–6 weeks. The first half covers sheet setup and access, then we measure metrics and plan the next steps.',
            ],
            [
                'question' => 'How does the token exchange work?',
                'answer' => 'You commit funding or scope, we allocate nERP tokens. After launch you can use the platform for free or at an agreed discount for a set period.',
            ],
            [
                'question' => 'What if we lack in-house engineers?',
                'answer' => 'No problem. We help with deployment and support — just appoint an internal coordinator.',
            ],
            [
                'question' => 'Can we scale after the pilot?',
                'answer' => 'Absolutely. We agree on the roadmap, add the integrations you need, and sign a long-term access agreement.',
            ],
        ],
    ],
    'footer' => [
        'copyright' => '© :year nERP. All rights reserved.',
        'links' => [
            ['label' => 'Privacy', 'href' => 'https://nerp.app/privacy'],
            ['label' => 'Docs', 'href' => 'https://nerp.app/docs'],
            ['label' => 'Contact', 'href' => 'mailto:pilot@nerp.app'],
        ],
    ],
    'language_switcher' => [
        'label' => 'Interface language',
    ],
    'floating_cta' => 'Become an nERP pilot',
    'pilots' => [
        'eyebrow' => 'Pilot program',
        'title' => 'Join the nERP pilot program',
        'subtitle' => 'Web3 sheets with encryption and anonymity. An MVP we evolve around your processes.',
        'points' => [
            'Today the MVP equals flexible sheets with formulas, reports, and collaboration.',
            'The node is decentralised: data is encrypted and identities stay protected.',
            'Pilot companies receive nERP tokens in exchange for financial contributions.',
            'Or share business processes — we ship the required features at a major discount.',
            'The nERP team maps processes, configures roles, and trains your champions.',
            'At the end you get a report, metrics, and a rollout plan.',
        ],
        'form' => [
            'title' => 'Apply for pilot access',
            'subtitle' => 'Describe key processes and the type of contribution — we will reply with a proposal within 24 hours.',
            'action' => 'https://nerp.app/api/pilot-request',
            'name' => 'Full name',
            'name_placeholder' => 'Jane Smith',
            'email' => 'Work email',
            'email_placeholder' => 'you@company.com',
            'company' => 'Company',
            'company_placeholder' => 'Acme Inc.',
            'role' => 'Role / focus',
            'role_placeholder' => 'Operations lead',
            'message' => 'What do you plan to automate first?',
            'message_placeholder' => 'Share current tools, pain points, integrations…',
            'consent' => 'By submitting you agree to personal data processing and to receive onboarding updates from nerp.app.',
            'submit' => 'Send application',
            'success' => 'Thanks! We will contact you within 24 hours.',
            'error' => 'Unable to send. Please write to pilot@nerp.app.',
        ],
    ],
];
