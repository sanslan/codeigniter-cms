<?php
class Page_model extends CI_Model
{
  public function add_page( $title, $slug, $body)
  {
    $data = array(
      'title' => $title,
      'body' => $body,
      'slug' => $slug
    );

    $this->db->insert('pages', $data);
  }

  public function list_pages( $limit, $offset)
  {
    $query = $this->db->order_by('id','DESC')->get( 'pages', $limit, $offset );

    return $query->result();
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