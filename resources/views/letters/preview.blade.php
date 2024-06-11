<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pratinjau - {{ $type['label'] }}</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/preview.surat.css') }}">
</head>
<body>
    <div class="page">
        <div class="header">
            <table style="margin-bottom: 5px">
                <tbody>
                    <tr>
                        <td style="float: right;"><img src="{{ asset('logo-buleleng.png') }}" alt=""></td>
                        <td>
                            <p class="text-big"><b>PEMERINTAH KABUPATEN BULELENG</b></p>
                            <p class="text-big"><b>KECAMATAN TEJAKULA</b></p>
                            <p class="text-big"><b>PERBEKEL TEMBOK</b></p>
                            <p class="text-tiny">Jl. Raya Singaraja - Amlapura Telp. 0362 3304253  Kode Pos 81173</p>
                            <p class="text-tiny">Website : <a href="http://tembok-buleleng.desa.id"> tembok-buleleng.desa.id</a> Email : <a href="mailto:pemdes.desatembok@gmail.com">pemdes.desatembok@gmail.com</a></p>
                        </td>
                        <td>
                            <img src="{{ asset('logo-desa.png') }}" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>

        <div class="sub-header">
            <p class="text-underline">{{ $type['label'] }}</p>
            <p>Nomor : {{ $number }}</p>
        </div>

        <div class="content">
            <p>Yang Bertanda tangan di bawah ini :</p>
            <table class="table-default">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $signature['name'] }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $signature['position'] }}</td>
                </tr>
            </table>

            <p>Dengan ini menerangkan bahwa :</p>
            <table style="border: 0;" class="table-default">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    @if ($type['id'] == App\Models\LetterSubmission::TYPE_MENINGGAL)
                        <td>{{ $applicant['name'] }} (Alm)</td>
                    @else
                        <td>{{ $applicant['name'] }}</td>
                    @endif
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $applicant['gender'] }}</td>
                </tr>
                <tr>
                    <td style="white-space:nowrap;">Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $applicant['place_birth'] }}, {{ $applicant['date_birth'] }}</td>
                </tr>
                @if ($applicant['identity_number'] != "")

                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $applicant['identity_number'] }}</td>
                </tr>

                @endif
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $applicant['religion'] }}</td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td>{{ $applicant['nationality'] }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $applicant['profession'] }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $applicant['address'] }}</td>
                </tr>
                <tr>
                    <td>Keperluan</td>
                    <td>:</td>
                    <td>{{ $necessity }}</td>
                </tr>
            </table>
                @if ($type['id'] == App\Models\LetterSubmission::TYPE_ASAL_USUL)
                    @include('letters.content.asal_usul')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_BEDA_NAMA)
                    @include('letters.content.beda_nama')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_BELUM_KAWIN)
                    @include('letters.content.belum_kawin')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_KEHILANGAN)
                    @include('letters.content.kehilangan')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_KELAKUAN_BAIK)
                    @include('letters.content.kelakuan_baik')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_LAHIR)
                    @include('letters.content.lahir')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_SKTM)
                    @include('letters.content.sktm')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_MASIH_DALAM_PROSES)
                    @include('letters.content.masih_dalam_proses')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_MENINGGAL)
                    @include('letters.content.meninggal')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_USAHA)
                    @include('letters.content.usaha')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_WALI)
                    @include('letters.content.wali')
                @elseif ($type['id'] == App\Models\LetterSubmission::TYPE_WARIS)
                    @include('letters.content.waris')
                @else
                    <p>FORMAT SURAT BELUM TERSEDIA!</p>
                @endif
        </div>

        <div class="footer">
            <table align="right">
                <tbody style="float: right;">
                    <tr>
                        <td>{{ $village }}, {{ $created_at }}</td>
                    </tr>
                    <tr>
                        <td>{{ $signature['position'] }}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('qr.png') }}"></td>
                    </tr>
                    <tr>
                        <td class="text-underline"><strong>{{ $signature['name'] }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
