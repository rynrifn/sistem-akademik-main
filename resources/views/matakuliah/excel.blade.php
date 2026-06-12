<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Matakuliah</th>
            <th>SKS</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matakuliah as $item)
        <tr>
            <td>{{ $item->id_matakuliah }}</td>
            <td>{{ $item->nama_matakuliah }}</td>
            <td>{{ $item->sks }}</td>
            <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>