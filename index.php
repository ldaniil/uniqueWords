<?php

// ��������� ��� �����
$fileParam = empty($argv) ? false : array_search('--file', $argv);

if ($fileParam === false) {
    die('������� ����');
} else {
    $file = $argv[$fileParam + 1];
}

$fp = fopen($file, 'r') or die('�� ������� �������� ����: ' . $file);

// ����� � ����������� ����������
$words = [];

// ������� ���������� ���������� ����
while (!feof($fp)) {
    $line = fgets($fp);

    preg_match_all('/[\w\-]+/u', $line, $matches);

    if (empty($matches) == false) {
        foreach ($matches[0] as $word) {
            $word = mb_strtolower($word, 'utf-8');

            if (isset($words[$word])) {
                $words[$word] += 1;
            } else {
                $words[$word] = 1;
            }
        }
    }
}

fclose($fp);

$uniqueWordCount = 0;

// ������� ���������� �����
foreach ($words as $word => $count) {
    if ($count == 1) {
        $uniqueWordCount++;
    }
}

echo '���������� ���������� ����: ' . $uniqueWordCount;