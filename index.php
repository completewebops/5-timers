<?php
$dataFile = 'timerData.json';
if (file_exists($dataFile)) {
      $savedData = json_decode(file_get_contents($dataFile), true);
} else {
      $savedData = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Countdown Timers</title>
      <link rel="stylesheet" href="style.css">
</head>

<body>
      <div class="container">
            <h1>Countdown Timers</h1>
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                  <div class="timer">
                        <!-- Modify the input elements inside the loop to add the saved values -->
                        <input type="text" class="label" placeholder="Timer <?php echo $i; ?> Label" value="<?php echo isset($savedData[$i - 1]) ? $savedData[$i - 1]['label'] : ''; ?>">
                        <input type="number" class="time" min="1" max="60" value="<?php echo isset($savedData[$i - 1]) ? $savedData[$i - 1]['time'] : '1'; ?>">

                        <p><button class="start">Start</button>
                              <button class="reset">Reset</button>
                        </p>
                        <div class="countdown">0:00</div>
                  </div>
            <?php endfor; ?>
      </div>
      <script src="js.js"></script>

      <script>
            function saveData(label, time, index) {
                  fetch('saveData.php', {
                        method: 'POST',
                        headers: {
                              'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                              label: label,
                              time: time,
                              index: index
                        }),
                  });
            }
      </script>


</body>

</html>