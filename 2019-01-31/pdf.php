<?php 
    require_once('TCPDF-6.2.26/tcpdf.php');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->setCreator(PDF_CREATOR);
    $pdf->setAuthor('Karcag Tamás');
    $pdf->setTitle('Önéletrajz');
    $pdf->setSubject('Önéletrajz');
    $pdf->setKeywords('PDF, Karcag, Tamás, Önéletrajz');

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    $pdf->SetFont('dejavusans', '', 10);
    $pdf->AddPage();

    $html = '    <h1 style="text-align: center">Önéletrajz</h1>

    <table>
      <tr>
        <td><img src="teszt.jpg" alt="Teszt" style="float: right;" /></td>
        <td>
          <ul style="list-style-type:none;">
            <li><b>Név:</b> Karcag Tamás</li>
            <li><b>Telefonszám:</b> +36 30 639 0722</li>
            <li><b>E-mail cím:</b> karcagtamas@gmail.com</li>
            <li><b>Lakcím:</b> 9081, Győrújbarát László utca 120.</li>
          </ul>
        </td>
      </tr>
    </table>';

    $pdf->writeHTML($html, true, false, true, false, '');

    $html='<br/> <h3 style="color: lightblue">Végzettség:</h3>
    <ul>
      <li>
        <b>Valamilyen Egyetem Informatikai szak</b>
        <p>2024-2020</p>
      </li>
      <li>
        <b>Jedlik Ányos Szakközépiskola</b>
        <p>2019-2014</p>
      </li>
    </ul>

    <h3 style="color: lightblue">Szakmai tapasztalat:</h3>
    <ul>
      <li>
        <b>Logiscool Győr</b>
        <p>2022-2016</p>
        <p>Oktató</p>
      </li>
      <li>
        <b>AUDI Hungária</b>
        <p>2018-2017</p>
        <p>Programozó</p>
      </li>
    </ul>

    <h3 style="color: lightblue">Nyelvtudás:</h3>
    <ul>
      <li><b>Magyar nyelv - anyanyelv</b></li>
      <li><b>Angol nyelv - EXPERT LVL 0</b></li>
    </ul>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();


$html = '
    <h3 style="color: lightblue">Egyéb ismeretek:</h3>
    <ul>
      <li>
        <b>Szoftverfejlesztő</b>
        <p>2019 OKJ</p>
      </li>
      <li>
        <b>CCNA 1-2</b>
        <p>2018</p>
      </li>
      <li>
        <b>ECDL</b>
        <p>2016</p>
      </li>
      <li>
        <b>IT Essentials</b>
        <p>2015</p>
      </li>
    </ul>';

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->lastPage();

    $pdf->Output('teszt.pdf', 'I')

?>