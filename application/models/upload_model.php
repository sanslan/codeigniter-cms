<?php
class Upload_model extends CI_Model
{
  public function save_filename( $file )
  {
    $data = array(
      'name' => $file
    );

    $this->db->insert('files', $data);
  }

  public function update_category( $name, $slug, $parent, $cur_slug )
  {
    $data = array(
      'name' => $name,
      'slug' => $slug,
      'parent_id' => $parent
    );

    $this->db->where('slug',$cur_slug)->update('categories', $data);
  }

  public function list_files( $limit, $offset, $order_by, $order)
  {
    $query = $this->db
      ->order_by( $order_by, $order )
      ->limit( $limit, $offset )
      ->from('files')
      ->get();

    return $query->result();
  }

  public function all_categories($slug="")
  {
    $query = $this->db->where('slug !=', $slug)->order_by('id','DESC')->get( 'categories' );

    return $query->result();
  }

  public function cur_category($slug)
  {
    $query = $this->db->where('slug',$slug)->get( 'categories' );

    return $query->row();
  }

  public function get_category_name($slug)
  {
    $query = $this->db->where('slug',$slug)->get( 'categories' );

    $cat = $query->row();

    return $cat->name;
  }

  public function delete_category($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('categories');
  }

  public function get_page($slug)
  {
    $query=$this->db->get_where('pages', array( 'slug' => $slug ));
    return $query->row();
  }

  public function edit_page($title, $newslug, $body, $slug)
  {
    $data=array("title" => $title , "slug" => $newslug , "body" => $body);
    $this->db->update('pages', $data, array("slug" => $slug));
  }
}
?>