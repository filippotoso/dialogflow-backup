<?php

namespace FilippoToso\DialogflowBackup;

use FilippoToso\DialogflowBackup\Exceptions\BackupException;
use Google\Cloud\Dialogflow\V2\AgentsClient;

class DialogflowBackup
{
    protected $projectId;
    protected $locationId;
    protected $options = [];

    public function __construct(array $options, $projectId, $locationId = null)
    {
        $this->options = $options;
        $this->projectId = $projectId;
        $this->locationId = $locationId;
    }

    public function export($filename)
    {
        $client = new AgentsClient($this->options);

        if ($this->locationId) {
            $formattedParent = $client->locationName($this->projectId, $this->locationId);
        } else {
            $formattedParent = $client->projectName($this->projectId);
        }

        $response = $client->exportAgent($formattedParent, '');

        $response->pollUntilComplete();

        if (!$response->operationSucceeded()) {
            throw new BackupException($response->getError());
        }

        $result = $response->getResult();

        $content = $result->getAgentContent();

        file_put_contents($filename, $content);

        return true;
    }

    public function import($filename)
    {
        $client = new AgentsClient($this->options);

        if ($this->locationId) {
            $formattedParent = $client->locationName($this->projectId, $this->locationId);
        } else {
            $formattedParent = $client->projectName($this->projectId);
        }

        $response = $client->importAgent($formattedParent, [
            'agentContent' => file_get_contents($filename),
        ]);

        $response->pollUntilComplete();

        if (!$response->operationSucceeded()) {
            throw new BackupException($response->getError());
        }

        return true;
    }

    public function restore($filename)
    {
        $client = new AgentsClient($this->options);

        if ($this->locationId) {
            $formattedParent = $client->locationName($this->projectId, $this->locationId);
        } else {
            $formattedParent = $client->projectName($this->projectId);
        }

        $response = $client->restoreAgent($formattedParent, [
            'agentContent' => file_get_contents($filename),
        ]);

        $response->pollUntilComplete();

        if (!$response->operationSucceeded()) {
            throw new BackupException($response->getError());
        }

        return true;
    }
}
