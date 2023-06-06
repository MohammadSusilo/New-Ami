<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lcFVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    <title>Laporan Audit Mutu Internal</title>

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
          <th colspan="5">
            <table class="header" border="2">
              <thead>
                <tr class="rawheader">
                  <th class="colheader" rowspan="4" style="vertical-align: middle;text-align: center; width: 20%"><center><img src="{{ asset('images/logopolines.jpg') }}" alt="logopolines" width="80px" height="80px"/><br>SPMI</center></th>
                  <th class="colheader" style="vertical-align: middle;text-align: center; width: 50%"><p class="tulisan">FORMULIR PROSEDUR AKADEMIK</p></th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">No</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">{{ $DokumenInduk->nomor }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" rowspan="3" style="vertical-align: middle;text-align: center; width: 50%"><p class="tulisan">LAPORAN AUDIT MUTU INTERNAL</p></th>
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
          <th colspan="5" style="vertical-align: middle;text-align: center; width: 100%">          
            <p class="tulisan">LAPORAN AUDIT MUTU INTERNAL</p>
          </th>
        </tr>
        <tr>
          <th colspan="4" style="text-align: right;">
            
          </th>
          <th style="text-align: left;">
            Halaman : 
          </th>
        </tr>
      </thead>
      <tbody>
        <tr style="border:1px solid #000;text-align: center;padding: 4px;">
            @php 
                $profile = App\Models\profile::get()
            @endphp
          <th style="text-align: left;">
            Auditee: 
          </th>
          <th style="text-align: left;">
            @foreach($auditReports_->users as $user)
              @if($user->role_id == 3)
                <li>{{ $user->name }}</li>
              @endif
            @endforeach
          </th>
          <th style="text-align: left;">
            Tanda Tangan: 
          </th>
          <th style="text-align: center;">
            @foreach($auditReports_->users as $user)
              @if($user->role_id == 3)
                @foreach($profile as $prof)
                    @if($prof->signature != null)
                        @if($user->id == $prof->user_id)
                          <li><img src="{{ asset($prof->signature) }}" width="25%"></li>
                        @endif
                    @else
                    @endif
                @endforeach
              @endif
            @endforeach
          </th>
          <th colspan="1" style="text-align: left;">
            Tanggal:
            {{ date("d.m.Y"); }}
          </th>
        </tr>
        <tr style="border:1px solid #000;text-align: center;padding: 4px;">
          <th style="text-align: left;">
            Auditor: 
          </th>
          <th style="text-align: left;">
            @foreach($auditReports_->users as $user)
              @if($user->role_id == 2)
                <li>{{ $user->name }}</li>
              @endif
            @endforeach
          </th>
          <th style="text-align: left;">
            Tanda Tangan: 
          </th>
          <th style="text-align: center;">
            @foreach($auditReports_->users as $user)
              @if($user->role_id == 2)
                @foreach($profile as $prof)
                    @if($prof->signature != null)
                        @if($user->id == $prof->user_id)
                          <li><img src="{{ asset($prof->signature) }}" width="25%"></li>
                        @endif
                    @else
                    @endif
                @endforeach
              @endif
            @endforeach
          </th>
          <th></th>
        </tr>

        <tr>
          <th colspan="5"></th>
        </tr>
        <tr>
          <th style="border: 1px solid black; border-collapse: collapse; text-align: center;">No</th>
          <th style="border: 1px solid black; border-collapse: collapse; text-align: center;">Standar</th>
          <th style="border: 1px solid black; border-collapse: collapse; text-align: center;">Uraian Temuan</th>
          <th style="border: 1px solid black; border-collapse: collapse; text-align: center;">Kategori Temuan (NC/AOC/OFI)</th>
          <th style="border: 1px solid black; border-collapse: collapse; text-align: center;">Saran Perbaikan</th>
        </tr>
        @foreach($auditReports as $key=>$value)
          <tr>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center">{{ ++ $key }}</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center">{{ $value->kodeStandar }} - {{ $value->namaStandar }}</td>
            <td style="border: 1px solid black; border-collapse: collapse;">{!! $value->uraianTemuan !!}</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center">{{ $value->kategoriTemuan }}</td>
            <td style="border: 1px solid black; border-collapse: collapse;">{!! $value->saranPerbaikan !!}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">
            <div>
              <table>
                <tbody>
                  <tr>
                    <td colspan="1">NC (Non-Conformity)</td>
                    <td colspan="1">adalah temuan yang bersifat ketidaksesuaian mayor, yaitu temuan-temuan yang memiliki dampak 
                      luas/kritikal terhadap persyaratan mutu produk/pelayanan dan persyaratan sistem manajemen mutu
                      Contoh : Pelanggaran sistem secara total (sistem tidak dilaksanakan)</td>
                  </tr>
                  <tr>
                    <td colspan="1">AOC (Area of Concern)</td>
                    <td colspan="1">adalah temuan yang bersifat ketidaksesuaian minor, yaitu temuan-temuan yang memiliki dampak kecil/terbatas terhadap persyaratan mutu produk/pelayanan dan persyaratan sistem manajemen mutu
                      Contoh : - ketidaksempurnaan dan ketidakkonsistenan dalam penerapan sistem</td>
                  </tr>
                  <tr>
                    <td>OFI (Opportunity for Improvement)</td>
                    <td colspan="2">adalah temuan yang bukan merupakan ketidaksesuaian yang dimaksudkan untuk penyempurnaan-penyempurnaan</td>
                  </tr>
                  <tr>
                    <td colspan="4">** hanya diisi bila auditor dapat memastikan saran perbaikannya adalah efektif.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tfoot>
    </table>

  


    <script type="text/php">
      if ( isset($pdf) ) { 
          $pdf->page_script('
              if ($PAGE_COUNT > 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 140;
                  $x = 485;
                  $pdf->text($x, $y, $pageText, $font, $size);

                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 197;
                  $x = 485;
                  $pdf->text($x, $y, $pageText, $font, $size);
              } 
              elseif ($PAGE_COUNT = 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 160;
                  $x = 435;
                  $pdf->text($x, $y, $pageText, $font, $size);

                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 215;
                  $x = 520;
                  $pdf->text($x, $y, $pageText, $font, $size);
              } 
          ');
      }
    </script> 
</body>
</html>