@extends('layout.main')

@section('title')
Example Form
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">
    <a href="javascript:void(0)">Example Form</a>
</li>
@endsection

@section('action')
<a href="" class="btn btn-primary">Submit</a>
<a href="" class="btn btn-default">Cancel</a>
@endsection

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <form>
                <div class="form-group">
                    <label>Select2</label>
                    {!! Form::select('select2', ['Option 1' => 'Option 1', 'Option 2' => 'Option 2'], null, ['placeholder' => 'Select', 'data-input-type' => 'select2']); !!}
                </div>
                <div class="form-group">
                    <label>AutoNumeric</label>
                    {!! Form::text('textbox', null, ['class' => 'form-control', 'data-input-type' => 'autonumeric']) !!}
                </div>
                <div class="form-group">
                    <label>Datepicker</label>
                    {!! Form::text('datepicker', null, ['class' => 'form-control', 'data-input-type' => 'datepicker']) !!}
                </div>
                <div class="form-group">
                    <label>Clockpicker</label>
                    {!! Form::text('clockpicker', null, ['class' => 'form-control', 'data-input-type' => 'clockpicker']) !!}
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="showBootboxModal()">Show Bootbox Modal</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="bootbox.alert('Bootbox alert message')">Show Bootbox Alert</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="bootboxConfirm('Are you sure you?', '{{ URL::to('/') }}')">Show Confirm Dialog</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="toastr.success('Success toast message')">Show Toast</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Date Time</th>
                        <th>Time</th>
                        <th>Human Date</th>
                        <th>Human Date Time</th>
                        <th>Number</th>
                        <th>Number Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="formatter-date"></td>
                        <td id="formatter-date-time"></td>
                        <td id="formatter-time"></td>
                        <td id="formatter-human-date"></td>
                        <td id="formatter-human-date-time"></td>
                        <td id="formatter-number"></td>
                        <td id="formatter-number-value"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('sidebarRight')
<nav id="tabList1" class="section-nav profilvendor active">
    <ul class="nav flex-column">
        <!-- Tab 1 -->
        <li class="divider mb-0"><span>Data Utama</span></li>
        <li class="nav-item"><a class="nav-link active" href="#informasiAkun">Informasi Akun</a></li>
        <li class="nav-item"><a class="nav-link" href="#alamatPerusahaan">Alamat Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
        <li class="nav-item"><a class="nav-link" href="#kategorisasi">Kategorisasi</a></li>
    </ul>
</nav>
<nav id="tabList2" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 2 -->
        <li class="divider mb-0"><span>Data Legal</span></li>
        <li class="nav-item"><a class="nav-link active" href="#legalAktaPerusahaan">Akta Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link" href="#legalKemenkumham">SK Kemenkumham</a></li>
        <li class="nav-item"><a class="nav-link" href="#legalIzin">Ijin</a></li>
        <li class="nav-item"><a class="nav-link" href="#legalSertifikat">Sertifikat</a></li>
    </ul>
</nav>
<nav id="tabList3" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 3 -->
        <li class="divider mb-0"><span>Data Pajak</span></li>
        <li class="nav-item"><a class="nav-link active" href="#pajakNPWP">NPWP</a></li>
        <li class="nav-item"><a class="nav-link" href="#pajakPKP">PKP</a></li>
        <li class="nav-item"><a class="nav-link" href="#pajakSPT">Laporan SPT Tahunan</a></li>
        <li class="nav-item"><a class="nav-link" href="#legalSertifikat">Sertifikat</a></li>
    </ul>
</nav>
<nav id="tabList4" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 4 -->
        <li class="divider mb-0"><span>Data Keuangan</span></li>
        <li class="nav-item"><a class="nav-link active" href="#dataKeuanganModal">Modal</a></li>
        <li class="nav-item"><a class="nav-link" href="#dataKeuanganRekening">Rekening Bank</a></li>
        <li class="nav-item"><a class="nav-link" href="#dataKeuanganLaporan">Laporan Tahunan</a></li>
    </ul>
</nav>
<nav id="tabList5" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 5 -->
        <li class="divider mb-0"><span>Saham</span></li>
        <li class="nav-item"><a class="nav-link active" href="#saham">Saham</a></li>
    </ul>
