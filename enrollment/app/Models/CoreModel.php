<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class CoreModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getData($params = array(), $table){
      $builder = $this->db->table($table);

      (!empty($params['distinct'])) ?  $builder->distinct():null;

      (!empty($params['select'])) ?$builder->select($params['select']):$builder->select("*");
      (!empty($params['like'])) ?$builder->like($params['like'][0],$params['like'][1]):null;
      (!empty($params['where'])) ?$builder->where($params['where']):null;

      if (!empty($params['where_array'])) {
        for ($i=0; $i < Count($params['where_array']) ; $i++) {
          $builder->where($params['where_array'][$i][0],$params['where_array'][$i][1]);
        };
      }else {
        null;
      };

      if (!empty($params['join'])) {
        for ($i=0; $i < count($params['join']); $i++) {
          $type = (isset($params['join'][$i]['type'])) ? $params['join'][$i]['type'] : "";
          $builder->join($params['join'][$i]['table'], $params['join'][$i]['on'],$type);
        }
      }else {
        null;
      };
      (!empty($params['groupBy'])) ? $builder->groupBy($params['groupBy']):null;
      (!empty($params['orderBy'])) ? $builder->orderBy($params['orderBy'][0], $params['orderBy'][1]):null;


      if (!empty($params['limit'])) {
        $result =  $builder->get($params['limit'], $params['offset'])->getResultArray();
      }else {
        $result =  $builder->get()->getResultArray();
      }


      return $result;
    }


    public function insertData($data, $table){
        $builder = $this->db->table($table);
        $return =  $builder->insert($data);
        return $return->resultID;
    }

    public function deleteData($data, $table){
        $builder = $this->db->table($table);
        $builder->where($data);
        $return =  $builder->delete();
        return $return->resultID;
    }
    public function updateData($data,$where, $table){
        $builder = $this->db->table($table);
        $builder->where($where);
        $return =  $builder->update($data);
        return $return;
    }

    public function getLastID(){
      $db = db_connect('default');
      return $db->insertID();
    }
    public function getLastQuery(){
      $db = db_connect('default');
      return $db->getLastQuery()->getQuery();
    }




    // protected $allowedFields = ['name','email','password','city'];
}
?>
