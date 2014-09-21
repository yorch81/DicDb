<?php
require_once('../../MyDb/MyDb.class.php');

/**
 * DicType Clase Abstracta para manejar el Diccionario de Datos
 *
 * @category   DicType
 * @package    DicType
 * @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2014-09-01
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
abstract class DicType
{
	/**
     * Id de Conexión
     *
     * @var object $_connection Manejador de Conexión
     * @access private
     */
	protected $_connection = null;

	/**
	* Regresa un array con los Esquemas de BD
	*
	* @return array
	*/
	public abstract function obtnEsquemas();

	/**
	* Regresa un array con las tablas de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public abstract function obtnTablas($esquema);

	/**
	* Regresa un array con los Procedimientos Almacenados de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public abstract function obtnProcedimientos($esquema);

	/**
	* Regresa un array con las Funciones de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public abstract function obtnFunciones($esquema);

	/**
	* Regresa un array con los Campos de una Tabla
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @param string $tabla Tabla o * para todas las tablas
	* @return array
	*/
	public abstract function obtnCampos($esquema, $tabla);

	/**
	* Regresa un array con los Triggers de una Tabla
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @param string $tabla Tabla o * para todas las tablas
	* @return array
	*/
	public abstract function obtnTriggers($esquema, $tabla);

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
	public abstract function actDescripcion($esquema, $tabla, $campo, $descripcion, $tipo);

	/**
	* Return if exists connection
	*
	* @return true | false 
	*/
	public function isConnected()
	{
		return !is_null($this->_connection);
	}
}

/**
 * Clase de Diccionario de Datos para MySQL
 *
 * @category   MySQLDic
 * @package    DicType
 * @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2014-09-01
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class MySQLDic extends DicType
{
	/**
	* Constructor de la clase, solo crea el objeto conexión
	*
	* @param string $hostname Hostname
	* @param string $username Usuario de la BD
	* @param string $password Password de la BD
	* @param string $dbname Nombre de la BD
	* @return instance
	*/
	public function __construct($hostname, $username, $password, $dbname)
	{
		$this->_connection = MyDb::getConnection('MySQLDb', $hostname, $username, $password, $dbname);
	}

	/**
	* Regresa un array con los Esquemas de BD
	*
	* @return array
	*/
	public function obtnEsquemas()
	{
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("CALL usp_Obtn_Esquemas;");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con las tablas de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public function obtnTablas($esquema){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("CALL usp_Obtn_Tablas('" . $esquema . "');");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con los Procedimientos Almacenados de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public function obtnProcedimientos($esquema){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("CALL usp_Obtn_Procedimientos('" . $esquema . "');");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con las Funciones de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public function obtnFunciones($esquema){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("CALL usp_Obtn_Funciones('" . $esquema . "');");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con los Campos de una Tabla
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @param string $tabla Tabla o * para todas las tablas
	* @return array
	*/
	public function obtnCampos($esquema, $tabla){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("CALL usp_Obtn_Campos('" . $esquema . "', '" . $tabla . "');");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con los Triggers de una Tabla
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @param string $tabla Tabla o * para todas las tablas
	* @return array
	*/
	public function obtnTriggers($esquema, $tabla){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("CALL usp_Obtn_Triggers('" . $esquema . "', '" . $tabla . "');");

		return is_null($retArray) ? array() : $retArray;
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
	public function actDescripcion($esquema, $tabla, $campo, $descripcion, $tipo){
		$retValue = false;

		if ($this->_connection->isConnected()){
			if ($tipo == 2 || $tipo == 3){
				$query = sprintf("CALL usp_ActDescripcion ('%s','%s','%s','%s',%s);", 
					 $this->_connection->escape($esquema),
					 $this->_connection->escape($tabla),
					 $this->_connection->escape($campo),
					 $this->_connection->escape($descripcion),
					 $this->_connection->escape($tipo));

				$retValue = true;
				$retArray = $this->_connection->executeCommand($query);
			}

			if ($tipo == 4){
				$query = sprintf("ALTER PROCEDURE `%s`.`%s` COMMENT '%s';", 
					 $this->_connection->escape($esquema),
					 $this->_connection->escape($tabla),
					 $this->_connection->escape($descripcion));

				$retValue = true;
				$retArray = $this->_connection->executeCommand($query);
			}

			if ($tipo == 5){
				$query = sprintf("ALTER FUNCTION `%s`.`%s` COMMENT '%s';", 
					 $this->_connection->escape($esquema),
					 $this->_connection->escape($tabla),
					 $this->_connection->escape($descripcion));

				$retValue = true;
				$retArray = $this->_connection->executeCommand($query);
			}
		}

		return $retValue;
	}
}

/**
 * Clase de Diccionario de Datos para SQL Server
 *
 * @category   SQLServerDic
 * @package    DicType
 * @copyright  Copyright 2014 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2014-09-01
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class SQLServerDic extends DicType
{
	/**
	* Constructor de la clase, solo crea el objeto conexión
	*
	* @param string $hostname Hostname
	* @param string $username Usuario de la BD
	* @param string $password Password de la BD
	* @param string $dbname Nombre de la BD
	* @return instance
	*/
	public function __construct($hostname, $username, $password, $dbname)
	{
		$this->_connection = MyDb::getConnection('SQLServerDb', $hostname, $username, $password, $dbname);
	}

	/**
	* Regresa un array con los Esquemas de BD
	*
	* @return array
	*/
	public function obtnEsquemas()
	{
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("EXECUTE usp_Obtn_Esquemas;");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con las tablas de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public function obtnTablas($esquema){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("EXECUTE usp_Obtn_Tablas '" . $esquema . "';");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con los Procedimientos Almacenados de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public function obtnProcedimientos($esquema){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("EXECUTE usp_Obtn_Procedimientos '" . $esquema . "';");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con las Funciones de un Esquema
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @return array
	*/
	public function obtnFunciones($esquema){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("EXECUTE usp_Obtn_Funciones '" . $esquema . "';");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con los Campos de una Tabla
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @param string $tabla Tabla o * para todas las tablas
	* @return array
	*/
	public function obtnCampos($esquema, $tabla){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("EXECUTE usp_Obtn_Campos '" . $esquema . "', '" . $tabla . "';");

		return is_null($retArray) ? array() : $retArray;
	}

	/**
	* Regresa un array con los Triggers de una Tabla
	*
	* @param string $esquema Esquema o * para todos los esquemas
	* @param string $tabla Tabla o * para todas las tablas
	* @return array
	*/
	public function obtnTriggers($esquema, $tabla){
		$retArray = array();

		if ($this->_connection->isConnected())
			$retArray = $this->_connection->executeCommand("EXECUTE usp_Obtn_Triggers '" . $esquema . "', '" . $tabla . "';");

		return is_null($retArray) ? array() : $retArray;
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
	public function actDescripcion($esquema, $tabla, $campo, $descripcion, $tipo){
		$retValue = true;

		if ($this->_connection->isConnected()){
			$query = sprintf("EXECUTE usp_ActDescripcion '%s','%s','%s','%s',%s;", 
				 $this->_connection->escape($esquema),
				 $this->_connection->escape($tabla),
				 $this->_connection->escape($campo),
				 $this->_connection->escape($descripcion),
				 $this->_connection->escape($tipo));

			$retArray = $this->_connection->executeCommand($query);
		}

		return $retValue;
	}
}

?>
