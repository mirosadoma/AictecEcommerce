<!-- Free to use, HTML email template designed & built by FullSphere. Learn more about us at www.fullsphere.co.uk -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "">

<head>

  <!--[if gte mso 9]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
  <![endif]-->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->

    <!-- Your title goes here -->
    <title>Newsletter</title>
    <!-- End title -->

    <!-- Start stylesheet -->
    <style type="text/css">
      a,a[href],a:hover, a:link, a:visited {
        /* This is the link colour */
        text-decoration: none!important;
        color: #0000EE;
      }
      .link {
        text-decoration: underline!important;
      }
      p, p:visited {
        /* Fallback paragraph style */
        /* font-size:15px; */
        line-height:24px;
        /* font-family:'Helvetica', Arial, sans-serif; */
        /* font-weight:300; */
        /* text-decoration:none; */
        /* color: #000000; */
        width: 80%;
        margin: 0 auto;
        text-align: center;
      }
      h1 {
        /* Fallback heading style */
        font-size:22px;
        line-height:24px;
        font-family:'Helvetica', Arial, sans-serif;
        font-weight:normal;
        text-decoration:none;
        color: #000000;
      }
      .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}
      .ExternalClass {width: 100%;}
      img{
        width: 100% !important; max-width: 100% !important; height: 350px; max-height: 350px; text-align: center;
      }
      td{
        padding-left:0;
        padding-right:0;
      }
    </style>
    <!-- End stylesheet -->

</head>

  <!-- You can change background colour here -->
  <body style="text-align: center; margin: 0; padding-top: 10px; padding-bottom: 10px; padding-left: 0; padding-right: 0; -webkit-text-size-adjust: 100%;background-color: #f2f4f6; color: #000000" align="center">

  <!-- Fallback force center content -->
  <div style="text-align: center;">


    <!-- Start container for logo leen alkhair -->
    <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600">
      <tbody>
        <tr>
          <td style="width: 596px; vertical-align: top; padding-left: 0; padding-right: 0; padding-top: 15px; padding-bottom: 15px;" width="596">

            <!-- Your logo is here -->
            <img style="width: 180px !important; max-width: 180px !important; height: 85px !important; max-height: 85px !important; text-align: center; color: #ffffff;" alt="Logo" src="{!! $data['logo'] !!}" align="center" width="180" height="85">

          </td>
        </tr>
      </tbody>
    </table>
    <!-- End container for logo -->

   <!-- Start single column section -->
   <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600">
      <tbody>
         <tr>
            <td style="width: 596px; vertical-align: top; padding-top: 30px; padding-bottom: 40px;" width="596">
               <p style="font-size: 15px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #919293;">
                    {!! $data['content'] !!}
               </p>
            </td>
         </tr>
      </tbody>
   </table>
   <!-- End single column section -->
    <!-- Start footer -->
    <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #e7e2e2;" width="600">
        <tbody>
          <tr>
            <td style="width: 596px; vertical-align: top; padding-top: 30px; padding-bottom: 30px;" width="596">

              <!-- Your inverted logo is here -->
              <img style="width: 180px !important; max-width: 180px !important; height: 85px !important; max-height: 85px !important; text-align: center; color: #ffffff;" alt="Logo" src="{!! $data['logo'] !!}" align="center" width="180" height="85">

              <p style="font-size: 13px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #0b0000;">
                المملكة العربية السعودية، الرياض
              </p>

              <p style="margin-bottom: 0; font-size: 13px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #000000;">
                <a target="_blank" style="text-decoration: underline; color: #000000;" href="{!! $data['url'] !!}">
                  {!! $data['url'] !!}
                </a>
              </p>

            </td>
          </tr>
        </tbody>
    </table>
    <!-- End footer -->


  </div>

  </body>

</html>
