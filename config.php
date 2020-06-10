<?php
 /* ----------------------------------------------------------------------------
 * Application - Single Configuration File
 * ---------------------------------------------------------------------------- */

/**
 * Application Configuration File
 *
 * Set your installation BASE_URL * without the trailing slash * and the database
 * credentials in order to connect to the database. You can enable the DEBUG_MODE
 * while developing the application.
 *
 * Set the default language by changing the LANGUAGE constant. For a full list of
 * available languages look at the /application/config/config.php file.
 *
 * IMPORTANT:
 * If you are updating from version 1.0 you will have to create a new "config.php"
 * file because the old "configuration.php" is not used anymore.
 */

class Config
{
    // ------------------------------------------------------------------------
    // General Settings
    // ------------------------------------------------------------------------
    const BASE_URL        = 'http://localhost/upskill/';
    const LANGUAGE        = 'english';
    const DEBUG_MODE      = false;
    const ENABLE_HOOKS    = false;
    const COKKIES_DOMAIN  = 'localhost';
    const COKKIES_PATH    = '/upskill/';
    const COKKIES_PREFIX  = 'upskill';
    const COKKIES_NAME    = 'upskill';


    // ------------------------------------------------------------------------
    // Database Settings
    // ------------------------------------------------------------------------
    const DB_HOST       = 'localhost';
    const DB_NAME       = 'upskill';
    const DB_USERNAME   = 'root';
    const DB_PASSWORD   = '';
    const DB_DRIVER     = 'mysqli';
    const DB_DNS        = ''; // require if DB_DRIVER is pdo like (mysql:host=localhost;dbname=ci_goconsult) otherwise it can be blank.

    // ------------------------------------------------------------------------
    // Google Calendar Sync
    // ------------------------------------------------------------------------
    const GOOGLE_SYNC_FEATURE   = false; // Enter TRUE or FALSE
    const GOOGLE_PRODUCT_NAME   = '';
    const GOOGLE_CLIENT_ID      = '';
    const GOOGLE_CLIENT_SECRET  = '';
    const GOOGLE_API_KEY        = '';
}
