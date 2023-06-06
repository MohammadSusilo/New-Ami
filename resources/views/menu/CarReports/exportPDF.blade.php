<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lcFVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    <title>Permintaan Tindakan Perbaikan dan Pencegahan</title>

   <style>
        @page { 
            margin-left:    1,5cm;
            margin-right:   1,5cm; 
            margin-top:     1,5cm;
            margin-bottom:  1,5cm; 
        }
        @media print {
          * {
            -webkit-print-color-adjust: exact !important;
          }
        }
        /* * {
          font-family: "Mulish", sans-serif, Arial;
        } */

        /* body, body p{
            font-family:Arial;
            font-size:11pt;
            line-height:1.5em;
        }

        header {
          position: fixed;
          top: 0;
          bottom: 3em;
          display: flex;
          z-index: 4;
        }
        main {
          top: 3em;
          width: 100%;
          padding-top: 200px;
          padding-bottom: 50px;
          counter-reset: pageTotal;
          z-index: 4;
        }

        table {
          width: 100%;
          border-collapse: collapse;
        }

        thead {
          display: table-header-group;
        }
        
        tr {
          page-break-inside: avoid;
          page-break-after: auto;
        }

        td,th {
		      text-align: left;
          padding: 1px;
          word-wrap: break-word;
          vertical-align:top;
          font-size:11pt;
          line-height:1.15em;
        }
        
        .default {
            font-family:Arial;
            font-size:11pt;
            line-height:1.5em;
        }
        ul{
            list-style-type:none;
            padding:0px;
            margin:0px;
            line-height:1.5em;
        }

        li{
            background-repeat:no-repeat;
            background-position:0px 5px; 
            padding-left:14px;
        }

        p{
            text-align:justify;
        }
    
        .tulisan{
            text-align: center;
            font-weight: bold;
            font-family:Arial;
            font-size:14pt;
            line-height:1.5em;
        }

        .column {
          float: left;
          width: 33%;
        }

        .row:after {
          content: "";
          display: table;
          clear: both;
        } */




        .section-padding {
          padding-bottom: 20px;
        }
        .table > :not(:last-child) > :last-child > * {
          border-bottom-color: inherit;
        }
        strong {
          font-weight: 700 !important;
        }
        .page-header,
        .page-header-space {
          height: 250px;
        }
        .page-footer,
        .page-footer-space {
          height: 100px;
        }
        .page-footer {
          position: fixed;
          bottom: 0;
          width: 100%;
        }
        .page-header {
          position: fixed;
          top: 0mm;
          width: 100%;
        }
        .page {
          page-break-after: always;
        }
        .header, .rawheader, .colheader{
          width: 100%;
          border: 1px solid black;
          border-collapse: collapse;
        }
        .data{
          width: 100%;
          border: 1px solid black;
          border-collapse: collapse;
        }
        .tulisan{
            text-align: center;
            font-weight: bold;
            font-family:Arial;
            font-size:14pt;
            line-height:1.5em;
        }
        .column {
          text-align: left;
          float: left;
          width: 33%;
        }
        .row:after {
          content: "";
          display: table;
          clear: both;
        } 
        ul{
            list-style-type:none;
            padding:0px;
            margin:0px;
            line-height:1.5em;
        }
        li{
            background-repeat:no-repeat;
            background-position:0px 5px; 
            padding-left:14px;
        }
        p{
            text-align:justify;
        }
        body {
          margin-left:    1,5cm;
          margin-right:   1,5cm; 
          margin-top:     1,5cm;
          margin-bottom:  1,5cm; 
          font-family:Arial;
          font-size:11pt;
          line-height:1.5em;
        }
        table {
          page-break-inside: auto;
        }
        tr {
          page-break-inside: avoid;
          page-break-after: auto;
        }
        thead {
          display: table-header-group;
        }
        tfoot {
          display: table-footer-group;
        }   

        
   </style>
  </head>
