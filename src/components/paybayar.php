<?php 
$footer = false; 

$produk = null;
$qty = 1;
$total = 0;

if (isset($_GET['produk_id'])) {
    $produk_id = (int) $_GET['produk_id'];
    $qty = isset($_GET['quantity']) && is_numeric($_GET['quantity']) ? (int) $_GET['quantity'] : 1;

    $produk = getProdukById($produk_id);

    if ($produk) {
        $total = $produk['price'] * $qty;
    }
}
?>
<?php if ($produk): ?>
<div class="container payment-userc pt-4 pb-4">
    <h3 class="fw-semibold">Checkout</h3>
    <div class="d-flex gap-4 justify-content-between py-4 my-4 border-top border-bottom">
        <div class="left">
            <div class="img rounded">
                <img src="/src/images/<?= htmlspecialchars($produk["image_product"]) ?>" alt="">
            </div>
        </div>
        <div class="middle text">
            <h3 class="fw-semibold pb-3"><?= htmlspecialchars($produk["productname"]) ?></h3>
            <h6>Deskripsi :</h6>
            <div class="pb-3"><?= nl2br(htmlspecialchars($produk["description"])) ?></div>
        </div>
        <div class="right w-50">
            <p>Qty : <?= $qty ?>x</p>
            <h3>Rp. <?= number_format($total, 0, ',', '.') ?></h3>
        </div>
    </div>

    <form method="POST" id="form-checkout">
        <div class="payment-userc2">
            <div class="d-flex gap-4 justify-content-between">
                <div class="left w-100">
                    <h3 class="fw-semibold pt-4 mb-4">Detail Pengiriman</h3>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Penerima</label>
                        <input type="text" name="nama" class="form-control p-3" value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>" placeholder="Masukan Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No Telepon</label>
                        <input type="text" name="no_telp" class="form-control p-3" value="<?= htmlspecialchars($_SESSION['user']['no_telp'] ?? '') ?>"  placeholder="Masukan No Telepon" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control p-3" name="alamat" rows="3" placeholder="Masukan Alamat Lengkap" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Detail Lainnya</label>
                        <input type="text" name="desk" class="form-control p-3" placeholder="Cth : Blok / Unit No. Patokan">
                    </div>
                </div>
                <div class="right w-100">
                    <h3 class="fw-semibold pt-4 mb-4 text-light">.</h3>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="provinsi">Provinsi</label>
                        <select id="provinsi" name="provinsi" class="form-select" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="kota">Kota</label>
                        <select id="kota" name="kota" class="form-select" required>
                            <option value="">-- Pilih Kota --</option>
                        </select>
                    </div>
                    <div class="opspengirim mb-3">
                        <label class="form-label fw-semibold" for="kurir">Opsi Pengiriman</label>
                        <select id="kurir" name="kurir" class="form-select" required>
                            <option value="">-- Pilih Kurir --</option>
                            <option value="JNE">JNE</option>
                            <option value="JNT Express">J&T</option>
                            <option value="TIKI">TIKI</option>
                            <option value="SiCepat">SiCepat</option>
                        </select>
                    </div>
                    <label class="form-label fw-semibold">Rincian Pembayaran</label>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="leftrin fw-light">
                                    <p>Subtotal Produk</p>
                                    <p>Biaya Pengiriman</p>
                                </div>
                                <div class="rightrin">
                                    <?php
                                        $total_berat = $produk['weight'] * $qty;
                                    ?>
                                    <input type="hidden" id="berat" name="berat" value="<?= $total_berat ?>">
                                    <p class="text-end">Rp. <?= number_format($total, 0, ',', '.') ?></p>
                                    <input type="text" name="ongkir" id="ongkir" class="text-end border-0" style="width: 150px;" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="totalpay d-flex justify-content-between">
                                <h5>Total Pembayaran</h5>
                                <h5 id="total">Rp. <?= number_format($total, 0, ',', '.') ?></h5>
                                <input type="hidden" name="total" id="total_bayar_input" value="<?= $total ?>">
                            </div>
                        </div>
                    </div>
                    <button id="pay-button" class="btn btn-danger mt-3 w-100 fw-semibold p-2 rounded-0">Buat Pesanan</button>
                    <p class="text-center fw-light mt-3">Dengan menekan tombol "Buat Pesanan", Anda menyetujui <a class="link-danger text-decoration-none" href="?page=3">Syarat & Ketentuan</a> kami</p>
                </div>
            </div>
        </div>
    </form>
