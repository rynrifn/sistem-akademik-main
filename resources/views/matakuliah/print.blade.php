<!DOCTYPE html>
<html>
<head>
    <title>Data Matakuliah</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Data Matakuliah</h2>
    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matakuliah as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_matakuliah }}</td>
                <td>{{ $item->sks }} SKS</td>
                <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>