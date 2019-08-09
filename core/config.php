<?php

// Berisi konfigurasi yang diperlukan seperti base direktori, dan direktori lainnya.

// DIR_BASE: direktory root dari sistem, yakni satu tingkat diatas direktori ini (core).
define("DIR_BASE", dirname(__DIR__));
// beberapa direktori lain yang relative terhadap direktori base.
define("DIR_CORE", DIR_BASE . "/core/");
define("DIR_APP", DIR_BASE . "/app/");
define("DIR_MODEL", DIR_BASE . "/app/models/");
define("DIR_VIEW", DIR_BASE . "/app/views/");
define("DIR_CONTROLLER", DIR_BASE . "/app/controllers/");

// . . .