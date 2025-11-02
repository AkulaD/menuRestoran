document.addEventListener("DOMContentLoaded", function() {
    const minusButtons = document.querySelectorAll(".btn-minus");
    const plusButtons = document.querySelectorAll(".btn-plus");

    minusButtons.forEach(btn => {
        btn.addEventListener("click", function() {
            const input = this.parentElement.querySelector("input[name='jumlah']");
            let value = parseInt(input.value) || 0;
            if (value > 0) input.value = value - 1;
        });
    });

    plusButtons.forEach(btn => {
        btn.addEventListener("click", function() {
            const input = this.parentElement.querySelector("input[name='jumlah']");
            let value = parseInt(input.value) || 0;
            input.value = value + 1;
        });
    });
})

const selectPesanan = document.getElementById('tipe-pesanan');
const nomorBangkuContainer = document.getElementById('nomor-bangku-container');

selectPesanan.addEventListener('change', function() {
    if (this.value === 'Dine In') {
        nomorBangkuContainer.style.display = 'block';
    } else {
        nomorBangkuContainer.style.display = 'none';
    }
});