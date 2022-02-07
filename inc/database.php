<?php

/*
 * Database
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 
 */


include_once '../../conn.php';
include_once '../../phpmailer/PHPMailerAutoload.php';

class MySQLDB {

    var $connection;         //The MySQL database connection
    var $num_active_users;   //Number of active users viewing site
    var $num_active_guests;  //Number of active guests viewing site
    var $num_members;        //Number of signed-up users

    /* Class constructor */

    function MySQLDB() {
        /* Make connection to database */
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        mysqli_select_db($this->connection, DB_NAME);
    }

    function query($query) {
        return mysqli_query($this->connection, $query);
    }

    function sp_query($query, $para) {

        return sqlsrv_query($query, $this->connection, $para);
    }

    function fetch_row($data) {
        return mysqli_fetch_assoc($data);
    }

    function fetch_set($data) {
        return mysqli_fetch_array($data, MYSQLI_ASSOC);
    }

    function num_rows($data) {
        return mysqli_num_rows($data);
    }


    function loadAllUsers($catky) {

        $arrtype = $this->query("SELECT u_id,u_name FROM users  ORDER BY u_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['u_id'] . '" ' .
            ($catky == $typ['u_id'] ? "selected" : "") . ' >' . $typ['u_name'] . '</option>';
        }
    }

    function loadAllServices($catky) {

        $arrtype = $this->query("SELECT s_id ,s_name FROM services  ORDER BY s_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['s_id'] . '" ' .
            ($catky == $typ['s_id'] ? "selected" : "") . ' >' . $typ['s_name'] . '</option>';
        }
    }

    function loadAllProducts($catky) {

        $arrtype = $this->query("SELECT p_id,p_name FROM products  ORDER BY p_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['p_id'] . '" ' .
            ($catky == $typ['p_id'] ? "selected" : "") . ' >' . $typ['p_name'] . '</option>';
        }
    }

    
    function loadVehicleByUser($catky) {

        $arrtype = $this->query("SELECT v_id,v_number FROM `vehicles` ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['v_id'] . '" ' .
            ($catky == $typ['v_id'] ? "selected" : "") . ' >' . $typ['v_number'] . '</option>';
        }
    }

    function loadAllCurrency($catky) {

        $arrtype = $this->query("SELECT cu_id,cu_name FROM currency where cu_status=1 ORDER BY cu_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['cu_id'] . '" ' .
            ($catky == $typ['cu_id'] ? "selected" : "") . ' >' . $typ['cu_name'] . '</option>';
        }
    }

