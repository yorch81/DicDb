<?php
require_once('DicType.class.php');
require_once('MyPDF.class.php');

/**
 * DicDb 
 *
 * DicDb Maneja y actualiza comentarios de objetos en una BD SQL Server o MySQL.
 *
 * Copyright 2014 Jorge Alberto Ponce Turrubiates
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category   DicDb
 * @package    DicDb
 * @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2014-09-01
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class DicDb
{

	/**
     * Manejador de Instancia para Patrón Singleton
     *
     * @var object $_instance Instancia
     * @access private
     */
	private static $_instance;

	/**
     * Instance Handler
     * @var object $_provider Abstract Connection Handler
     *
     * @access private
     */
	private $_dictionary;

	/**
     * Tipos de Diccionario
     *
     * @const MSSQLSERVER SQL Server
     * @const MYSQL  MySQL or MariaDB
     * @access private
     */
	const MSSQLSERVER = 'SQLServerDic';
	const MYSQL = 'MySQLDic';

	/**
     * Tipos de Reporte
     *
     * @const PDF For PDF
     * @const XLS For Excel
     * @access private
     */
	const PDF = 1;
	const XLS = 2;

	/**
	 * Wrapper que maneja la clase diccionario
	 *
	 * @param string $dicType Tipo de Diccionario default SQL Server
	 * @param string $hostname Hostname
	 * @param string $username Usuario de la BD
	 * @param string $password Usuario de la BD
	 * @param string $dbname Usuario de la BD
	 * @param int 	 $port   Puerto RDBMS
	 * @return resource | null
	 */
	private function __construct($dicType = self::MSSQLSERVER, $hostname, $username, $password, $dbname, $port)
	{
		if(class_exists($dicType)){
			$this->_dictionary = new $dicType($hostname, $username, $password, $dbname, $port);

			if(!$this->_dictionary->isConnected()){
				$this->_dictionary = null;
			}
		}
		else{
			$this->_dictionary = null;
		}
	}

	/**
	 * Implementación de Patrón Singleton
	 *
	 * @param string $dicType Tipo de Diccionario default SQL Server
	 * @param string $hostname Hostname
	 * @param string $username Usuario de la BD
	 * @param string $password Usuario de la BD
	 * @param string $dbname Usuario de la BD
	 * @param int 	 $port   Puerto RDBMS
	 * @return resource | null
	 */
	public static function getInstance($dicType = self::MSSQLSERVER, $hostname, $username, $password, $dbname, $port)
	{
		// If exists Instance return same Instance
		if(self::$_instance){
			return self::$_instance;
		}
		else{
			$class = __CLASS__;
			self::$_instance = new $class($dicType, $hostname, $username, $password, $dbname, $port);
			return self::$_instance;
		}
	}

	/**
	 * Regresa un array con los Esquemas de BD
	 *
	 * @return array ! null
	 */
	public function obtnEsquemas()
	{
		if (!is_null($this->_dictionary)){
			return $this->_dictionary->obtnEsquemas();
		}
		else
			return null;
	}

	/**
	 * Regresa un array con las tablas de un Esquema
	 *
	 * @param string $esquema Esquema o * para todos los esquemas
	 * @return array | null
	 */
	public function obtnTablas($esquema)
	{
		if (!is_null($this->_dictionary)){
			return $this->_dictionary->obtnTablas($esquema);
		}
		else
			return null;
	}

	/**
	 * Regresa un array con los Procedimientos Almacenados de un Esquema
	 *
	 * @param string $esquema Esquema o * para todos los esquemas
	 * @return array | null
	 */
	public function obtnProcedimientos($esquema)
	{
		if (!is_null($this->_dictionary)){
			return $this->_dictionary->obtnProcedimientos($esquema);
		}
		else
			return null;
	}

	/**
	 * Regresa un array con las Funciones de un Esquema
	 *
	 * @param string $esquema Esquema o * para todos los esquemas
	 * @return array | null
	 */
	public function obtnFunciones($esquema)
	{
		if (!is_null($this->_dictionary)){
			return $this->_dictionary->obtnFunciones($esquema);
		}
		else
			return null;
	}

	/**
	 * Regresa un array con los Campos de una Tabla
	 *
	 * @param string $esquema Esquema o * para todos los esquemas
	 * @param string $tabla Tabla o * para todas las tablas
	 * @return array | null
	 */
	public function obtnCampos($esquema, $tabla)
	{
		if (!is_null($this->_dictionary)){
			return $this->_dictionary->obtnCampos($esquema, $tabla);
		}
		else
			return null;
	}

	/**
	 * Regresa un array con los Triggers de una Tabla
	 *
	 * @param string $esquema Esquema o * para todos los esquemas
	 * @param string $tabla Tabla o * para todas las tablas
	 * @return array
	 */
	public function obtnTriggers($esquema, $tabla)
	{
		if (!is_null($this->_dictionary)){
			return $this->_dictionary->obtnTriggers($esquema, $tabla);
		}
		else
			return null;
	}

	/**
	 * Actualiza los comentarios de un Objeto de la BD
	 *
	 * @param string $esquema Esquema
	 * @param string $tabla Objeto de BD (Tabla, Procedimiento, Funcion, Vista)
	 * @param string $campo Campo
	 * @param string $descripcion Nueva descripcion
	 * @param int $tipo Tipo de Objeto (1 Esquema, 2 Tabla, 3 Campo, 4 Procedimiento, 5 Funcion, 6 Vista, 7 Trigger)
	 * @return boolean
	 */
	public function actDescripcion($esquema, $tabla, $campo, $descripcion, $tipo)
	{
		$retValue = false;

		if (!is_null($this->_dictionary)){
			$this->_dictionary->actDescripcion($esquema, $tabla, $campo, $descripcion, $tipo);
			$retValue = true;
		}

		return $retValue;
	}

	/**
	 * Muestra Reporte de un Esquema de Base de Datos
	 * 
	 * @param  string $esquema esquema
	 * @param  int    $tipo    1 PDF 2 Excel
	 * @param  string $rtitulo Titulo de Reporte
	 * @return output
	 */
	public function reporte($esquema, $tipo=1, $rtitulo="")
	{
		// Si es PDF
		if ($tipo == self::PDF){
			$pdf = new MyPDF();

			// Datos del Documento
			if ($rtitulo=="")
				$titulo = "Reporte de Esquema " . $esquema;
			else
				$titulo = $rtitulo;

			$pdf->SetTitle($titulo);
			$pdf->SetAuthor('DicDb');

			// Titulo del Esquema
	        $pdf->AddPage();
	        $pdf->SetFont('Arial','B',16);
	        $pdf->Cell(40,10, $titulo);

	        $pdf->Ln();

	        // Tablas
	        $pdf->Ln();
	        $pdf->titleTable("Tablas & Vistas");
	        $pdf->Ln();

	        $aTablas = $this->obtnTablas($esquema);
	        $tTablas = count($aTablas);

	        $pdf->SetWidths(array(65, 50, 80));

	        $pdf->SetFont('Arial','B',10);
	        $pdf->Row(array("TABLA", "TIPO", "DESCRIPCION"));

	        $pdf->SetFont('Arial','',10);
			for($i=0;$i<$tTablas;$i++){
				$tipo = $this->obtnTipo($aTablas[$i]["tipo"]);
				$pdf->Row(array(utf8_decode($aTablas[$i]["tabla"]), $tipo, utf8_decode($aTablas[$i]["descripcion"])));
			}

			// Campos
			$pdf->Ln();
			$pdf->titleTable("Campos");
	        $pdf->Ln();

			for($i=0;$i<$tTablas;$i++){
				$aCampos = $this->obtnCampos($esquema, $aTablas[$i]["tabla"]);
				
				$pdf->titleTable("Tabla: " . $aTablas[$i]["tabla"]);
	        	$pdf->Ln();

		        $pdf->SetWidths(array(66, 65, 65));

		        $pdf->SetFont('Arial','B',10);
	        	$pdf->Row(array("CAMPO", "TIPO", "DESCRIPCION"));

	        	$pdf->SetFont('Arial','',10);
		        $tCampos = count($aCampos);
				for($j=0;$j<$tCampos;$j++)
					$pdf->Row(array(utf8_decode($aCampos[$j]["campo"]), $aCampos[$j]["tipo"], utf8_decode($aCampos[$j]["descripcion"])));
			}

			// Procedimientos
	        $pdf->Ln();
	        $pdf->titleTable("Procedimientos Almacenados");
	        $pdf->Ln();

	        $aRutinas = $this->obtnProcedimientos($esquema);
	        $tRutinas = count($aRutinas);

	        $pdf->SetWidths(array(95, 95));

	        $pdf->SetFont('Arial','B',10);
	        $pdf->Row(array("OBJETO", "DESCRIPCION"));

	        $pdf->SetFont('Arial','',10);
			for($i=0;$i<$tRutinas;$i++)
				$pdf->Row(array(utf8_decode($aRutinas[$i]["objeto"]), utf8_decode($aRutinas[$i]["descripcion"])));

			// Funciones
			$pdf->Ln();
	        $pdf->titleTable("Funciones de Usuario");
	        $pdf->Ln();

	        $aRutinas = $this->obtnProcedimientos($esquema);
	        $tRutinas = count($aRutinas);

	        $pdf->SetWidths(array(95, 95));

	        $pdf->SetFont('Arial','B',10);
	        $pdf->Row(array("OBJETO", "DESCRIPCION"));

	        $pdf->SetFont('Arial','',10);
			for($i=0;$i<$tRutinas;$i++)
				$pdf->Row(array(utf8_decode($aRutinas[$i]["objeto"]), utf8_decode($aRutinas[$i]["descripcion"])));

	        $pdf->Output();
		}
		else{
			$excel = new PHPExcel();

			// Datos del Documento
			if ($rtitulo=="")
				$titulo = "Reporte de Esquema " . $esquema;
			else
				$titulo = $rtitulo;

	        $excel->getProperties()
	                ->setCreator("DicDb")
	                ->setLastModifiedBy("DicDb")
	                ->setTitle($titulo)
	                ->setSubject("Reporte")
	                ->setDescription("Reporte")
	                ->setKeywords("Reporte")
	                ->setCategory("Reporte");

	        $excel->setActiveSheetIndex(0);

	        $sheet = $excel->getActiveSheet();
	        $sheet->setTitle("DicDb");

	        // Titulo del Esquema
	        $cell = 2;
	        $sheet->getStyle($this->celda('B', $cell))->getFont()->setBold(true);
	        $sheet->setCellValue($this->celda('B', $cell), $titulo);
	        
	        $sheet->getColumnDimension('B')->setAutoSize(true);
	        $sheet->getColumnDimension('C')->setAutoSize(true);
	        $sheet->getColumnDimension('D')->setAutoSize(true);

	        // Tablas
	        $cell++;
	        $cell++;
	        $cell++;
	        $sheet->getStyle($this->celda('B', $cell))->getFont()->setBold(true);
	        $sheet->setCellValue($this->celda('B', $cell), "Tablas & Vistas");

	        $aTablas = $this->obtnTablas($esquema);
	        $tTablas = count($aTablas);	        

	        $cell++;
	        $sheet->setCellValue($this->celda('B', $cell), "TABLA");
	        $sheet->setCellValue($this->celda('C', $cell), "TIPO");
	        $sheet->setCellValue($this->celda('D', $cell), "DESCRIPCION");

	        $sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        $sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        $sheet->getStyle($this->celda('D', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			for($i=0;$i<$tTablas;$i++){
				$tipo = $this->obtnTipo($aTablas[$i]["tipo"]);

				$cell++;
				$sheet->setCellValue($this->celda('B', $cell), $aTablas[$i]["tabla"]);
	        	$sheet->setCellValue($this->celda('C', $cell), $tipo);
	        	$sheet->setCellValue($this->celda('D', $cell), $aTablas[$i]["descripcion"]);

	        	$sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        	$sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        	$sheet->getStyle($this->celda('D', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			}

			// Campos
			$cell++;
	        $cell++;
	        $sheet->getStyle($this->celda('B', $cell))->getFont()->setBold(true);
	        $sheet->setCellValue($this->celda('B', $cell), "Campos");
	        
	        for($i=0;$i<$tTablas;$i++){
				$aCampos = $this->obtnCampos($esquema, $aTablas[$i]["tabla"]);
				
				$cell++;
	        	$cell++;
	        	$sheet->getStyle($this->celda('B', $cell))->getFont()->setBold(true);
	        	$sheet->setCellValue($this->celda('B', $cell), "Tabla: " . $aTablas[$i]["tabla"]);

				$cell++;
	        	$sheet->setCellValue($this->celda('B', $cell), "CAMPO");
	        	$sheet->setCellValue($this->celda('C', $cell), "TIPO");
	        	$sheet->setCellValue($this->celda('D', $cell), "DESCRIPCION");

	        	$sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        	$sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        	$sheet->getStyle($this->celda('D', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


		        $tCampos = count($aCampos);
				for($j=0;$j<$tCampos;$j++){
					$cell++;
		        	$sheet->setCellValue($this->celda('B', $cell), $aCampos[$j]["campo"]);
		        	$sheet->setCellValue($this->celda('C', $cell), $aCampos[$j]["tipo"]);
		        	$sheet->setCellValue($this->celda('D', $cell), $aCampos[$j]["descripcion"]);

		        	$sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        		$sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        		$sheet->getStyle($this->celda('D', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				}
			}

			// Procedimientos
	        $cell++;
	        $cell++;
	        $sheet->getStyle($this->celda('B', $cell))->getFont()->setBold(true);
	        $sheet->setCellValue($this->celda('B', $cell), "Procedimientos Almacenados");

	        $aRutinas = $this->obtnProcedimientos($esquema);
	        $tRutinas = count($aRutinas);       

	        $cell++;
	        $sheet->setCellValue($this->celda('B', $cell), "OBJETO");
	        $sheet->setCellValue($this->celda('C', $cell), "DESCRIPCION");

	        $sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        $sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			for($i=0;$i<$tRutinas;$i++){
				$cell++;
				$sheet->setCellValue($this->celda('B', $cell), $aRutinas[$i]["objeto"]);
	        	$sheet->setCellValue($this->celda('C', $cell), $aRutinas[$i]["descripcion"]);

	        	$sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        	$sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			}

			// Funciones
	        $cell++;
	        $cell++;
	        $sheet->getStyle($this->celda('B', $cell))->getFont()->setBold(true);
	        $sheet->setCellValue($this->celda('B', $cell), "Funciones de Usuario");

	        $aRutinas = $this->obtnFunciones($esquema);
	        $tRutinas = count($aRutinas);       

	        $cell++;
	        $sheet->setCellValue($this->celda('B', $cell), "OBJETO");
	        $sheet->setCellValue($this->celda('C', $cell), "DESCRIPCION");

	        $sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        $sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			for($i=0;$i<$tRutinas;$i++){
				$cell++;
				$sheet->setCellValue($this->celda('B', $cell), $aRutinas[$i]["objeto"]);
	        	$sheet->setCellValue($this->celda('C', $cell), $aRutinas[$i]["descripcion"]);

	        	$sheet->getStyle($this->celda('B', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	        	$sheet->getStyle($this->celda('C', $cell))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			}

	        $excel->setActiveSheetIndex(0);
	        
	        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
	        $objWriter->save('php://output');
		}
	}

	/**
	 * Obtener TABLA o VISTA
	 * 
	 * @param  string $tipo T o V
	 * @return string
	 */
	private function obtnTipo($tipo)
	{
		return $tipo == 'T' ? 'TABLA' : 'VISTA';
	}

	/**
	 * Obtener Celda
	 * 
	 * @param  string $letra Letra de Celda
	 * @param  int    $celda Numero de Celda
	 * @return string
	 */
	private function celda($letra, $celda)
	{
		return $letra . strval($celda);
	}

	/**
	 * Return error when try clone object
	 *
	 */
	public function __clone()
	{
		trigger_error('Clone is not permitted.', E_USER_ERROR);
	}

	/**
	 * Return error when try deserialize object
	 *
	 */
	public function __wakeup()
	{
		trigger_error("Could not deserialize ". get_class($this) ." class.", E_USER_ERROR);
	}
}

?>