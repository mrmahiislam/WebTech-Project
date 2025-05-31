<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$apiKey = 'ee62608ea9ae3347fcbea3dacc9946b7';

if (!isset($_GET['city']) || empty($_GET['city'])) {
    echo json_encode(['cod' => 400, 'message' => 'City name is required']);
    exit;
}

$input = trim($_GET['city']);

// Step 1: Define capital city fallback for countries
$countryCapitals = [
    'bangladesh' => 'dhaka',
    'india' => 'new delhi',
    'usa' => 'washington',
    'united states' => 'washington',
    'uk' => 'london',
    'united kingdom' => 'london',
    'canada' => 'ottawa',
    'germany' => 'berlin',
    'france' => 'paris',
    'japan' => 'tokyo',
    'china' => 'beijing',
    'russia' => 'moscow',
    'pakistan' => 'islamabad',
    'australia' => 'canberra',
    'nepal' => 'kathmandu'
];

// Step 2: Check if input is a country, map to capital
$lowerInput = strtolower($input);
if (array_key_exists($lowerInput, $countryCapitals)) {
    $input = $countryCapitals[$lowerInput];
}

// Step 3: Use geocoding to get lat/lon (limit=1 for accuracy)
$geoUrl = "http://api.openweathermap.org/geo/1.0/direct?q=" . urlencode($input) . "&limit=1&appid={$apiKey}";
$geoResponse = file_get_contents($geoUrl);
$geoData = json_decode($geoResponse, true);

if (empty($geoData)) {
    echo json_encode(['cod' => 404, 'message' => 'Location not found']);
    exit;
}

$lat = $geoData[0]['lat'];
$lon = $geoData[0]['lon'];
$cityName = $geoData[0]['name'] ?? '';
$countryCode = $geoData[0]['country'] ?? '';

// Step 4: Fetch weather using lat/lon
$weatherUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric";
$weatherResponse = file_get_contents($weatherUrl);

if ($weatherResponse === FALSE) {
    echo json_encode(['cod' => 500, 'message' => 'Unable to fetch weather']);
    exit;
}

$weatherData = json_decode($weatherResponse, true);

// Overwrite city and country for consistent labeling
$weatherData['name'] = $cityName;
$weatherData['sys']['country'] = $countryCode;

// Output final result
echo json_encode($weatherData);
