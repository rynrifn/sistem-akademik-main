<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Jurusan</th>
            <th>Akreditasi</th>
            <th>Jumlah Mahasiswa</th>
            <th>Jumlah Matakuliah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jurusan as $item)
        <tr>
            <td>{{ $item->id_jurusan }}</td>
            <td>{{ $item->nama_jurusan }}</td>
            <td>{{ $item->akreditasi }}</td>
            <td>{{ $item->mahasiswa_count }}</td>
            <td>{{ $item->matakuliah_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>