    function loadLottoList($catky) {

        $arrtype = $this->query("SELECT id,drawno  FROM lottoconfig  ORDER BY drawno");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['drawno'] . '" ' .
            ($catky == $typ['drawno'] ? "selected" : "") . ' >' . $typ['drawno'] . '</option>';
        }
    }

    function loadAdmins($catky) {

        $arrtype = $this->query("select  a_id,a_username from admins where a_type>1 ORDER by a_id");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['a_id'] . '" ' .
            ($catky == $typ['a_id'] ? "selected" : "") . ' >' . $typ['a_username'] . '</option>';
        }
    }

    function loadAtype2($catky) {

        $arrtype = $this->query("select  a_id,a_username from admins where a_type=2  and a_status='1' ORDER by a_id");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['a_id'] . '" ' .
            ($catky == $typ['a_id'] ? "selected" : "") . ' >' . $typ['a_username'] . '</option>';
        }
    }

    function loadPlayerUnder($catky) {


        $arrtype = $this->query("select  u_id,u_username from users where u_type5_by='$catky'   and u_status='1' ORDER by u_id");


        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['u_id'] . '" ' .
            ($catky == $typ['u_id'] ? "selected" : "") . ' >' . $typ['u_username'] . '</option>';
        }
    }

    function loadAtypeUnder($catky, $a_id) {
        if ($catky == 1) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type=2  and a_status='1' ORDER by a_id");
        } elseif ($catky == 2) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type2_by='$a_id' and a_type=3 and a_status='1' ORDER by a_id");
        } elseif ($catky == 3) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type3_by='$a_id' and a_type=4 and a_status='1' ORDER by a_id");
        } elseif ($catky == 4) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type4_by='$a_id' and a_type=5 and a_status='1' ORDER by a_id");
        }

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['a_id'] . '" ' .
            ($catky == $typ['a_id'] ? "selected" : "") . ' >' . $typ['a_username'] . '</option>';
        }
    }

    function lottoResultPending($catky) {

        $arrtype = $this->query("SELECT *  FROM games where g_result='0' and  g_exp_date <CURRENT_TIMESTAMP  ORDER BY g_drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['g_drawno'] . '" ' .
            ($catky == $typ['g_drawno'] ? "selected" : "") . ' >' . $typ['g_drawno'] . '</option>';
        }
    }

    function playerUnderMe($catky) {

        $arrtype = $this->query("SELECT u_id,u_username FROM users  where m_upline=" . $catky . " ORDER BY m_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['m_id'] . '" ' .
            ($catky == $typ['m_id'] ? "selected" : "") . ' >' . $typ['m_username'] . '</option>';
        }
    }

    function loadLottoExpList($catky) {

        $arrtype = $this->query("SELECT *  FROM games where g_exp_date<CURRENT_TIMESTAMP   ORDER BY g_drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['g_drawno'] . '" ' .
            ($catky == $typ['g_drawno'] ? "selected" : "") . ' >' . $typ['g_drawno'] . '</option>';
        }
    }
    
    function loadLottoActiveList($catky) {

        $arrtype = $this->query("SELECT *  FROM games where g_exp_date>CURRENT_TIMESTAMP   ORDER BY g_drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['g_drawno'] . '" ' .
            ($catky == $typ['g_drawno'] ? "selected" : "") . ' >' . $typ['g_drawno'] . '</option>';
        }
    }
    
        function loadLottoResultList($catky) {

        $arrtype = $this->query("SELECT *  FROM lottoresult where r_status=1   ORDER BY drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['drawno'] . '" ' .
            ($catky == $typ['drawno'] ? "selected" : "") . ' >' . $typ['drawno'] . '</option>';
        }
    }

}

/* Create database connection */
$database = new MySQLDB;
/*
 * Database
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 
 */

