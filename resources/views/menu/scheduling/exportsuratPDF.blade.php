<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Pemberitahuan Audit Mutu Internal</title>

   <style>
        @page { 
            margin-left:    1,5cm;
            margin-right:   1,5cm; 
            margin-top:     1,5cm;
            margin-bottom:  1,5cm; 
        }

        body, body p{
            font-family:Arial;
            font-size:11pt;
            line-height:1.5em;
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
        .tabelview{
            border: 1px solid black;
        }
        table {
          width: 100%;
            border-collapse: collapse;
        }
        td,th {
		    text-align: left;
            padding: 1px;
            word-wrap: break-word;
            vertical-align:top;
            font-size:11pt;
            line-height:1.15em;
		    /* border:1px solid; */
        }
        textarea{
            text-align: left;
            word-wrap: break-word;
            vertical-align:top;
            font-size:11pt;
            line-height:1.15em;
            font-family:Arial;
            border:none;
            width:100%;
            height:auto;
            text-align:left;
        }
        .kodeunit{
            border:1px solid #000; 
            float: right;
            width: 120px;
            padding-top: 8px;
            padding-right: 5px;
            padding-bottom: 8px;
            padding-left: 5px;
            text-align: center;
            font-weight: bold;
            font-family:Arial;
            font-size:16pt;
            line-height:1.5em;
        }

        .tulisan{
            text-align: center;
            font-weight: bold;
            font-family:Arial;
            font-size:14pt;
            line-height:1.5em;
        }
        header {
          position: fixed;
          top: 0;
          display: flex;
        }
        main {
            width: 100%;
            padding-top: 200px;
            padding-bottom: 50px;
        }
        #header {
            position: fixed;
            top: 1cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            margin-left: 2cm;
            margin-right: 2cm;
        }

        header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }


        .page-break {
            page-break-after: always;
        }

        .footer .page-number:after { content: counter(page); }

        #pageCounter {
          counter-reset: pageTotal;
        }
        #pageCounter span {
          counter-increment: pageTotal; 
        }
        #pageNumbers {
          counter-reset: currentPage;
        }
        #pageNumbers div:before { 
          counter-increment: currentPage; 
          content: counter(currentPage) " / "; 
        }
        #pageNumbers div:after { 
          content: counter(page); 
        }

        /* Create two equal columns that floats next to each other */
        .column {
          float: left;
          width: 33%;
          /* padding: 10px;
          height: 300px; Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }

        .tab {
          margin-left: 150px;
        }
        .tabs {
          margin-left: 150px;
        }
        .tab3 {
          margin-left: 40px;
        }
        
   </style>
  </head>
<body>
<!-- <header style="position:fixed">Header</header> -->
  
    <header>
        <table class="table table-bordered" border="2">
            <thead>
              <tr>
                <th rowspan="4" style="vertical-align: middle;"><center><img src="{{asset('images/logopolines.jpg')}}" alt="logopolines" width="80px" height="80px"/><br>SPMI</center></th>
                <th style="vertical-align: middle;"><p class="tulisan">FORMULIR PROSEDUR AKADEMIK</p></th>
                <th style="vertical-align: middle;">No</th>
                <th style="vertical-align: middle;">Nothing</th>
              </tr>
              <tr>
                <th rowspan="3" style="vertical-align: middle;"><p class="tulisan">SURAT PEMBERITAHUAN AUDIT MUTU INTERNAL</p></th>
                <th>Revisi</th>
                <th>Nothing</th>
              </tr>
              <tr>
                <th>Tanggal</th>
                <th>{{ date("d.m.Y", strtotime($jadwalAudit_->tglAudit)); }}</th>
              </tr>
              <tr>
                <th>Halaman</th>
                <th>
                    <!-- <div class="footer fixed-section">
                      <span class="page-number"></span>/
                    </div> -->
                    <div id="pageNumbers">
                      <div class="page-number"></div>
                    </div>
                </th>
              </tr>
            </thead>
        </table>
    </header>

    <main>
      <div>
        <table style="width: 100%;" border="2" cellpadding="2">
          <tbody>
            <tr>
              <td>
                <center>
                  <h2>Surat Pemberitahuan</h2>
                </center>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;No. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;Lampiran &nbsp; &nbsp; &nbsp;: </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;Hal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Pemberitahuan AMI</p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;Yth.</p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;
                    @foreach($jadwalAudit_->users as $user)
                      @if($user->role_id =="3" || $user->role_id =="2")
                        <span class="badge badge-pill badge-primary">{{$user->name}}, </span>
                      @endif
                    @endforeach
                </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;Sehubungan dengan pelaksanaan audit mutu internal/evaluasi muru internal yang akan diselenggraakan pada : </p>
                @php
                  setlocale(LC_TIME, 'id_ID.utf8');
                @endphp
                <p class="tab">Hari &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {{\Carbon\Carbon::parse($jadwalAudit_->tglAudit)->isoFormat('dddd');}}</p>
                <p class="tab">Tanggal &nbsp; &nbsp;: {{ date("d F Y", strtotime($jadwalAudit_->tglAudit)); }}</p>
                <p class="tab">Pukul &nbsp; &nbsp; &nbsp; &nbsp;: {{ date("H:i", strtotime($jadwalAudit_->waktu)); }}</p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;Bapak/Ibu mempersiapkan diri sesuai dengan dokumen proses pelaksanaan kegiatan sesuai dengan tugas dan fungsi masing-masing.</p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;Atas perhatian dan kerja sama ini, kami ucapkan terima kasih.</p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Semarang, 
                {{\Carbon\Carbon::parse($jadwalAudit_->created_at)->isoFormat('D MMMM Y');}}</p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kepala PPMP</p><br><br><br><br>
                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;................................... </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </main>
    <div class="page_break"></div>
  

    <script type="text/php">
      if (isset($pdf)) {
          $pdf->page_script
          ('
              if ($PAGE_NUM > 5) {
                  $font = $fontMetrics->getFont("Arial", "regular");
                  $current_page = $PAGE_NUM-5;
                  $total_pages = $PAGE_COUNT-5;                  
                  $pdf->text(300, 750, "$current_page", $font, 11, array(0,0,0));
              }
          ');
      }
    </script>
</body>
</html>