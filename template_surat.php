<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Template Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 220px;
            background-color: #f8f9fa;
            padding-top: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid #ccc;
        }
        .sidebar a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: black;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .content {
            margin-left: 220px;
            padding: 40px;
            flex-grow: 1;
        }
        .form-section {
            border: 1px solid #ddd;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="#"><b>🏠 Dashboard</b></a>
    <a href="user.php"><b>👥 Daftar User</b></a>
    <a href="list_surat.php"><b>📄 Daftar Surat</b></a>
    <a href="template_surat.php"><b>📄 Template Surat</b></a>
    <a href="log.php"><b>📜 Log Activity</b></a>
    <a href="logout.php"><b>🔓 Logout</b></a>
</div>

<!-- Content -->
<div class="content">
    <h2 class="mb-4">📝 Form Pengisian Surat Berdasarkan Template</h2>

    <!-- 🔶 FORM 1: Surat Keterangan Kerja / Surat Tugas -->
    <div class="form-section">
        <h4>📄 Surat Keterangan Kerja / Surat Tugas</h4>
        <form action="generate_surat_kerja.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label>Nama Atasan / HRD</label>
                    <input type="text" class="form-control" name="nama_hrd" required>
                </div>
                <div class="col-md-6">
                    <label>Jabatan Atasan</label>
                    <input type="text" class="form-control" name="jabatan_hrd" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label>Nama Pegawai</label>
                    <input type="text" class="form-control" name="nama_pegawai" required>
                </div>
                <div class="col-md-6">
                    <label>NIK Pegawai</label>
                    <input type="text" class="form-control" name="nik" required>
                </div>
            </div><br>
            <label>Keperluan Surat</label>
            <input type="text" class="form-control" name="keperluan" required><br>
            <label>Tanggal Terbit</label>
            <input type="date" class="form-control" name="tanggal_terbit" required><br>
            <button class="btn btn-success">🖨️ Buat Surat</button>
        </form>
    </div>

    <!-- 🔶 FORM 2: Surat Pengunduran Diri -->
    <div class="form-section">
        <h4>📄 Surat Pengunduran Diri</h4>
        <form action="generate_pengunduran_diri.php" method="POST">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" required><br>
            <label>Jabatan</label>
            <input type="text" class="form-control" name="jabatan" required><br>
            <label>Departemen</label>
            <input type="text" class="form-control" name="departemen" required><br>
            <label>Tanggal Pengunduran Diri</label>
            <input type="date" class="form-control" name="tanggal_resign" required><br>
            <label>Tempat & Tanggal Surat</label>
            <input type="text" class="form-control" name="tempat_tanggal" required><br>
            <button class="btn btn-danger">🖨️ Buat Surat Pengunduran Diri</button>
        </form>
    </div>

    <!-- 🔶 FORM 3: Permohonan Izin Cuti -->
    <div class="form-section">
        <h4>📄 Permohonan Izin Tidak Masuk Kerja (Cuti)</h4>
        <form action="generate_izin_cuti.php" method="POST">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" required><br>
            <label>Nomor Pegawai</label>
            <input type="text" class="form-control" name="no_pegawai" required><br>
            <label>Jabatan</label>
            <input type="text" class="form-control" name="jabatan" required><br>
            <label>Unit Kerja</label>
            <input type="text" class="form-control" name="unit" required><br>
            <label>Hari / Tanggal Cuti</label>
            <input type="text" class="form-control" name="hari_tanggal" required><br>
            <label>Keperluan</label>
            <input type="text" class="form-control" name="keperluan" required><br>
            <button class="btn btn-primary">🖨️ Buat Surat Izin</button>
        </form>
    </div>
</div>

</body>
</html>
