<?php
  include 'includes/session.php';

  function generateRow($conn){
    $contents = '';
    
    $sql = "SELECT attendance.*,employees.*,negocio.*,position.*, employees.employee_id AS empid,
                           CASE WHEN ADDTIME(schedules.time_in, '00:15:00') >= attendance.time_in THEN 1 
                           WHEN ADDTIME(schedules.time_in, '00:15:00') <= attendance.time_in THEN 0 
                           END AS status_v1,

                              attendance.id AS attid FROM attendance
                              RIGHT JOIN employees
                                ON employees.id = attendance.employee_id
                              LEFT JOIN position
                                ON position.id = employees.position_id
                              LEFT JOIN negocio
                                ON negocio.id = employees.negocio_id
                              LEFT JOIN schedules
                                ON schedules.id = employees.schedule_id
                              ORDER BY attendance.date DESC,
                              attendance.time_in DESC";
    $query = $conn->query($sql);
    $total = 0;
    while($row = $query->fetch_assoc()){
        
                              if ( ($row['status_v1']) =="1" ){ 
                        $status = '<span class="label label-success pull-right"> - Puntual</span>';
               } else if ( ($row['status_v1'])=="0" ){
                        $status = '<span class="label label-warning pull-right"> - Tarde</span>';
                      } else if ( ($row['status_v1']) == NULL ){

                        $status = '<span class="label label-danger pull-right"> - No Marco</span>';
                   }
                 
           
           
           
           
                    
      $contents .= "
      <tr>
      
        <td>".date('M d, Y', strtotime($row['date']))."</td>
        
        <td>".$row['lastname'].", ".$row['firstname']."</td>
        <td>".$row['employee_id']."</td>
        <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
        <td>".date('h:i A', strtotime($row['time_out']))."</td>
        
      </tr>
      ";
    }

    return $contents;
  }

  require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Reporte de Asistencia en NHL');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
        <h2 align="center">Asistencias de Practicantes NHL</h2>
        <h3 align="center"></h3>
        <table border="1" cellspacing="0" cellpadding="3">  
        
        <tr>  
        <th width="15%" align="center"><b>Fecha</b></th> 
        <th width="30%" align="center"><b>Nombre de Practicante</b></th>
        <th width="20%" align="center"><b>Código de Asistencia</b></th>
        <th width="20%" align="center"><b>Entrada</b></th>
        <th width="15%" align="center"><b>Salida</b></th> 
        
        </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>