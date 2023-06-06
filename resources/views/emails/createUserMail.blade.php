<html>
   <head>
      <style>
         .banner-color {
            background-color: #f8c400;
         }
         .title-color {
            color: #181a58;
         }
         .button-color {
             background-color: #181a58;
         }
        @media  screen and (min-width: 500px) {
            .banner-color {
                background-color: #181a58;
            }
            .title-color {
                color: #f8c400;
            }
            .button-color {
                background-color: #f8c400;
            }
        }
      </style>
      	<!-- Fonts and icons -->
        <script src="{{ asset('back/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('back/css/fonts.min.css') }}"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
            <?php
                use Illuminate\Support\Facades\DB;
                $unitKerja = DB::table('unitkerja')->where('id', $details['unitKerja'])->first();
            ?>
   </head>
   <body>
      <div style="background-color:#edf2f7;padding:0;margin:0 auto;font-weight:200;width:100%!important">
         <table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
            <tbody>
               <tr>
                  <td align="center">
                     <center style="width:100%">
                        <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif" width="512">
                           <tbody>
                              <tr>
                                 <td bgcolor="#F3F3F3" width="100%" style="background-color:#edf2f7;padding:12px;border-bottom:1px solid #edf2f7">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
                                       <tbody>
                                          <tr>
                                            <td align="left" valign="middle" width="50%"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">AMI Polines</span></td>
                                            <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px">
                                                <span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">
                                                   
                                                </span>
                                            </td>
                                            <td width="1">&nbsp;</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="left">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                       <tbody>
                                          <tr>
                                             <td width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" bgcolor="#8BC34A" style="padding:20px 48px;color:#ffffff" class="banner-color">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td align="center" width="100%">
                                                                        <img src="https://main.polines.ac.id/wp-content/uploads/2022/02/logo_polines_blu_speed-260x50.png" alt="" class="img-fluid">
                                                                        <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">Politeknik Negeri Semarang</h1>
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td align="center" style="padding:20px 0 10px 0">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td align="center" width="100%" style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;">
                                                                        <h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;" class="title-color">Hi {{ $details['name'] }},</h3>
                                                                        <p style="margin: 20px 0 30px 0;font-size: 15px;text-align: center;">Berikut ini Username dan Password default untuk login ke akun anda, dan pastikan password anda sudah terganti. <br><br>Salam hangat <b>PPMP Politeknik Negeri Semarang</b>!</p>
                                                                        <div style="font-weight: 200; text-align: center; margin: 25px;"><a style="padding:0.6em 1em;border-radius:600px;color:#ffffff;font-size:14px;text-decoration:none;font-weight:bold" class="button-color">Registration Success</a></div>

                                                                        <!-- Table -->
                                                                        <table cellpadding="7">
                                                                            <thead>
                                                                                <td>
                                                                                    <tr>
                                                                                        <th>NAMA</th>
                                                                                        <td>:</td>
                                                                                        <td>{{ $details['name'] }}</td>
                                                                                        <td></td>
                                                                                        <th>PASSWORD</th>
                                                                                        <td>:</td>
                                                                                        <td>{{ $details['password'] }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>UNIT KERJA</th>
                                                                                        <td>:</td>
                                                                                        <td>{{ $unitKerja->name }}</td>
                                                                                        <td></td>
                                                                                        <th>ROLES</th>
                                                                                        <td>:</td>
                                                                                        <td>
                                                                                            @if($details['roles'] == 1)
                                                                                                ADMIN
                                                                                            @elseif($details['roles'] == 2)
                                                                                                AUDITOR
                                                                                            @elseif($details['roles'] == 3)
                                                                                                AUDITEE
                                                                                            @else
                                                                                                PIMPINAN
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <th>STATUS</th>
                                                                                        <td>:</td>
                                                                                        <td>                                                                                    @if($details['status'] == "aktif")
                                                                                                <a style="padding:0.6em 1em;border-radius:600px;color:#ffffff;font-size:14px;text-decoration:none;font-weight:bold;background-color:green">Baru</a>
                                                                                            @else
                                                                                                <a style="padding:0.6em 1em;border-radius:600px;color:#ffffff;font-size:14px;text-decoration:none;font-weight:bold;background-color:red">Reject</a>
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <th>CREATED</th>
                                                                                        <td>:</td>
                                                                                        <td>{{ date('d F Y H:i', strtotime($details['created'])) }}</td>
                                                                                    </tr>
                                                                                </td>
                                                                            </thead>
                                                                        </table>
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                      </tr>
                                                      <tr>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>

                              <!-- footer -->
                              <tr>
                                 <td align="left">
                                    <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                       <tbody>
                                          <tr>
                                             <td align="center" width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" valign="middle" width="100%" style="border-top:1px solid #d9d9d9;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">Regards,
                                                            <br><b>PPMP - Politeknik Negeri Semarang</b>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="center" width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" style="padding:0 0 8px 0" width="100%"></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>

                              <!-- Sostmed -->
                              <tr>
                                 <td bgcolor="#F3F3F3" width="100%" style="background-color:#fff;padding:12px;border-bottom:1px solid #edf2f7;">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
                                       <tbody>
                                          <tr>
                                             <td align="left" valign="middle" width="50%">
                                                <span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">
                                                    <td width="200" valign="top"  style="padding:0 20px 0 0; font-size:12px; line-height:15pt; color:#999999;background-color:#fff">
                                                        <table width="180" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0; border-width:0;">
                                                              <tr>
                                                                <td valign="top" width="20" style="padding:0 0 0 0; line-height:100%;background-color: #fff">
                                                                    <img border="0" height="12" src="https://cdn01.rumahweb.com/img/rw/whmcs-tpl/homeIcon.gif" width="12">
                                                                </td>
                                                                <td width="160"  style="padding:0 0 10px 0; font-size:12px; line-height:100%; color:#999999;background-color: #fff" valign="top">
                                                                    <a href="https://polines.ac.id/" style="border-bottom:1px #777777 dotted; text-decoration:none; color:#777777;">
                                                                        www.polines.ac.id
                                                                    </a>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td valign="top" width="20" style="padding:2px 0 0 0; line-height:100%;background-color: #fff">
                                                                    <img border="0" height="12" src="https://cdn01.rumahweb.com/img/rw/whmcs-tpl/emailIcon.gif" width="12">
                                                                </td>
                                                                <td width="160"  style="padding:0; font-size:12px; line-height:100%; color:#999999;background-color: #fff" valign="top">
                                                                    <a href="mailto:admin@polines.ac.id" style="border-bottom:1px #777777 dotted; text-decoration:none; color:#777777;">
                                                                        smpipolines@gmail.com
                                                                    </a>
                                                                </td>
                                                              </tr>
                                                          </table>
                                                      </td>
                                                    <td width="200" valign="top"  style="padding:0 20px 0 0; font-size:12px; line-height:15pt; color:#999999;background-color:#fff">
                                                        <table width="180" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0; border-width:0;">
                                                              <tr>
                                                                <td valign="top" width="16" style="padding:1px 0 0 1px; line-height:100%;background-color:#fff">
                                                                    <img border="0" height="12" src="https://cdn01.rumahweb.com/img/rw/whmcs-tpl/phoneIcon.gif" width="12">
                                                                </td>
                                                                <td width="160"  style="padding:0 0 10px 0; font-size:12px; line-height:100%; color:#777777;background-color:#fff" valign="top">
                                                                    021-25556765
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td valign="top" width="16" style="padding:3px 0 0 1px; line-height:100%;background-color:#fff">
                                                                    <img border="0" height="12" src="https://cdn01.rumahweb.com/img/rw/whmcs-tpl/phoneIcon.gif" width="12">
                                                                </td>
                                                                <td width="160" style="padding:0; font-size:12px; line-height:100%; color:#999999;background-color:#fff" valign="top"> 
                                                                    0274-882257
                                                                </td>
                                                              </tr>
                                                          </table>
                                                      </td>
                                                </span>
                                             </td>
                                             <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px">
                                                <span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">
                                                    <table width="160" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0; border-width:0;">
                                                        <tr>
                                                            <td width="24" style="padding:0 5px 0 0;background-color:#fff">
                                                                <a href="https://web.facebook.com/PolinesOfficial?_rdc=1&_rdr" target="_blank">
                                                                    <img border="0" height="12" src="https://www.exabytes.co.id/newsletter/images/icons/color-facebook-40.png" width="12">
                                                                </a>
                                                            </td>
                                                            <td width="24" style="padding:0 5px 0 0;background-color:#fff">
                                                                <a href="https://twitter.com/PolinesOfficial" target="_blank">
                                                                    <img border="0" height="12" src="https://www.exabytes.co.id/newsletter/images/icons/color-twitter-40.png" width="12">
                                                                </a>
                                                            </td>
                                                            <td width="24" style="padding:0 5px 0 0;background-color:#fff">
                                                                <a href="https://www.instagram.com/PolinesOfficial/" target="_blank">
                                                                    <img border="0" height="12" src="https://www.exabytes.co.id/newsletter/images/icons/color-instagram-40.png" width="12">
                                                                </a>
                                                            </td>   
                                                            <td width="24" style="padding:0 5px 0 0;background-color:#fff">
                                                                <a href="https://www.youtube.com/channel/UCpjWNObWb1De5StIxQ_7pZA" target="_blank">
                                                                    <img border="0" height="12" src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-dark-gray/youtube@2x.png" width="12">
                                                                </a>
                                                            </td>
                                                            <!--<td width="24" style="padding:0;background-color:#fff">-->
                                                            <!--    <a href="https://web.telegram.org/k/#/im?p=@polinesbot" target="_blank">-->
                                                            <!--        <i class="fa-brands fa-telegram"></i>-->
                                                            <!--    </a>-->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </span>
                                             </td>
                                             <td width="1">&nbsp;</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    </br>
                                 </td>
                              </tr>

                              <!-- Copy -->
                              <tr>
                                 <td bgcolor="#F3F3F3" width="100%" style="background-color:#edf2f7;padding:12px;border-bottom:1px solid #fff">
                                    <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="font-size:11px; color: #7c7c7c; margin-bottom:20px;margin-top: 10px;">
                                        <tr>
                                            <td class="a2" align="center">
                                                Copyright &copy; {{ date('Y') }} Site by PPMP Politeknik Negeri Semarang
                                            </td>
                                        </tr>		
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </center>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
   <script src="https://kit.fontawesome.com/d4577d3914.js" crossorigin="anonymous"></script>
</html>