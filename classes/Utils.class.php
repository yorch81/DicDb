<?php
/**
 * Utils 
 *
 * Utils Utilerías HTML
 *
 * Copyright 2015 Jorge Alberto Ponce Turrubiates
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
 * @category   Utils
 * @package    Utils
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-04-08
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class Utils
{
	/**
	 * Genera HTML de Esquemas
	 *
	 * @param array $arrEsquemas Array de Esquemas de Base de Datos
	 * @return string
	 */
	public static function getHtmlEsquemas($arrEsquemas)
	{
		$retValue = "";
      	$total = count($arrEsquemas);

	    for($i=0; $i<$total; $i++){
	        $retValue = $retValue . '<a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item dicdb-tooltip" dicdb-type="1" dicdb-name="'.  $arrEsquemas[$i]["esquema"] . 
	        '" title="'.  $arrEsquemas[$i]["descripcion"] . '" dicdb-comment="'.  $arrEsquemas[$i]["descripcion"] . '">'  . $arrEsquemas[$i]["esquema"] . "</a>";
	    }

		return $retValue;
	}

	/**
	 * Genera HTML de Tablas
	 *
	 * @param array $arrTablas Array de Tablas de Base de Datos
	 * @return string
	 */
	public static function getHtmlTablas($arrTablas)
	{
		$retValue = "";
      	$total = count($arrTablas);

	    for($i=0; $i<$total; $i++){
	    	$tipo = '2';

	    	if ($arrTablas[$i]["tipo"] == 'V')
	    		$tipo = '6';

	        $retValue = $retValue . '<a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item dicdb-tooltip" dicdb-type="' . $tipo .'" dicdb-name="'.
	        $arrTablas[$i]["esquema"] . '.' . $arrTablas[$i]["tabla"] . '" title="'.  $arrTablas[$i]["descripcion"] . '" dicdb-comment="'.  $arrTablas[$i]["descripcion"] . '">'  . $arrTablas[$i]["tabla"] . "</a>";
	    }

		return $retValue;
	}

	/**
	 * Genera HTML de Procedimientos
	 *
	 * @param array $arrProcedures Array de Procedimientos de Base de Datos
	 * @return string
	 */
	public static function getHtmlProcedures($arrProcedures)
	{
		$retValue = "";
      	$total = count($arrProcedures);

	    for($i=0; $i<$total; $i++){
	        $retValue = $retValue . '<a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item dicdb-tooltip" dicdb-type="4" dicdb-name="'. $arrProcedures[$i]["esquema"] . '.' . $arrProcedures[$i]["objeto"] . 
	        '" title="'.  $arrProcedures[$i]["descripcion"] . '" dicdb-comment="'.  $arrProcedures[$i]["descripcion"] . '">'  . $arrProcedures[$i]["objeto"] . "</a>";
	    }

		return $retValue;
	}

	/**
	 * Genera HTML de Funciones
	 *
	 * @param array $arrFunctions Array de Funciones de Base de Datos
	 * @return string
	 */
	public static function getHtmlFunctions($arrFunctions)
	{
		$retValue = "";
      	$total = count($arrFunctions);

	    for($i=0; $i<$total; $i++){
	        $retValue = $retValue . '<a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item dicdb-tooltip" dicdb-type="5" dicdb-name="'. $arrFunctions[$i]["esquema"] . '.' . $arrFunctions[$i]["objeto"] . 
	        '" title="'.  $arrFunctions[$i]["descripcion"] . '" dicdb-comment="'.  $arrFunctions[$i]["descripcion"] . '">'  . $arrFunctions[$i]["objeto"] . "</a>";
	    }

		return $retValue;
	}

	/**
	 * Genera HTML de Campos
	 *
	 * @param array $arrCampos Array de Campos de Base de Datos
	 * @return string
	 */
	public static function getHtmlCampos($arrCampos)
	{
		$retValue = "";
      	$total = count($arrCampos);

	    for($i=0; $i<$total; $i++){
	        $retValue = $retValue . '<a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item dicdb-tooltip" dicdb-type="3" dicdb-name="' . $arrCampos[$i]["esquema"] . '.' . $arrCampos[$i]["tabla"] . '.' . $arrCampos[$i]["campo"] .
	        '" title="'.  $arrCampos[$i]["descripcion"] . '" dicdb-comment="'.  $arrCampos[$i]["descripcion"] . '">'  . $arrCampos[$i]["campo"] . "</a>";
	    }

		return $retValue;
	}
}

?>