function increment() {
    const input = document.getElementById("quantity");
    input.value = parseInt(input.value) + 1;
}

function decrement() {
    const input = document.getElementById("quantity");
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
