<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['csv']) || $_FILES['csv']['error'] != 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Failed to upload CSV file.']);
        exit;
    }

    $csvFile = $_FILES['csv']['tmp_name'];
    $wordList = isset($_POST['word-list']) ? explode("\n", $_POST['word-list']) : [];
    $showNotFound = isset($_POST['show-not-found']);
    $showDuplicates = isset($_POST['show-duplicates']);
    $case_sensitive = isset($_POST['case_sensitive']); // Check if case sensitivity is enabled

    // Normalize input words
    $normalize = function($words) use ($case_sensitive) {
        return array_map(function($word) use ($case_sensitive) {
            $word = trim($word, " \t\n\r\0\x0B\"'");
            return $case_sensitive ? $word : strtolower($word);
        }, $words);
    };

    $normalizedWords = $normalize($wordList);

    // Read CSV file
    $csvContent = [];
    $allCsvValues = [];
    if (($handle = fopen($csvFile, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            if (isset($row[0])) $csvContent[] = $case_sensitive ? trim($row[0], " \t\n\r\0\x0B\"'") : strtolower(trim($row[0], " \t\n\r\0\x0B\"'"));
            if (isset($row[1])) $csvContent[] = $case_sensitive ? trim($row[1], " \t\n\r\0\x0B\"'") : strtolower(trim($row[1], " \t\n\r\0\x0B\"'"));
            $allCsvValues = array_merge($allCsvValues, array_slice($row, 0, 2));
        }
        fclose($handle);
    }

    // Normalize CSV values
    $csvContent = array_unique($csvContent);
    $allCsvValues = $normalize($allCsvValues);

    // Find duplicates in CSV
    $duplicates = [];
    if ($showDuplicates) {
        $counts = array_count_values($allCsvValues);
        $duplicates = array_keys(array_filter($counts, fn($count) => $count > 1));
    }

    // Check words
    $found = array_intersect($normalizedWords, $csvContent);
    $notFound = $showNotFound ? array_diff($normalizedWords, $csvContent) : [];

    // Ensure the response always returns arrays
    echo json_encode([
        'found' => array_values($found), // Ensure JSON array format
        'notFound' => array_values($notFound), // Ensure JSON array format
        'duplicates' => array_values($duplicates) // Ensure JSON array format
    ]);
    exit;
}
