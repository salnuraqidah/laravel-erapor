<!DOCTYPE html>
<html>
<head>
	<title>Hasil Belajar Siswa</title>
</head>
<body>
	@php
		$rs1 = App\Sekolah::all();
		$rs2 = App\WaliKelas::all();
		$rs = App\Semester::all();
		$nilai = collect($ar_nilai)->sum('nilai');
		$rata = collect($ar_nilai)->average('nilai')
	@endphp

	<center>
		@foreach ($rs as $semester)
		
		<h3> Hasil Belajar Siswa Semester {{ $semester->semester }}	<br/>
		
		@foreach ($sekolah as $s)
		{{ $s->nama_sekolah }} {{ $s->kota }}</h3>
		
	</center>
	<table style="height: 73px;" width="384">
		<tbody>
		<tr>
		<td style="width: 184px;">Nama Peserta Didik</td>
		<td style="width: 214px;">: <b>{{ $siswa->nama_depan.' '.$siswa->nama_belakang }}</b></td>
		<td style="width: 184px;">Kelas / Jurusan</td>
		<td style="width: 184px;">: {{ $siswa->kelas['nama'] }} / {{ $siswa->jurusan['nama'] }} </td>
		</tr>
		<tr>
		<td style="width: 184px;">Nomor Induk</td>
		<td style="width: 214px;">: <b>{{ $siswa->nisn }}</b></td>
		<td style="width: 184px;">Tahun Pelajaran</td>
		<td style="width: 184px;">: {{ $semester->tahun_ajaran }}</td>
		@endforeach
		</tr>
		</tbody>
		</table>
		<br>
<table border="1" style="width: 100%">
	<thead>
		<tr>
			<th><strong>No</strong></th>
			<th><strong>Mata Pelajaran</strong></th>
			<th><strong>KKM</strong></th>
			<th><strong>Nilai</strong></th>
			<th><strong>Keterangan</strong></th>
			<th><strong>Sikap/Afektif</strong></th>
		</tr>
	</thead>
	<tbody>
		@php
			  $no=1;
		  @endphp
      
        @foreach ($ar_nilai as $data)    
                    <tr>
                    <td>{{ $no++ }}</td>
					<td>{{ $data->matpel }}</td>
					<td>{{ $data->kkm }}</td>
					<td>{{ $data->nilai }}</td>
					@php
					$ket = ($data->nilai <= $data->kkm) ? 'Tidak Lulus' : 'Lulus';	
					$warna = ($ket == 'Tidak Lulus') ? 'red' : 'black';
					@endphp
					<td><font color="{{ $warna }}">{{ $ket }}</font></td>
					<td>{{ $data->predikat }}</td>
					</tr>
		@endforeach
					<tr>
						<td colspan="3">Total Nilai</td>
           			 	<td colspan="3">{{ $nilai }}</td>
					</tr>
					<tr>
						<td colspan="3">Rata-rata Nilai</td>
						<td colspan="3">{{ round($rata,2) }}</td>
					</tr>			
		</tbody>
	</table>
	<br>
</center>
@php
$tgl=date('d F Y');
@endphp
<table width="100%">
	<tbody>
		<tr>
			<td></td>
		<td align="center">Mengetahui,</td>
		<td align="right">{{ $s->kota }}, {{ $tgl }}</td>
		</tr>
		<tr>
		<td>Orang tua / Wali Murid</td>
		<td align="center">Kepala Sekolah</td=>
		<td align="right">Wali kelas</td>
		</tr>
		<tr>
			<td rowspan="16"  valign="bottom">.............</td>
			<td rowspan="16" align="center" valign="bottom">{{ $s->kepala_sekolah }}</td>
			@foreach ($walas as $wa)
			@if ($siswa->kelas['id'] == $wa->kelas_id && $siswa->jurusan['id'] == $wa->jurusan_id )
			<td rowspan="16" valign="bottom" align="right">{{ $wa->nama }}</td>
			@endif
			@endforeach
		</tr>
	</tbody>
</table>

	@endforeach {{-- tutup foreach sekolah --}}
	
</body>
</html>