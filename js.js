document.addEventListener('DOMContentLoaded', () => {
      const timerElements = document.querySelectorAll('.timer');
      const timerElementsArray = Array.from(timerElements);

      timerElements.forEach((timer) => {
            const startButton = timer.querySelector('.start');
            const resetButton = timer.querySelector('.reset');
            const timeInput = timer.querySelector('.time');
            const countdownDisplay = timer.querySelector('.countdown');
            const labelInput = timer.querySelector('.label');

            let countdownInterval = null;

            function updateCountdownDisplay(minutes, seconds) {
                  countdownDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            }

            function startCountdown() {
                  let timeRemaining = parseInt(timeInput.value) * 60;
                  updateCountdownDisplay(Math.floor(timeRemaining / 60), timeRemaining % 60);

                  countdownInterval = setInterval(() => {
                        timeRemaining--;

                        if (timeRemaining < 0) {
                              clearInterval(countdownInterval);
                              countdownInterval = null;
                              startButton.textContent = 'Start';
                        } else {
                              updateCountdownDisplay(Math.floor(timeRemaining / 60), timeRemaining % 60);
                        }
                  }, 1000);
            }

            function stopCountdown() {
                  clearInterval(countdownInterval);
                  countdownInterval = null;
            }

            function resetCountdown() {
                  stopCountdown();
                  updateCountdownDisplay(timeInput.value, 0);
                  startButton.textContent = 'Start';
            }

            startButton.addEventListener('click', () => {
                  if (countdownInterval) {
                        stopCountdown();
                        startButton.textContent = 'Start';
                  } else {
                        startCountdown();
                        startButton.textContent = 'Pause';
                  }
            });

            resetButton.addEventListener('click', resetCountdown);

            labelInput.addEventListener('input', () => saveData(labelInput.value, timeInput.value, timerElementsArray.indexOf(timer)));
            timeInput.addEventListener('input', () => saveData(labelInput.value, timeInput.value, timerElementsArray.indexOf(timer)));

            resetCountdown();
      });
});
