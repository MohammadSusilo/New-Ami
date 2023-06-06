<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lcFVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    <title>Hasil Rapat Tinjauan Manajemen - </title>

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
                  <th class="colheader" style="vertical-align: middle;text-align: center; width: 50%"><p class="tulisan">FORMULIR PROSEDUR AKADEMIK</p></th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">No</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 25%">{{ $nomor }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" rowspan="3" style="vertical-align: middle;text-align: center; width: 50%"><p class="tulisan">HASIL RAPAT TINJAUAN MANAJEMEN</p></th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">Revisi</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 10%">{{ $revisi }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">Tanggal</th>
                  <th>{{ date("d.m.Y", strtotime($tgl)); }}</th>
                </tr>
                <tr class="rawheader">
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 12%">Halaman</th>
                  <th class="colheader" style="vertical-align: middle;text-align: left; width: 10%"></th>
                </tr>
              </thead>
            </table>
          </th>
        </tr>
      </thead>
      <tbody style="border: 1px solid black; border-collapse: collapse;">
        <tr>
          <th colspan="4" style="vertical-align: middle;text-align: center; width: 100%">          
            <p class="tulisan">HASIL RAPAT TINJAUAN MANAJEMEN</p>
          </th>
        </tr>
        <tr>
          <th colspan="4" style="text-align: left;">
            <p>&nbsp; &nbsp; &nbsp; &nbsp;Rapat tinjauan manajemen berlangsung pada : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
          </th>
        </tr>
        <tr>
          <th colspan="4" style="text-align: left;">
            <p>&nbsp; &nbsp; &nbsp; &nbsp;Hari/Tanggal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: 
              {{\Carbon\Carbon::parse($HasilTM_->tglTM)->isoFormat('dddd, D MMM Y');}}
            </p> 
          </th>
        </tr>
        <tr>
          <th colspan="4" style="text-align: left;">
            <p>&nbsp; &nbsp; &nbsp; &nbsp;Pukul &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: 
              {{ date("H:i", strtotime($HasilTM_->waktuTM)); }}
            </p>
          </th>
        </tr>
        <tr>
          <th colspan="4" style="text-align: left;">
            <p>&nbsp; &nbsp; &nbsp; &nbsp;Tempat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 
              POLITEKNIK NEGERI SEMARANG
            </p>
          </th>
        </tr>
        <tr>
          <th colspan="4" style="text-align: left;">
            <p>&nbsp; &nbsp; &nbsp; &nbsp;Agenda &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 
              Terlampir dalam undangan dan rapat Tinjauan Manajemen
            </p>
          </th>
        </tr>

        <tr>
          <th colspan="4"></th>
        </tr>
        <thead>
        <tr>
          <th style="border: 1px solid black; text-align: center; vertical-align: middle;">No</th>
          <th style="border: 1px solid black; text-align: center; vertical-align: middle;">Subjek</th>
          <th style="border: 1px solid black; text-align: center; vertical-align: middle;">Uraian</th>
          <th style="border: 1px solid black; text-align: center; vertical-align: middle;">Hasil Pembahasan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($HasilTM as $key=>$value)
          <tr>
            <td style="border: 1px solid black; vertical-align: middle;">{{ ++$key }}</td>
            <td style="border: 1px solid black; vertical-align: middle;">{{ $value->subjek }}</td>
            <td style="border: 1px solid black; vertical-align: middle;">{{ $value->uraian }}</td>
            <td style="border: 1px solid black; vertical-align: middle;">{{ $value->hasilPembahasan }}</td>
          </tr>
        @endforeach
        </tbody>
      </tbody>
      <tfoot style="border: 1px solid black; border-collapse: collapse;">
        <tr>
          <td colspan="4">
            @php
              setlocale(LC_TIME, 'id_ID.utf8');
            @endphp
                <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Semarang, {{\Carbon\Carbon::parse()->isoFormat('D MMMM Y');}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Disetujui oleh,</td>
                        <td colspan="2">Dibuat oleh,</td>
                      </tr>
                      <tr>
                        <td colspan="2">Direktur</td>
                        <td colspan="2">Kepala PPMP,</td>
                      </tr>
                      <tr>
                        <td colspan="2"><img src="{{asset($signature)}}" alt="signature" width="100px" height="100px"/></td>
                        <td colspan="2"><img src="{{asset($signature)}}" alt="signature" width="100px" height="100px"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">{{ $Direktur }}</td>
                        <td colspan="2">{{ $PPMP }}</td>
                      </tr>
                    </tbody>
                </table>
          </td>
        </tr>
      </tfoot>
    </table>

  


    <script type="text/php">
      if ( isset($pdf) ) { 
          $pdf->page_script('
              if ($PAGE_NUM > 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 140;
                  $x = 430;
                  $pdf->text($x, $y, $pageText, $font, $size);
              } 
              elseif ($PAGE_NUM = 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                  $y = 160;
                  $x = 430;
                  $pdf->text($x, $y, $pageText, $font, $size);
              } 
          ');
      }
    </script> 
</body>
</html>