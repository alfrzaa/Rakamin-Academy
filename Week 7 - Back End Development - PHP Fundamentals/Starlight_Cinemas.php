<?php
class TiketBioskop {
    private $hargaDewasa = 50000;
    private $hargaAnak = 30000;
    private $tambahan_weekend = 10000;
    private $batas_diskon = 150000;
    private $persentase_diskon = 0.1; //10%

    public function hitungTotal($jenisTiket, $jumlahTiket, $hariPemesanan) {
        $jenisTiket = strtolower($jenisTiket);
        $hariPemesanan = strtolower($hariPemesanan);
        $hargaPerTiket = ($jenisTiket == 'dewasa') ? $this->hargaDewasa : $this->hargaAnak;
        
        $isWeekend = ($hariPemesanan == 'sabtu' || $hariPemesanan == 'minggu');
        if ($isWeekend) {
            $hargaPerTiket += $this->tambahan_weekend;
        }

        $totalHarga = $hargaPerTiket * $jumlahTiket;
        $diskon = 0;
        if ($totalHarga > $this->batas_diskon) {
            $diskon = $totalHarga * $this->persentase_diskon;
        }

        $totalAkhir = $totalHarga - $diskon;

        return [
            'harga_per_tiket' => $hargaPerTiket,
            'total_sebelum_diskon' => $totalHarga,
            'diskon' => $diskon,
            'total_akhir' => $totalAkhir,
            'isWeekend' => $isWeekend,
            'tambahan_weekend' => $this->tambahan_weekend
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Starlight Cinemas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-color: #ecf0f1;
            --text-color: #2c3e50;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
        }

        select, input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        select:focus, input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .submit-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .result {
            margin-top: 30px;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .result-item:last-child {
            border-bottom: none;
            font-weight: bold;
            color: var(--accent-color);
            font-size: 1.2em;
        }

        .price {
            font-weight: 500;
        }

        .discount {
            color: var(--accent-color);
        }

        .weekend-notice {
            color: var(--accent-color);
            font-style: italic;
            font-size: 0.9em;
            margin-top: 5px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .card {
                padding: 20px;
            }

            .header h1 {
                font-size: 2em;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header animate">
            <h1>🎞️ Starlight Cinemas </h1>
            <p>Book your movie tickets easily and quickly</p>
        </div>

        <div class="card animate">
            <form method="post">
                <div class="form-group">
                    <label>Jenis Tiket</label>
                    <select name="jenisTiket" required>
                        <option value="" disabled selected>Pilih jenis tiket</option>
                        <option value="dewasa">Dewasa - Rp50.000</option>
                        <option value="anak">Anak-anak - Rp30.000</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Tiket</label>
                    <input type="number" name="jumlahTiket" min="1" required>
                </div>

                <div class="form-group">
                    <label>Hari Pemesanan</label>
                    <select name="hariPemesanan" required>
                        <option value="" disabled selected>Pilih Hari Pemesanan</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                        <option value="minggu">Minggu</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Hitung Total</button>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tiket = new TiketBioskop();
            $hasil = $tiket->hitungTotal(
                $_POST['jenisTiket'],
                $_POST['jumlahTiket'],
                $_POST['hariPemesanan']
            );
        ?>
            <div class="card result animate">
                <h2>Detail Pemesanan</h2>
                <div class="result-item">
                    <span>Jenis Tiket</span>
                    <span><?php echo ucfirst($_POST['jenisTiket']); ?></span>
                </div>
                <div class="result-item">
                    <span>Jumlah Tiket</span>
                    <span><?php echo $_POST['jumlahTiket']; ?></span>
                </div>
                <div class="result-item">
                    <span>Hari Pemesanan</span>
                    <span><?php echo ucfirst($_POST['hariPemesanan']); ?></span>
                </div>
                <div class="result-item">
                    <span>Harga per Tiket</span>
                    <span class="price">
                        Rp<?php echo number_format($hasil['harga_per_tiket'], 0, ',', '.'); ?>
                    </span>
                </div>
                <div class="result-item">
                    <span>Total Sebelum Diskon</span>
                    <span class="price">Rp<?php echo number_format($hasil['total_sebelum_diskon'], 0, ',', '.'); ?></span>
                </div>
                <?php if ($hasil['diskon'] > 0) : ?>
                    <div class="result-item">
                        <span>Diskon (10%)</span>
                        <span class="discount">-Rp<?php echo number_format($hasil['diskon'], 0, ',', '.'); ?></span>
                    </div>
                <?php endif; ?>
                <div class="result-item">
                    <span>Total Akhir</span>
                    <span class="price">Rp<?php echo number_format($hasil['total_akhir'], 0, ',', '.'); ?></span>
                </div>
                <?php if ($hasil['isWeekend']) : ?>
                    <div class="weekend-notice">* Tambahan biaya Rp<?php echo number_format($hasil['tambahan_weekend'], 0, ',', '.'); ?> per tiket untuk pemesanan di hari weekend</div>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>