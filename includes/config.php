<?php

// Get the key from https://www.google.com/recaptcha/

// copy .sample_env file and rename it to .env. 
// Add the site and secrect keys in .env file.

// Load the .env file
$envFile = __DIR__ . '/.env';

if (file_exists($envFile)) {
  $env = parse_ini_file($envFile);
  if ($env) {
    foreach ($env as $key => $value) {
      // Set the environment variables
      putenv("$key=$value");
      // Optionally, you can also set them in the $_ENV superglobal
      $_ENV[$key] = $value;
    }
  }
}

define("GRC_SITE_KEY", getenv('GRC_SITE_KEY'));
define("GRC_SECRET_KEY", getenv('GRC_SECRET_KEY'));
