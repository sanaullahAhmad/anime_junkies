<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_model extends CI_Model {
    public function hash($string){
        return hash('md5',$string . config_item('encryption_key'));
    }

    function thumb_name($name){
        return substr($name,0,strlen($name)-4).'_thumb'.substr($name,strlen($name)-4,strlen($name));
    }
    function insert($data,$table,$where=true){
        $where = ($where!=true?$this->db->where($where):true);
        $inserted = $this->db->set($data) && $where && $this->db->insert($table) or die(json_encode(array('message'=>"Database error(".$this->db->error()['code'].") : ".$this->db->error()['message'],'type'=>'error')));
        if($inserted){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    function update($data,$table,$where){
        $updated = $this->db->set($data) && $this->db->where($where) && $this->db->update($table) or die(json_encode(array('message'=>"Database error ( ".$this->db->error()['code']." ) : ".$this->db->error()['message'],'type'=>'error')));
        if($updated){
            return true;
        }else{
           return false;
        }
    }
    function delete($table,$where){
        $this->db->where($where);
        $deleted =  $this->db->delete($table) or die(json_encode(array('message'=>"Database error ( ".$this->db->error()['code']." ) : ".$this->db->error()['message'],'type'=>'error')));;
        $rows = $this->db->affected_rows();
        if($deleted && $rows>0){
            return true;
        }else{
            return false;
        }
    }

    function select($table,$fields = '*', $where= null,$limit=null,$order_by=null){
        $query = $this->db->select($fields);
        if($where != null){
            $query->where($where);
        }
        if($order_by!=null){
            $query->order_by($order_by);
        }
        if($limit != null){
            $query->limit($limit);
        }
       $query = $query->get($table) or die(json_encode(array('message'=>"Database error ( ".$this->db->error()['code']." ) : ".$this->db->error()['message'],'type'=>'error')));;
        if($query!=false && $query->num_rows()>0)
        {
            return $query->result_array();
        }else{
            return false;
        }
    }
    function select_one($table,$fields = '*', $where= null,$limit=null){
        $query = $this->db->select($fields);
        if($where != null){
            $query->where($where);
        }
        if($limit != null){
            $query->limit($limit);
        }
        $query = $query->get($table) or die(json_encode(array('message'=>"Database error ( ".$this->db->error()['code']." ) : ".$this->db->error()['message'],'type'=>'error')));;
        if($query!=false && $query->num_rows()>0)
        {
            return (array)$query->row();
        }else{
            return false;
        }
    }

    public function image_resize($source_path,$target_path,$quality = 70,$width=64,$height=64){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_path;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['new_image'] = $target_path;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['quality']       = $quality;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        if ( ! $this->image_lib->resize()) {
            $this->image_lib->clear();
            $error = array('error_message' => $this->image_lib->display_errors());
            return $error;
        }else{
            $this->image_lib->clear();

            return true;
        }
    }


    public function image_upload($file,$path = '',$name='',$max_size=4096,$encrypt_type=false)
    {
        $config['upload_path']          = (!empty($path))?$path:config_item('image_upload_path');
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = $max_size;
        $config['file_name']             = (!empty($name)?$name:$this->rand_string(32));
        $config['encrypt_name']             = $encrypt_type;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($file))
        {
            $error = array('error_message' => $this->upload->display_errors());
            $error['uploaded'] = false;
            return $error;
        }
        else
        {
            $upload_data['uploaded'] = true;
            $upload_data = $this->upload->data();
            return $upload_data;
        }
    }


    public  function rand_string($size=6){
        return substr(str_shuffle('abcdewxyz123456789fghijklmnopqrstuv0').time(),0,$size);
    }


    public function auto_suggest($table,$field,$like,$limit=10){
        $query = $this->db->query("SELECT DISTINCT $field as name from $table where $field like '".$like."%' limit $limit");
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function  is_unique($table,$new_field,$old_field,$new_val,$old_val){
        $this->db->where($new_field,$new_val);
        $this->db->where($old_field.' !=',$old_val);
        $this->db->from($table);
        $count_default_privileges = $this->db->count_all_results();
        if($count_default_privileges>0){
            return false;
        }else{
            return true;
        }
    }

    function get_thumb($src, $width, $height, $image_thumb = ''){
        $path = pathinfo($src);

        // Path to image thumbnail
        if( !$image_thumb )
            $image_thumb = $path['dirname'] . DIRECTORY_SEPARATOR . $path['filename'] . "_" . $height . '_' . $width . "." . $path['extension'];

        if ( !file_exists($image_thumb) ) {

            // LOAD LIBRARY
            $this->load->library('image_lib');

            // CONFIGURE IMAGE LIBRARY
            $config['source_image'] = $src;
            $config['new_image'] = $image_thumb;
            $config['width'] = $width;
            $config['height'] = $height;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            // get our image attributes
            list($original_width, $original_height, $file_type, $attr) = getimagesize($image_thumb);

            // set our cropping limits.
            $crop_x = ($original_width / 2) - ($width / 2);
            $crop_y = ($original_height / 2) - ($height / 2);

            // initialize our configuration for cropping
            $config['source_image'] = $image_thumb;
            $config['new_image'] = $image_thumb;
            $config['x_axis'] = $crop_x;
            $config['y_axis'] = $crop_y;
            $config['maintain_ratio'] = FALSE;

            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            $this->image_lib->clear();

        }

        return basename($image_thumb);
    }

    function pak_money_format($money){
        $len = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$len;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                $m .=',';
            }
            $m .=$money[$i];
        }
        return strrev($m);
    }

}
