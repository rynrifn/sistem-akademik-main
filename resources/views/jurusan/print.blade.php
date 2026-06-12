<!DOCTYPE html>
<html>
<head>
    <title>Data Jurusan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Data Jurusan</h2>
    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Akreditasi</th>
                <th>Jumlah Mahasiswa</th>
                <th>Jumlah Matakuliah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_jurusan }}</td>
                <td>{{ $item->akreditasi }}</td>
                <td>{{ $item->mahasiswa_count }}</td>
                <td>{{ $item->matakuliah_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>