</nav>
<nav id="tabList6" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 6 -->
        <li class="divider mb-0"><span>Pengurus</span></li>
        <li class="nav-item"><a class="nav-link active" href="#pengurusPerusahaan">Pengurus Perusahaan</a></li>
    </ul>
</nav>
<nav id="tabList7" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 7 -->
        <li class="divider mb-0"><span>Klasifikasi</span></li>
        <li class="nav-item"><a class="nav-link active" href="#klasifikasiBarang">Barang yang Bisa Dipasok</a></li>
        <li class="nav-item"><a class="nav-link" href="#klasifikasiJasa">Jasa yang Bisa Dipasok</a></li>
    </ul>
</nav>
<nav id="tabList8" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 8 -->
        <li class="divider mb-0"><span>Personil</span></li>
        <li class="nav-item"><a class="nav-link active" href="#personil">Data Personil</a></li>
    </ul>
</nav>
<nav id="tabList9" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 9 -->
        <li class="divider mb-0"><span>Sertifikasi</span></li>
        <li class="nav-item"><a class="nav-link active" href="#sertifikasi">Keterangan Sertifikasi</a></li>
    </ul>
</nav>
<nav id="tabList10" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 10 -->
        <li class="divider mb-0"><span>Fasilitas / Peralatan</span></li>
        <li class="nav-item"><a class="nav-link active" href="#fasilitas">Keterangan Fasilitas/Peralatan</a></li>
    </ul>
</nav>
<nav id="tabList11" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 11 -->
        <li class="divider mb-0"><span>Pengalaman</span></li>
        <li class="nav-item"><a class="nav-link active" href="#pengalaman">Pengalaman Pekerjaan</a></li>
    </ul>
</nav>
<nav id="tabList12" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 12 -->
        <li class="divider mb-0"><span>Data Tambahan</span></li>
        <li class="nav-item"><a class="nav-link active" href="#dataTambahanPrincipal">Prinsipal</a></li>
        <li class="nav-item"><a class="nav-link" href="#dataTambahanAfiliasi">Afiliasi</a></li>
        <li class="nav-item"><a class="nav-link" href="#dataTambahanSubkontraktor">Subkontraktor</a></li>
    </ul>
</nav>
<nav id="tabList13" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 13 -->
        <li class="divider mb-0"><span>Data Dokumen</span></li>
        <li class="nav-item"><a class="nav-link active" href="#dataDokumen">Kelengkapan Dokumen</a></li>
        <li class="nav-item"><a class="nav-link" href="#dataDokumenCatatan">Catatan</a></li>
    </ul>
</nav>
<nav id="tabList14" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 14 -->
        <li class="divider mb-0"><span>Catatan</span></li>
        <li class="nav-item"><a class="nav-link active" href="#catatan">Komentar Internal</a></li>
    </ul>
</nav>
<nav id="tabList15" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 15 -->
        <li class="divider mb-0"><span>Afiliasi</span></li>
        <li class="nav-item"><a class="nav-link active" href="#afiliasi">Data Afiliasi</a></li>
    </ul>
</nav>
<nav id="tabList16" class="section-nav profilvendor">
    <ul class="nav flex-column">
        <!-- Tab 16 -->
        <li class="divider mb-0"><span>Keaktifan</span></li>
        <li class="nav-item"><a class="nav-link active" href="#keaktifan">Data Keaktifan</a></li>
    </ul>
</nav>
@endsection

@section('jsPage')
<script>
    function showBootboxModal() {
        bootbox.dialog({
            title: 'Bootbox Modal',
            message: "This is bootbox modal!",
            size: 'large'
        });
    }
    
    $(function() {
        $('#formatter-date').html(Formatter.date('2022-09-12')); 
        $('#formatter-date-time').html(Formatter.dateTime('2022-09-12 01:02:03')); 
        $('#formatter-time').html(Formatter.time('2022-09-12 01:02:03'));
        $('#formatter-human-date').html(Formatter.humanDate('2022-09-12 01:02:03')); 
        $('#formatter-human-date-time').html(Formatter.humanDateTime('2022-09-12 01:02:03'));
        $('#formatter-number').html(Formatter.number('10000000.00'));
        $('#formatter-number-value').html(Formatter.numberValue('10.000.000,00'));
    });
</script>
@endsection