/*
include_once '../../conn.php';
include_once '../../phpmailer/PHPMailerAutoload.php';

class MySQLDB {

    var $connection;         //The MySQL database connection
    var $num_active_users;   //Number of active users viewing site
    var $num_active_guests;  //Number of active guests viewing site
    var $num_members;        //Number of signed-up users
/*
    /* Class constructor */

 /*   function MySQLDB() {
        /* Make connection to database */
    /*    $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        mysqli_select_db($this->connection, DB_NAME);
    }

    function query($query) {
        return mysqli_query($this->connection, $query);
    }

    function sp_query($query, $para) {

        return sqlsrv_query($query, $this->connection, $para);
    }

    function fetch_row($data) {
        return mysqli_fetch_assoc($data);
    }

    function fetch_set($data) {
        return mysqli_fetch_array($data, MYSQLI_ASSOC);
    }

    function num_rows($data) {
        return mysqli_num_rows($data);
    }


    function loadAllUsers($catky) {

        $arrtype = $this->query("SELECT u_id,u_name FROM users  ORDER BY u_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['u_id'] . '" ' .
            ($catky == $typ['u_id'] ? "selected" : "") . ' >' . $typ['u_name'] . '</option>';
        }
    }

    function loadAllServices($catky) {

        $arrtype = $this->query("SELECT s_id ,s_name FROM services  ORDER BY s_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['s_id'] . '" ' .
            ($catky == $typ['s_id'] ? "selected" : "") . ' >' . $typ['s_name'] . '</option>';
        }
    }

    function loadAllProducts($catky) {

        $arrtype = $this->query("SELECT p_id,p_name FROM products  ORDER BY p_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['p_id'] . '" ' .
            ($catky == $typ['p_id'] ? "selected" : "") . ' >' . $typ['p_name'] . '</option>';
        }
    }

    function loadAllCurrency($catky) {

        $arrtype = $this->query("SELECT cu_id,cu_name FROM currency where cu_status=1 ORDER BY cu_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['cu_id'] . '" ' .
            ($catky == $typ['cu_id'] ? "selected" : "") . ' >' . $typ['cu_name'] . '</option>';
        }
    }

    function loadLottoList($catky) {

        $arrtype = $this->query("SELECT id,drawno  FROM lottoconfig  ORDER BY drawno");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['drawno'] . '" ' .
            ($catky == $typ['drawno'] ? "selected" : "") . ' >' . $typ['drawno'] . '</option>';
        }
    }

    function loadAdmins($catky) {

        $arrtype = $this->query("select  a_id,a_username from admins where a_type>1 ORDER by a_id");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['a_id'] . '" ' .
            ($catky == $typ['a_id'] ? "selected" : "") . ' >' . $typ['a_username'] . '</option>';
        }
    }

    function loadAtype2($catky) {

        $arrtype = $this->query("select  a_id,a_username from admins where a_type=2  and a_status='1' ORDER by a_id");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['a_id'] . '" ' .
            ($catky == $typ['a_id'] ? "selected" : "") . ' >' . $typ['a_username'] . '</option>';
        }
    }

    function loadPlayerUnder($catky) {


        $arrtype = $this->query("select  u_id,u_username from users where u_type5_by='$catky'   and u_status='1' ORDER by u_id");


        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['u_id'] . '" ' .
            ($catky == $typ['u_id'] ? "selected" : "") . ' >' . $typ['u_username'] . '</option>';
        }
    }

    function loadAtypeUnder($catky, $a_id) {
        if ($catky == 1) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type=2  and a_status='1' ORDER by a_id");
        } elseif ($catky == 2) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type2_by='$a_id' and a_type=3 and a_status='1' ORDER by a_id");
        } elseif ($catky == 3) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type3_by='$a_id' and a_type=4 and a_status='1' ORDER by a_id");
        } elseif ($catky == 4) {

            $arrtype = $this->query("select  a_id,a_username from admins where a_type4_by='$a_id' and a_type=5 and a_status='1' ORDER by a_id");
        }

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['a_id'] . '" ' .
            ($catky == $typ['a_id'] ? "selected" : "") . ' >' . $typ['a_username'] . '</option>';
        }
    }

    function lottoResultPending($catky) {

        $arrtype = $this->query("SELECT *  FROM games where g_result='0' and  g_exp_date <CURRENT_TIMESTAMP  ORDER BY g_drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['g_drawno'] . '" ' .
            ($catky == $typ['g_drawno'] ? "selected" : "") . ' >' . $typ['g_drawno'] . '</option>';
        }
    }

    function playerUnderMe($catky) {

        $arrtype = $this->query("SELECT u_id,u_username FROM users  where m_upline=" . $catky . " ORDER BY m_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['m_id'] . '" ' .
            ($catky == $typ['m_id'] ? "selected" : "") . ' >' . $typ['m_username'] . '</option>';
        }
    }

    function loadLottoExpList($catky) {

        $arrtype = $this->query("SELECT *  FROM games where g_exp_date<CURRENT_TIMESTAMP   ORDER BY g_drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['g_drawno'] . '" ' .
            ($catky == $typ['g_drawno'] ? "selected" : "") . ' >' . $typ['g_drawno'] . '</option>';
        }
    }
    
    function loadLottoActiveList($catky) {

        $arrtype = $this->query("SELECT *  FROM games where g_exp_date>CURRENT_TIMESTAMP   ORDER BY g_drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['g_drawno'] . '" ' .
            ($catky == $typ['g_drawno'] ? "selected" : "") . ' >' . $typ['g_drawno'] . '</option>';
        }
    }
    
        function loadLottoResultList($catky) {

        $arrtype = $this->query("SELECT *  FROM lottoresult where r_status=1   ORDER BY drawno ");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['drawno'] . '" ' .
            ($catky == $typ['drawno'] ? "selected" : "") . ' >' . $typ['drawno'] . '</option>';
        }
    }

}
/*
/* Create database connection */
/*$database = new MySQLDB;*/

?>
