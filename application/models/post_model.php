<?php
class Post_model extends CI_Model
{
  public function insertPost( $title, $body, $categories, $publish_date, $thumbnail=NULL)
  {
    $data = array(
      'title' => $title,
      'body' => $body,
      'categories' => $categories,
      'publish_date' => $publish_date,
      'thumbnail' => $thumbnail
    );

    $this->db->insert('posts', $data);
  }

  public function list_posts( $limit, $offset)
  {
    $query = $this->db->order_by('id','DESC')->get( 'posts', $limit, $offset );

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