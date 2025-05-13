function increment() {
    const input = document.getElementById("quantity");
    input.stepUp();
  }

  function decrement() {
    const input = document.getElementById("quantity");
    if (input.value > 1) {
      input.stepDown();
    }
  }