</div>
<?php else: ?>
    <div class="container py-5">
        <h4 class="text-danger">Produk tidak ditemukan. Silakan kembali ke halaman sebelumnya.</h4>
    </div>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const provinsiSelect = document.getElementById("provinsi");
  const kotaSelect = document.getElementById("kota");
  const kurirSelect = document.getElementById("kurir");
  const ongkirInput = document.getElementById("ongkir");
  const totalBayar = document.getElementById("total");
  const totalBayarInput = document.getElementById("total_bayar_input");
  const berat = parseInt(document.getElementById("berat").value) || 1000;
  const hargaProduk = <?= $total ?>;

  fetch("/src/components/phplogic/provinsi_kota_indonesia.json")
    .then(res => res.json())
    .then(data => {
      for (const provinsi in data) {
        provinsiSelect.appendChild(new Option(provinsi, provinsi));
      }

      provinsiSelect.addEventListener("change", () => {
        kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
        const selectedKota = data[provinsiSelect.value] || [];
        selectedKota.forEach(obj => {
          const option = new Option(obj.nama, obj.nama);
          option.dataset.jarak = obj.jarak_km;
          kotaSelect.appendChild(option);
        });
        hitungOngkir();
      });

      kotaSelect.addEventListener("change", hitungOngkir);
      kurirSelect.addEventListener("change", hitungOngkir);
    });

  function hitungOngkir() {
    const kota = kotaSelect.value;
    const kurir = kurirSelect.value;
    const jarak = parseInt(kotaSelect.selectedOptions[0]?.dataset.jarak || 0);
    if (!kota || !kurir || !jarak) return;

    const formData = new FormData();
    formData.append("kota", kota);
    formData.append("kurir", kurir);
    formData.append("jarak", jarak);
    formData.append("berat", berat);

    fetch("/src/components/phplogic/hitung_ongkir_manual.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        const total = hargaProduk + data.ongkir;
        ongkirInput.value = `Rp. ${data.ongkir.toLocaleString("id-ID")}`;
        totalBayar.textContent = `Rp. ${total.toLocaleString("id-ID")}`;
        totalBayarInput.value = total;
      });
  }
});
</script>
<script>
document.getElementById('pay-button').addEventListener('click', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append("nama", document.querySelector('[name="nama"]').value);
    formData.append("no_telp", document.querySelector('[name="no_telp"]').value);
    formData.append("alamat", document.querySelector('[name="alamat"]').value);
    formData.append("provinsi", document.querySelector('[name="provinsi"]').value);
    formData.append("kota", document.querySelector('[name="kota"]').value);
    formData.append("kurir", document.querySelector('[name="kurir"]').value);
    formData.append("ongkir", document.getElementById("ongkir").value.replace(/[^\d]/g, ''));
    formData.append("total", document.getElementById("total_bayar_input").value);

    fetch(`/src/components/phplogic/pay-process.php?produk_id=<?= $produk['id'] ?>&quantity=<?= $qty ?>`, {
    method: 'POST',
    body: formData
})
    .then(res => res.json())
    .then(data => {
        window.snap.pay(data.token, {
            onSuccess: function(result){
                // simpan transaksi ke database
                fetch('/src/components/phplogic/transaksisucc.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({result: result})
                }).then(() => {
                    window.location.href = "index.php?page=7";
                });
            },
            onPending: function(result){
                console.log("Pending", result);
            },
            onError: function(result){
                console.error("Error", result);
                alert("Terjadi kesalahan pembayaran.");
            }
        });
    });
});
</script>