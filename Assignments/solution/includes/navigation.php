<?php
// includes/navigation.php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?page=welcome">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admins</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=deleteContacts">Delete Contacts</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=logout">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
