<?php
// Define the Morse code mappings for letters and numbers
$morseCode = [
    'A' => '.-',   'B' => '-...', 'C' => '-.-.', 'D' => '-..', 'E' => '.',   'F' => '..-.',
    'G' => '--.',  'H' => '....', 'I' => '..',   'J' => '.---', 'K' => '-.-', 'L' => '.-..',
    'M' => '--',   'N' => '-.',   'O' => '---',  'P' => '.--.', 'Q' => '--.-', 'R' => '.-.',
    'S' => '...',  'T' => '-',    'U' => '..-',  'V' => '...-', 'W' => '.--',  'X' => '-..-',
    'Y' => '-.--', 'Z' => '--..', '0' => '-----','1' => '.----','2' => '..---','3' => '...--',
    '4' => '....-', '5' => '.....','6' => '-....','7' => '--...','8' => '---..','9' => '----.',
];

// Function to encode text to Morse code
function encodeMorse($text, $morseCode) {
    $encoded = [];
    $words = explode(' ', strtoupper($text));
    foreach ($words as $word) {
        $chars = str_split($word);
        foreach ($chars as $char) {
            if (isset($morseCode[$char])) {
                $encoded[] = $morseCode[$char];
            }
        }
        $encoded[] = ' '; // Add space between words
    }
    return implode(' ', $encoded);
}

// Function to decode Morse code to text
function decodeMorse($morse, $morseCode) {
    $decoded = [];
    $words = explode(' ', $morse);
    foreach ($words as $word) {
        $chars = explode(' ', $word);
        foreach ($chars as $char) {
            $key = array_search($char, $morseCode);
            if ($key !== false) {
                $decoded[] = $key;
            }
        }
        $decoded[] = ' '; // Add space between words
    }
    return implode('', $decoded);
}

// Command-line usage
if (isset($argv[1]) && isset($argv[2])) {
    $action = strtolower($argv[1]);
    $text = $argv[2];
    if ($action === 'encode') {
        echo encodeMorse($text, $morseCode) . "\n";
    } elseif ($action === 'decode') {
        echo decodeMorse($text, array_flip($morseCode)) . "\n";
    } else {
        echo "Invalid action. Please use 'encode' or 'decode'.\n";
    }
} else {
    echo "Usage: php morse.php [encode|decode] \"text/morse\"\n";
}
?>
