@extends('layouts.index')
@section('content')
@if (Auth::user()->role != 'siswa')
@php
$rs1 = App\Siswa::all();
$rs2 = App\Matpel::all();
$rs3 = App\Predikat::all();
@endphp
    <form action="{{ route('nilai.store')}}" method="POST">
        @csrf
        <section>      
            <div class="panel">

                    <div class="col-md-4">
                <div class="form-group">      
                  <select class="select2_single form-control @error ('siswa') is-invalid @enderror" name="siswa" tabindex="-1">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($rs1 as $siswa)
                    @php
                        $sel = ( old('siswa') == $siswa['id']) ? 'selected' : ''
                    @endphp
                        <option value="{{ $siswa['id']}}" {{ $sel }}>{{ $siswa['nama_depan'].' '.$siswa['nama_belakang']}}</option>
                    @endforeach
                  </select>
                  @error('siswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  
                </div> 
            </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Sikap/Afektif</th>
                            <th><a href="#" class="addRow">
                                <i class="glyphicon glyphicon-plus"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                              <select class="select2_single form-control @error ('matpel') is-invalid @enderror" name="matpel[]" tabindex="-1">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach($rs2 as $matpel)
                                @php
                                    $sel = ( old('matpel') == $matpel['id']) ? 'selected' : ''
                                @endphp
                                    <option value="{{ $matpel['id']}}" {{ $sel }}>{{ $matpel['nama']}}</option>
                                @endforeach
                              </select>
                              @error('matpel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" name="nilai[]" value="{{ old('nilai') }}" class="form-control @error ('nilai') is-invalid @enderror nilai">
                              @error('nilai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <select class="select2_single form-control @error ('predikat') is-invalid @enderror" name="predikat[]" tabindex="-1">
                                <option value="">-- Pilih Predikat --</option>
                                @foreach($rs3 as $predikat)
                                @php
                                    $sel = ( old('predikat') == $predikat['id']) ? 'selected' : ''
                                @endphp
                                    <option value="{{ $predikat['id']}}" {{ $sel }}>{{ $predikat['nama']}}</option>
                                @endforeach
                              </select>
                              @error('predikat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </td>
                            
                            <td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a> </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: none"></td>
                            <td>Total</td>
                            <td><b class="total"></b></td>
                            <td><input type="submit" name="" value="submit" class="btn btn-success"></td>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </section>
    </form>

<script type="text/javascript">
    $('tbody').delegate('.nilai','keyup',
        function(){
            var tr=$(this).parent().parent();
           // tr.find('.nilai').val(nilai);
            total();
        });
    function total(){
        var total=0;
        $('.nilai').each(function(i,e){
            var nilai=$(this).val()-0;
            total += nilai;
        });
        $('.total').html(total);
    }    
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow()
    {
        var tr='<tr>'+
            '<td><select class="select2_single form-control @error ('matpel') is-invalid @enderror" name="matpel[]" tabindex="-1"><option value="">-- Pilih Mata Pelajaran --</option>@foreach($rs2 as $matpel) @php $sel = ( old('matpel') == $matpel['id']) ? 'selected' : '' @endphp <option value="{{ $matpel['id']}}" {{ $sel }}>{{ $matpel['nama']}}</option> @endforeach</select></td>'+
            '<td><input type="text" name="nilai[]" value="{{ old('nilai') }}" class="form-control @error ('nilai') is-invalid @enderror nilai">@error('nilai') <div class="invalid-feedback">{{ $message }}</div> @enderror</td>'+
            '<td><select class="select2_single form-control @error ('predikat') is-invalid @enderror" name="predikat[]" tabindex="-1"><option value="">-- Pilih Predikat --</option> @foreach($rs3 as $predikat) @php $sel = ( old('predikat') == $predikat['id']) ? 'selected' : '' @endphp <option value="{{ $predikat['id']}}" {{ $sel }}>{{ $predikat['nama']}}</option> @endforeach </select></td>'+
            ' <td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a> </td>'+
            '</tr>';

        $('tbody').append(tr);    
    };
    $('.remove').live('click',function(){
        var last=$('tbody tr').length;
        if(last==1){
            alert("You can not remove last row");
        }
        else{
           $(this).parent().parent().remove();
        }

    });

</script> 
@else
  @include('auth.terlarang')
  @endif

@endsection