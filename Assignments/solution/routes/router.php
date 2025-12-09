<?php
$page = $_GET['page'] ?? 'welcome';

switch ($page) {
    case 'welcome':
        require __DIR__ . '/views/welcome.php';
        break;

    case 'addAdmin':
        require __DIR__ . '/views/addAdminForm.php';
        break;

    case 'addAdminProc':
        require __DIR__ . '/controllers/addAdminProc.php';
        break;

    case 'deleteAdmins':
        require __DIR__ . '/views/deleteAdminsTable.php';
        break;

    case 'addContact':
        require __DIR__ . '/views/addContactForm.php';
        break;

    case 'deleteContacts':
        require __DIR__ . '/views/deleteContactsTable.php';
        break;

    case 'logout':
        require __DIR__ . '/controllers/logout.php';
        break;

    default:
        require __DIR__ . '/views/welcome.php';
        break;
}
