
const form = document.getElementById('regisdaft');
const submitBtn = document.getElementById('subkir');

// Fungsi cek validitas form
form.addEventListener('input', () => {
  submitBtn.disabled = !form.checkValidity();
});

// Validasi saat dikirim
form.addEventListener('submit', (event) => {
  if (!form.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }
  form.classList.add('was-validated');
});


