<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of DBAccess
 *
 * @author Administrator
 */
class MySqlAccess {
    public $Dsn = "mysql:host=localhost;dbname=yuzawa";
    public $User = "root"; 
    public $Password = "oatcti"; 
    public $Options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    private $m_PDO;
    public $ErrNo;
    public $ErrMsg = "";
    public $Connected = FALSE;
    private static $instance;
    
    /**
     * Get the CI singleton
     *
     * @static
     * @return	object
     */
    public static function GetInstance()
    {
        if(!isset(self::$instance))
        {
            $obj = &get_instance();        
            $dsn = $obj->config->item('db_dsn');
            $user = $obj->config->item('db_username');
            $password = $obj->config->item('db_passwd');
            $params = array('dsn'=>$dsn, 'username'=>$user,'passwd'=>$password);
            self::$instance = new MySqlAccess($params);            
        }        
        return self::$instance;
    }    
    
    public static function Dispose()
    {
        self::$instance = null;
    }    
    
    function __construct ($args) 
    {
        $this->Dsn = $args['dsn'];
        $this->User = $args['username'];
        $this->Password = $args['passwd'];
        $this->Connected = $this->Open();
    }
    
    function __destruct() {
        $this->m_PDO = null;
    }

    private function ClearErr()
    {
        $this->ErrNo = 0;
        $this->ErrMsg = "";
    }

    private function Open()
    {
        try
        {
            $this->m_PDO = new PDO($this->Dsn, $this->User, $this->Password, $this->Options); 
            //$db->setAttribute("PDO::MYSQL_ATTR_USE_BUFFERED_QUERY", true);            
            return TRUE;
        } catch (PDOException $e) {
            $this->ErrNo = $e->getCode();
            $this->ErrMsg = $e->getMessage();            
            return FALSE;
        }                
    }
    
    /*
     * PDOのInstanceを取得
     */
    public function GetConnect()
    {
        return $this->m_PDO;
    }
    
    public function BeginTran()
    {
        $this->m_PDO->beginTransaction();
    }

    public function Commit()
    {
        $this->m_PDO->commit();
    }    

    public function RollBack()
    {
        $this->m_PDO->rollBack();
    }      
    
    /*
     * 一行を返す
     */
    public function GetDataRow($sql) {
        try
        {
            $this->ClearErr();
            $rs = $this->m_PDO->query($sql); 
            if ($this->m_PDO->errorCode() != '00000'){ 
                print_r($this->m_PDO->errorInfo()); 
                return null; 
            }             
            $rs->setFetchMode(PDO::FETCH_BOTH);
            $row = $rs->fetch();
            $rs->closeCursor();
            $rs = null;
            return $row;
        } catch (PDOException $e) {
            $this->ErrNo = $e->getCode();
            $this->ErrMsg = $e->getMessage();               
            return null;
        }        
    }
    
    public function GetRowField($sql, $index = 0)
    {
        $data = $this->GetDataRow($sql);
        return $data[$index];
    }
    
    public function ExecuteNonQuery($sql)
    {
        try
        {
            $this->ClearErr();
            $rowCount = $this->m_PDO->exec($sql);
            if(is_bool($rowCount) && $rowCount == FALSE) 
            { 
                $this->ErrNo = $this->m_PDO->errorCode();
                $this->ErrMsg = $this->m_PDO->errorInfo();                             
                return -1;                 
            }
            return $rowCount;
        } catch (PDOException $e) {
            $this->ErrNo = $e->getCode();
            $this->ErrMsg = $e->getMessage();             
            return -1;
        }                
    }

    public function ExecuteGetID($sql)
    {
        try
        {
            $this->ClearErr();
            $rowCount = $this->m_PDO->exec($sql);
            $id = $this->m_PDO->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            $this->ErrNo = $e->getCode();
            $this->ErrMsg = $e->getMessage();                         
            return -1;
        }                
    }    
    
    //"SELECT * FROM city LIMIT 0,10"
    public function GetDataTable($sql, $all = 0) {
        try
        {
            $this->ClearErr();
            //$db->exec("SET NAMES 'utf8';");
            $rs = $this->m_PDO->query($sql); 
            if ($this->m_PDO->errorCode() != '00000'){ 
                print_r($this->m_PDO->errorInfo()); 
                return null; 
            } 

            if($all == 1)
            {
                $data = $rs->fetchAll(); 
            }
            else
            {
                $data = array();
                $total_column = $rs->columnCount();
                for ($i = 0; $i < $total_column; $i ++) {
                    $meta = $rs->getColumnMeta($i);
                    $data[0][] = $meta['name'].',' .$meta['native_type'].','.$meta['len'];
                }        

                //$arr = $rs->fetchAll(); 
                $j = 1;
                $rs->setFetchMode(PDO::FETCH_NUM);
                while($row = $rs->fetch()){
                    for ($i = 0; $i < $total_column; $i ++) {
                        $data[$j][] = $row[$i];
                    }
                   $j++;
                }
            }
            $rs->closeCursor();
            $rs = null;            
            return $data;
        } catch (PDOException $e) {
            $this->ErrNo = $e->getCode();
            $this->ErrMsg = $e->getMessage();  
            return null;
        }        
    }

    public function GetDataSet($sql, $all = 0) {
        try
        {
            $this->ClearErr();
            $sqlList = explode(';', $sql);                   
            $ds = array();
            $tbIdx = 0;
            
            foreach ($sqlList as $key => $value) {                
                $sqlCmd = trim($value);
                if(strlen($sqlCmd) == 0){ continue;}
                $rs = $this->m_PDO->query($sqlCmd); 
                if ($this->m_PDO->errorCode() != '00000'){ return null; } 
                
                $total_column = $rs->columnCount();                
                if($total_column > 0)
                {
                    unset($data);
                    if($all == 1) {
                        $data = $rs->fetchAll(); 
                    } else {
                        $data = array();
                        
                        //FieldInfo
                        for ($i = 0; $i < $total_column; $i ++) {
                            $meta = $rs->getColumnMeta($i);
                            $data[0][] = $meta['name'].',' .$meta['native_type'].','.$meta['len'];
                        }        

                        //データ
                        $j = 1;
                        $rs->setFetchMode(PDO::FETCH_NUM);
                        while($row = $rs->fetch()){
                            for ($i = 0; $i < $total_column; $i ++) {
                                $data[$j][] = $row[$i];
                            }
                           $j++;
                        }
                    }
                    
                    $ds[$tbIdx] = $data;
                    $tbIdx++;
                }
                $rs->closeCursor();
                $rs = null;            
            }
            return $ds;
        } catch (PDOException $e) {
            $this->ErrNo = $e->getCode();
            $this->ErrMsg = $e->getMessage();  
            return null;
        }        
    }  
    
    public function GetDict($sql)
    {
        $rs = $this->m_PDO->query($sql);
        if ($this->m_PDO->errorCode() != '00000'){ return null; } 
        $rs->setFetchMode(PDO::FETCH_NUM);
        $types = array();
        while ($row = $rs->fetch()) {
            $types[$row[0]] = $row[1];
        }    
        $rs->closeCursor();
        $rs = null;        
        return $types;        
    }    
}