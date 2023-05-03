<?php
// Chambres
const NB_CHAMBRE_P_HOTEL = 10;

const CHAMBRE_STATUTS = [
    'Actif',
    'Supprimé',
    'En travaux'
];

const TYPE_LITS = [
    '2 Lits simples',
    'Lit double standard Queen Size',
    'Lit double Confort',
    'Lit double King Size',
    '1 Lit double et un lit simple'
];

// Catégorie des chambres 
const CHA_CATEGORIE = [
    "Standard",
    "Supérieure",
    "Luxe",
    "Suite"
];

// Clients
const NOMBRE_DE_CLIENTS = 20;

// Commandes
const NOMBRE_COMMANDES = 1500;


// Hôtel
const NOMBRE_HOTEL = 50;
const HOTEL_STATUT = [
    'Actif',
    'Supprimé',
    'En travaux'
];

// Hôtel (catégories)
const HOTEL_CATEGORIE = [
    '2 étoiles',
    '3 étoiles',
    '4 étoiles',
    '5 étoiles',
    'Palace'
];

// Personnel
const NOMBRE_PERSONNEL = 20;

const NOMBRE_TELEC = 10;
const NOMBRE_ADMIN = 1;

const NOM_ROLES = [
    'teleconseiller',
    'gestionnaire'
];

// Services
const SERVICES_NOM = [
    'Piscine',
    'Bien être',
    'Remise en forme',
    'Thalassothérapie',
    'Tennis',
    'Parking',
    'Animal domestique accepté',
    'Wifi/internet',
    'Accessibilité personnes à mobilité réduite',
    'Garde d\'enfant sur demande',
    'Salle de fitness',
    'Petit déjeuner'
];

// Tarifs
const TARIFS_CHAMBRES = [
    '2 étoiles' => [
        'Standard' => '50',
        'Supérieure' => '60',
        'Luxe' => '70',
        'Suite' => '80'
    ],
    '3 étoiles' => [
        'Standard' => '70',
        'Supérieure' => '80',
        'Luxe' => '90',
        'Suite' => '100'
    ],
    '4 étoiles' => [
        'Standard' => '85',
        'Supérieure' => '110',
        'Luxe' => '150',
        'Suite' => '200'

    ],
    '5 étoiles' => [
        'Standard' => '120',
        'Supérieure' => '230',
        'Luxe' => '999',
        'Suite' => '1500'
    ],

    'Palace' => [
        'Standard' => NULL,
        'Supérieure' => NULL,
        'Luxe' => '1200',
        'Suite' => '2100'
    ]
];

// Réservation
const STATUT_RESERVATION = [
    'Initialisé',
    'En attente',
    'Validé',
    'Annnulé'
];
