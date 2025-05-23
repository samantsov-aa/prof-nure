<?php
class json_reader
{
    static public function read_file($filePath)
    {
        $jsonContent = file_get_contents($filePath);
        if ($jsonContent === false) {
            die('Error reading the JSON file.');
        }
        $data = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Error decoding JSON: ' . json_last_error_msg());
        }
        return $data;
    }
}