# Dialogflow agent backup, import and restore component

A very simple component to backup, import and restore Dialogflow agents.

## Requirements

- PHP 5.6+

## Installing

Use Composer to install it:

```
composer require filippo-toso/dialogflow-backup
```

## Using It

```
use FilippoToso\DialogflowBackup\DialogflowBackup;

// Backup
$client = new DialogflowBackup([
    'credentials' => __DIR__ . '/source.json',
], 'your-project-id');

$client->backup(__DIR__ . '/backup.zip');

// Restoring
$client = new DialogflowBackup([
    'credentials' => __DIR__ . '/destination.json',
], 'your-project-id');

$client->restore(__DIR__ . '/backup.zip');

// Importing
$client = new DialogflowBackup([
    'credentials' => __DIR__ . '/destination.json',
], 'your-project-id');

$client->import(__DIR__ . '/backup.zip');

// If you host your agents on other regions (ie. europe-west1):

$client = new DialogflowBackup([
    'apiEndpoint' => 'europe-west1-dialogflow.googleapis.com',
    'credentials' => __DIR__ . '/source.json',
], 'your-project-id', 'europe-west1');

$client->backup(__DIR__ . '/backup.zip');

```