<body>
    <table style="padding: 0; margin: 0; width: 100%;">
      <thead>
        <tr>
          <th colspan="4">
            <table class="header" border="2">
              <thead>
                <tr class="rawheader">
                  <th class="colheader" rowspan="4" style="vertical-align: middle;text-align: center; width: 20%"><center><img src="{{ asset('images/logopolines.jpg') }}" alt="logopolines" width="80px" height="80px"/><br>SPMI</center></th>
                  <th class="colheader" style="vertical-align: middle;text-align: center; width: 50%"><p class="tulisan">PROSEDUR AKADEMIK</p></th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">No</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">{{ $DokumenInduk->nomor }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" rowspan="3" style="vertical-align: middle;text-align: center; width: 50%"><p class="tulisan">PERMINTAAN TINDAKAN <br>PERBAIKAN DAN PENCEGAHAN</p></th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">Revisi</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">{{ $DokumenInduk->revisi }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">Tanggal</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">{{ date("d.m.Y", strtotime($DokumenInduk->updated_at)); }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">Halaman</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%"></th>
                </tr>
              </thead>
            </table>
          </th>
        </tr>
        <tr>
          <th colspan="4" style="vertical-align: middle;text-align: center; width: 100%">          
            <p class="tulisan">PERMINTAAN TINDAKAN PERBAIKAN DAN PENCEGAHAN</p>
          </th>
        </tr>
        <tr>
          <th colspan="3" style="text-align: right;">
            
          </th>
          <th style="text-align: left;">
            Halaman : 
          </th>
        </tr>
      </thead>
      <tbody>
      @foreach($CAR as $key=>$value)
        @foreach($unitKerja as $key=>$UK)
          @if($UK->id == $CAR_->unitkerja_id)
          <tr>
            <th colspan="4" style="text-align: left;">Kepada Yth : Ka. {{ $UK->name }}</th>
          </tr>
          <tr>
            <th colspan="3" style="text-align: left;">Jur/Bag/Unit : {{ $UK->name }}</th>
            <th style="text-align: left;">Periode : {{ $CAR_->periode }}</th>
          </tr>
          <tr>
            <th colspan="3" style="text-align: left;">Dari : <b>Kepala PPMP</b></th>
            <th style="text-align: left;">Tanggal : {{\Carbon\Carbon::parse()->isoFormat('D MMMM Y');}}</th>
          </tr>
          @endif
        @endforeach          
        <tr>
          <th colspan="4"></th>
        </tr>
          
            <tr>
              <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Standar No: {{ $value->kodeStandar }}</td>
              <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Prosedur/Proses: {{ $value->namaStandar }}</td>
            </tr>
            <tr>
              <td colspan="4" style="border: 1px solid black; border-collapse: collapse;">Hasil Temuan Ketidaksesuaian: 
                <br>
                {{ $value->uraianTemuan }}
                <br>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Kategori Temuan: {{ $value->kategoriTemuan }}</td>
              <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Tanggal Perbaikan: {{\Carbon\Carbon::parse()->isoFormat('D MMMM Y', $value->updated_at);}}</td>
            </tr>
            <tr style="border:1px solid #000;text-align: center;padding: 4px;">
              @php 
                  $jadwals = App\Models\jadwalAudit::with('users')->where('id', $value->jadwal_id)->get();
                  $profile = App\Models\profile::get()
              @endphp
              @foreach($jadwals as $jadwal)
              <td style="text-align: left;">Auditor : </td>
              <td style="text-align: left;">
                @foreach($jadwal->users as $user)
                  @if($user->role_id == 2)
                    <li>{{ $user->name }}</li>
                  @endif
                @endforeach
              </td>
              <td style="text-align: left;">Auditee : </td>
              <td style="text-align: left;">
                @foreach($jadwal->users as $user)
                  @if($user->role_id == 3)
                    <li>{{ $user->name }}</li>
                  @endif
                @endforeach
              </td>
              @endforeach
            </tr>
            <tr>
              <td colspan="4" style="border: 1px solid black; border-collapse: collapse;">
                Analisis Penyebab: 
                <br>
                {!! $value->analisiPenyebabMasalah !!}
                <br>
                <br>
                Tindakan Perbaikan: 
                <br>
                {!! $value->tindakanPenyelesaian !!}
                <br>
                <br>
                Tindakan Pencegahan: 
                <br>
                {!! $value->tindakanPencegahan !!}
                <br>
              </td>
            </tr>
            <tr style="border:1px solid #000;text-align: center;padding: 4px;">
              @foreach($jadwals as $jadwal)
              <td colspan="3" style="border: 1px solid black; text-align: left;">Tanda Tangan Auditee: <br>
              @foreach($jadwal->users as $user)
                    @if($user->role_id == 3)
                        @foreach($profile as $prof)
                            @if($prof->signature != null)
                                @if($user->id == $prof->user_id)
                                    <img src="{{ asset($prof->signature) }}" width="25%">
                                @endif
                            @else
                            @endif
                        @endforeach
                    @endif
                  @endforeach
              </td>
              @endforeach
              <td colspan="1" style="border: 1px solid black; border-collapse: collapse;">Tanggal: {{\Carbon\Carbon::parse()->isoFormat('D MMMM Y');}}</td>
            </tr>
            <tr>
              <td colspan="4" style="border: 1px solid black; border-collapse: collapse;">Pemeriksaan Hasil Tindakan Perbaikan (close out): 
                <br>
                {{ $value->hasilPemeriksaan }}
                <br>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Hasil Verifikasi: {{ $value->status }}</td>
              <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Rekomendasi : {{ $value->rekomendasi }}</td>
            </tr>
            <tr style="border:1px solid #000;text-align: center;padding: 4px;">
              @foreach($jadwals as $jadwal)
              <td colspan="2" style="border: 1px solid black; text-align: left;">Tanda Tangan Auditor: <br>
                  @foreach($jadwal->users as $user)
                    @if($user->role_id == 2)
                        @foreach($profile as $prof)
                            @if($prof->signature != null)
                                @if($user->id == $prof->user_id)
                                    <img src="{{ asset($prof->signature) }}" width="25%">
                                @endif
                            @else
                            @endif
                        @endforeach
                    @endif
                  @endforeach
              </td>
              @endforeach
              @foreach($jadwals as $jadwal)
              <td style="border: 1px solid black; text-align: left;">Tanda Tangan Auditee: <br>
              @foreach($jadwal->users as $user)
                    @if($user->role_id == 3)
                        @foreach($profile as $prof)
                            @if($prof->signature != null)
                                @if($user->id == $prof->user_id)
                                    <img src="{{ asset($prof->signature) }}" width="25%">
                                @endif
                            @else
                            @endif
                        @endforeach
                    @endif
                  @endforeach
              </td>
              @endforeach
              <!--<td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Tanda Tangan Auditor: <br><br><br></td>-->
              <!--<td style="border: 1px solid black; border-collapse: collapse;">Tanda Tangan Auditee: <br><br><br></td>-->
              <td style="border: 1px solid black; border-collapse: collapse;">Tanggal: {{\Carbon\Carbon::parse()->isoFormat('D MMMM Y');}}</td>
            </tr>
            <tr>
              @if($PPMP != null)
                <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Kepala PPMP: {{ $PPMP['name'] }}</td>
              @else
                <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">Kepala PPMP: {{ $PPMP['name'] }}</td>
              @endif
              <td colspan="1" style="border: 1px solid black; border-collapse: collapse;">Tanda Tangan: <br><br><br></td>
              <td colspan="1" style="border: 1px solid black; border-collapse: collapse;">Tanggal: {{\Carbon\Carbon::parse()->isoFormat('D MMMM Y');}}</td>
            </tr>
          
          <tr>
            <td colspan="4">
              <br>
              <br>
              <br>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>

  


    <script type="text/php">
      if ( isset($pdf) ) { 
          $pdf->page_script('
              if ($PAGE_COUNT > 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 140;
                  $x = 440;
                  $pdf->text($x, $y, $pageText, $font, $size);

                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 197;
                  $x = 490;
                  $pdf->text($x, $y, $pageText, $font, $size);
              } 
              elseif ($PAGE_COUNT = 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 140;
                  $x = 480;
                  $pdf->text($x, $y, $pageText, $font, $size);

                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 197;
                  $x = 465;
                  $pdf->text($x, $y, $pageText, $font, $size);
              } 
          ');
      }
    </script> 
</body>
</html>