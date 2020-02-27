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
]);

$client->backup(__DIR__ . '/backup.zip');

// Restoring
$client = new DialogflowBackup([
    'credentials' => __DIR__ . '/destination.json',
]);

$client->restore(__DIR__ . '/backup.zip');

// Importing
$client = new DialogflowBackup([
    'credentials' => __DIR__ . '/destination.json',
]);

$client->import(__DIR__ . '/backup.zip');
```