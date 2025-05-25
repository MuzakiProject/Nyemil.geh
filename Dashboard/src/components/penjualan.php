<?php
$adminLogs = getAllAdminActivityLogs();      // fungsi log admin
$userLogs = getAllUserActivityLogs();        // fungsi log user
?>

<div class="container-fluid">
    <div class="p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-decoration-none link-danger" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Aktifitas</li>
            </ol>
        </nav>
        <h3 class="fw-bolder">Aktivitas</h3>
        <div class="d-flex align-items-center gap-5 mt-3">
            <div class="input-group w-25">
                <span class="input-group-text border-end-0 bg-white"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Cari Aktivitas" aria-label="search">
            </div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none link-danger" href="#">Semua</a>
                <a class="text-decoration-none link-danger" href="#">Admin</a>
                <a class="text-decoration-none link-danger" href="#">User</a>
            </div>
        </div>
    </div>
</div>
<table class="table mt-4 table-hover oapu">
    <thead class="table">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Waktu</th>
            <th scope="col">Tipe</th>
            <th scope="col">Pelaku</th>
            <th scope="col">Aksi</th>
            <th scope="col">Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php if (empty($adminLogs) && empty($userLogs)) : ?>
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada aktivitas yang tercatat.</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($adminLogs as $log): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $log['created_at'] ?></td>
                <td><span class="badge bg-danger">Admin</span></td>
                <td><?= htmlspecialchars($log['username']) ?></td>
                <td><?= $log['action_type'] ?></td>
                <td><?= $log['description'] ?></td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($userLogs as $log): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $log['created_at'] ?></td>
                <td><span class="badge bg-primary">User</span></td>
                <td><?= htmlspecialchars($log['username']) ?></td>
                <td><?= $log['action_type'] ?></td>
                <td><?= $log['description'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
