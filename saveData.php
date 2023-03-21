<?php
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['label'], $data['time'], $data['index'])) {
      $label = $data['label'];
      $time = $data['time'];
      $index = $data['index'];

      $dataFile = 'timerData.json';

      if (file_exists($dataFile)) {
            $existingData = json_decode(file_get_contents($dataFile), true);
      } else {
            $existingData = [];
      }

      $existingData[$index] = [
            'label' => $label,
            'time' => $time,
      ];

      file_put_contents($dataFile, json_encode($existingData));
}
