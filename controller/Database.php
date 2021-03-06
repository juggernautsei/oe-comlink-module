<?php

namespace OpenEMR\Modules\Comlink;

class Database
{
    public function __construct()
    {
    }

    private function createComlinkTable()
    {
        
        $DBSQL_PATIENT = <<<'DB'
            CREATE TABLE IF NOT EXISTS patient_monitoring_list(
            `id`            int         NOT NULL primary key AUTO_INCREMENT comment 'Primary Key',
            `pid`        bigint(11)     NOT NULL UNIQUE comment 'Patient ID',
            `updatedAt`     DATETIME    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE = InnoDB COMMENT = 'patient monitoring';
        DB;

        
        $DBSQL_FORM = <<<'DB'
            CREATE TABLE IF NOT EXISTS patient_monitoring_form(
            `id`            int         NOT NULL primary key AUTO_INCREMENT comment 'Primary Key',
            `pid`        bigint(11)     NOT NULL UNIQUE comment 'Patient ID',
            `pm_id`    int(50) NOT NULL comment 'patient monitoring ID',
            `facility`    VARCHAR(255)    DEFAULT NULL,
            `provider`    VARCHAR(255)    DEFAULT NULL,
            `weight`  float(5,2)    DEFAULT NULL,
            `height`   float(5,2)    DEFAULT NULL,
            `bp_upper`  VARCHAR(255)    DEFAULT NULL,
            `bp_lower`   VARCHAR(255)    DEFAULT NULL,
            `temp_upper`    float(5,2)    DEFAULT NULL,
            `temp_lower`    float(5,2)    DEFAULT NULL,
            `bs_upper`    smallint(6)    DEFAULT NULL,
            `bs_lower`    smallint(6)    DEFAULT NULL,
            `resp_upper`    float(5,2)    DEFAULT NULL,
            `resp_lower`    float(5,2)    DEFAULT NULL,
            `oxy_upper`    float(5,2)    DEFAULT NULL,
            `oxy_lower`    float(5,2)    DEFAULT NULL,
            `pain_upper`    VARCHAR(255)    DEFAULT NULL,
            `pain_lower`    VARCHAR(255)    DEFAULT NULL,
            `alert`    VARCHAR(255)    DEFAULT NULL,
            `updatedAt`     DATETIME    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE = InnoDB COMMENT = 'lifemesh chime sessions';
        DB;
        $db = $GLOBALS['dbase'];
        $exist = sqlQuery("SHOW TABLES FROM `$db` LIKE 'patient_monitoring'");
        if (empty($exist)) {
             sqlQuery($DBSQL_PATIENT);
             sqlQuery($DBSQL_FORM);
        }    

    }

    /**
     * @return string
     */
    public function doesTableExist()
    {
        $db = $GLOBALS['dbase'];
        $exist = sqlQuery("SHOW TABLES FROM `$db` LIKE 'patient_monitoring'");
        if (empty($exist)) {
            self::createComlinkTable();
            return "created";
        } else {
            return "exist";
        }
    }
    /**
     * @return array
     */
    public function getFacilities()
    {
        $sql = "select id, name from facility";
        $list = sqlStatement($sql);
        $facilities_list = [];
        while ($row = sqlFetchArray($list)) {
            $facilities_list[] = $row;
        }
        return $facilities_list;
    }
    
      /**
     * @return array
     */
    public function getProviders()
    {
        $sql = "SELECT id, fname, lname FROM users WHERE active ='1'";
        $list = sqlStatement($sql);
        $providers_list = [];
        while ($row = sqlFetchArray($list)) {
            $providers_list[] = $row;
        }

        return $providers_list;
    }
    public function getpatientdata()
    {
        $sql = "SELECT id, fname, lname,pid FROM patient_data";
        $list = sqlStatement($sql);
        $providers_list = [];
        while ($row = sqlFetchArray($list)) {
            $providers_list[] = $row;
        }

        return $providers_list;
    }

}
