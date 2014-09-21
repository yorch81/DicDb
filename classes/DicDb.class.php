<?php
require_once('DicType.class.php');

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
	* Wrapper que maneja la clase diccionario
	*
	* @param string $dicType Tipo de Diccionario default SQL Server
	* @param string $hostname Hostname
	* @param string $username Usuario de la BD
	* @param string $password Usuario de la BD
	* @param string $dbname Usuario de la BD
	* @return resource | null
	*/
	private function __construct($dicType = self::MSSQLSERVER, $hostname, $username, $password, $dbname)
	{
		if(class_exists($dicType)){
			$this->_dictionary = new $dicType($hostname, $username, $password, $dbname);

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
	* @return resource | null
	*/
	public static function getInstance($dicType = self::MSSQLSERVER, $hostname, $username, $password, $dbname)
	{
		// If exists Instance return same Instance
		if(self::$_instance){
			return self::$_instance;
		}
		else{
			$class = __CLASS__;
			self::$_instance = new $class($dicType, $hostname, $username, $password, $dbname);
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
	* @return true | false
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
	* Return error when try clone object
	*
	* @return error
	*/
	public function __clone()
	{
		trigger_error('Clone is not permitted.', E_USER_ERROR);
	}

    /**
	* Return error when try deserialize object
	*
	* @return error
	*/
	public function __wakeup()
	{
		trigger_error("Could not deserialize ". get_class($this) ." class.", E_USER_ERROR);
	}
}

?>