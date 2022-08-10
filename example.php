<?php

$html = '';
$html .= '<table border="1" cellspacing="0" cellspadding="0" width="100%">
	<thead>
	    <tr>
			<th>No</th>
			<th>Event</th>
			<th>Venue</th>
			<th>Details</th>
			<th>Date</th>
			<th>Fee</th>
			<th>Player</th>
			<th>Visitor</th>
	    </tr>
    </thead>
   <tbody>';
   	$link = mysqli_connect("localhost","root","","latihan");
	$no = 1;
	$q = "SELECT * FROM `event` ORDER BY id DESC";
	$res = mysqli_query($link,$q);
	$row = mysqli_num_rows($res);
	if($row > 0) { 
	while($row = mysqli_fetch_assoc($res)) {
	    $html .= '<tr align="center"><td>'.$no.'</td>
	    <td>'.$row['event_name'].'</td>
	    <td>'.$row['event_venue'].'</td>
	    <td>'.substr($row['event_details'],0,200).'</td>
	    <td>'.$row['event_date'].'</td>
	    <td>'.$row['event_fee'].'</td>
	    <td>'.$row['player_fee'].'</td>
	    <td>'.$row['visitor_fee'].'</td>';
	    $no++;
	}
	} else {
		$html .= '<tr aling="center"><td colspan="8">No Event</td></tr>';
	}

   	$html .= '</tbody></table>';

	require_once __DIR__ . '/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L' ]);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->WriteHTML( $html );
	$mpdf->Output();
	exit;