<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cats extends CI_Controller
{
	const MAX_REMEMBERED = 3;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Catmodel');
	}

	public function index()
	{
		$cat = $this->Catmodel->getRandom();
		$this->db->select('cats.*');
		$this->db->from('recent_views');
		$this->db->join('cats', 'cats.id = recent_views.cat_id');
		$this->db->order_by('recent_views.viewed_at', 'DESC');
		$this->db->limit(3);

		$lastviewed_cats = $this->db->get()->result();

		$this->load->view('cat_view', array('cat' => $cat, 'viewed_cats' => $lastviewed_cats));
	}

	/**
	 * Vote: looks at URL segments for votetype (upvote/downvote) and cat id.
	 * Redirect back to index so we redisplay main page with (a) new cat.
	 * redirect() is from CodeIgniter URL helper.
	 */
	public function vote()
	{
		$votetype = $this->uri->segment(3);
		$catid    = (int) $this->uri->segment(4);
		if ($votetype === 'upvote') {
			$this->Catmodel->addLike($catid);
			$this->remembercat($catid);
		} elseif ($votetype === 'downvote') {
			$this->Catmodel->addDislike($catid);
		}
		redirect(site_url('Cats'));
	}

	public function topliked()
	{
		$this->db->order_by('like_count', 'DESC');
		$data['cats'] = $this->db->get('cats')->result();
		$this->load->view('topliked_view', $data);
	}

	/**
	 * Remember a cat in session; keep only last 3 (slide: append, then shift if > 3).
	 */
	public function remembercat($catid)
	{
		// Insert new record
		$this->db->insert('recent_views', [
			'cat_id' => $catid
		]);

		// Keep only last 3 records
		$this->db->order_by('viewed_at', 'DESC');
		$query = $this->db->get('recent_views');

		if ($query->num_rows() > self::MAX_REMEMBERED) {
			$extra = $query->result_array();
			for ($i = self::MAX_REMEMBERED; $i < count($extra); $i++) {
				$this->db->delete('recent_views', ['id' => $extra[$i]['id']]);
			}
		}
	}
}
