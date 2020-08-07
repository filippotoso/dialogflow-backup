<?php

namespace FilippoToso\DialogflowBackup;

use BackupException;
use Google\Cloud\Dialogflow\V2\AgentsClient;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Protobuf\Struct;

class DialogflowBackup
{
    protected $projectId;
    protected $options = [];

    public function __construct(array $options, $projectId)
    {
        $this->options = $options;
        $this->projectId = $projectId;
    }

    public function export($filename)
    {
        $client = new AgentsClient($this->options);

        $formattedParent = $client->projectName($this->projectId);
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

        $formattedParent = $client->projectName($this->projectId);

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

        $formattedParent = $client->projectName($this->projectId);

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
